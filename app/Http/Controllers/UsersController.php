<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(){

        return view('users.register');
    }
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
    public function store(Requests\UserRegisterRequest $request)
    {
        $data=[
            'avatar'=>'/images/default-avatar.png',
            'confirm_code'=>str_random(48),
        ];
        $user=User::register(array_merge($request->all(),$data));
        return redirect('/success');
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

    public function confirmEmail($confirm_code){
        $user=User::where('confirm_code',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();
//        \Session::flash('email_confirm','测试');
        return redirect('user/login');
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


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        return view('users.login');
    }

    /**
     * @param Requests\UserLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function signin(Requests\UserLoginRequest $request){
        if(\Auth::attempt([
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'is_confirmed'=>1,
        ])){
            return redirect(url('/'));
        }
        //若没有任何提示也没有提示 咋办? 看下面
         \Session::flash('user_login_failed','密码不正确或邮箱没验证');
        return redirect('/user/login')->withInput();//将用户输入的内容重新传回去
    }

    public function avatar(){
        return view('users.avatar');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function changeavatar(Request $request){
        $file=$request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }
        $destinationPath = 'uploads/';
        $filename =\Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath.$filename)->fit(400)->save();
//        Image::make($destinationPath.$filename)->resize(300, 200);
//        $user=User::find(\Auth::user()->id);
//        $user->avatar ='/'.$destinationPath.$filename;
//        $user->save();

        return \Response::json([
            'success' => true,
            'avatar' => asset($destinationPath.$filename),//asset($destinationPath.$filename)就是URL
            'image'  => $destinationPath.$filename
        ]);
    }

    public function cropAvatar(Request $request){
        $photo=$request->get('photo');
        $width=(int)$request->get('w');
        $height=(int)$request->get('h');
        $xAlign=(int)$request->get('x');
        $yAlign=(int)$request->get('y');
        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();
        $user=\Auth::user();
        $user->avatar =asset($photo);
        $user->save();

        return redirect('/user/avatar');
    }
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        \Auth::logout();
        return redirect('/');
    }
}
