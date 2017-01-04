<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Pingpp\Charge;
use Pingpp\Error\Base;
use Pingpp\Pingpp;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pay(Request $request){
        Pingpp::setPrivateKeyPath(config_path('rsa_private_key.pem'));
        Pingpp::setApiKey(env('PING_API_KEY'));
        try{
            $charge = Charge::create(array(
                'order_no'  => time().rand(10000,99999),
                'amount'    => '100',
                'app'       => ['id' => env('PING_APP_ID')],
                'channel'   => 'alipay_pc_direct',
                'currency'  => 'cny',
                'client_ip' => '127.0.0.1',//$request->ip()
                'subject'   => 'my ping++ demo',
                'body'      => 'good',
                'extra'     => ['success_url'=>'http://test.meijiemall.com/success.php']
            ));
            echo $charge;
        }catch (Base $e){
            // 捕获报错信息
            if ($e->getHttpStatus() != NULL) {
                header('Status: ' . $e->getHttpStatus());
                echo $e->getHttpBody();
            } else {
                echo $e->getMessage();
            }
        }

    }
}
