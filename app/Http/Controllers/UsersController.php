<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminderEmail;
use App\User;
use Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Overtrue\Socialite\SocialiteManager;

class UsersController extends Controller
{
    protected $config = [
        'github' => [
            'client_id'     => '83d68e35b3216b7eb9b4',
            'client_secret' => '9fa52310f5380a043b7a1cac1a1d7f4ba6c740b3',
            'redirect'      => 'http://laravel.dev/github/login',
        ],
    ];

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
        //或者用队列 ，用supervisor来监听
        /*
        $job = (new SendReminderEmail($user));
//            $job = (new SendReminderEmail($user))->delay(60);//延时发送
//            $job = (new SendReminderEmail($user))->onQueue('SendReminderEmail');//指定队列
        $this->dispatch($job);
        */
        return redirect(url('/success'));
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
        return redirect(url('user/login'));
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
        return redirect(url('user/login'))->withInput();//将用户输入的内容重新传回去
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

        return redirect(url('/user/avatar'));
    }
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        \Auth::logout();
        return redirect(url('/'));
    }

    public function github(){
        $socialite = new SocialiteManager($this->config);
        $response = $socialite->driver('github')->redirect();
        $response->send();
    }

    public function githubLogin(){
        $socialite = new SocialiteManager($this->config);
        $user = $socialite->driver('github')->user();

        User::create([
            'name' => $user->getNickname(),
            'email' => $user->getEmail(),
            'password' => bcrypt(str_random(16)),
            'avatar' => 'http://laravel.dev/uploads/30_1473313040下载.jpeg',
            'is_confirmed' => 0,
            'confirm_code' => 'XqECKWQoFOhICvc6MmyBK4Zja7dz7cXAl93uPJys9qpj00uy',
        ]);
        return redirect(url('/'));
    }
}
