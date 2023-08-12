<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)//49行目から56にかけてバリデーションを行う
    {
        return Validator::make($data, [ //それぞれの入力項目に対してどのようなチェックを行うかを記述している。
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required||min:8|max:20|confirmed',
            'password_confirmation' => 'required||min:8|max:20',
            //追加するパスワード確認の処理
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)//作成を行う役割
    {
        //以下バリデーションの記述 02/14
//if($data->fails()){
//バリデーションに引っかかった場合の処理
//return redirect('posts.index')
//->withErrors($data)
//->withInput();
//}else{      'username' => 'required|string|min:2|max:12',
            //'mail' => 'required|string|email|min:5|max:40|unique:users',
            //'password' => 'required|string|min:8|max:20|confirmed',

        return User::create([//Users テーブルへの登録を行っています。
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){//登録完了画面表示させる処理
        if($request->isMethod('post')){//引数に指定した文字列とHTTP動詞が一致するか調べられる
            $data = $request->input();//入力値を連想配列として取得できる
            //dd($data);
            // セッションへデータを保存する
            //バリデーションの処理
            $validator = $this->validator($data);
            if ($validator->fails()) {
                // バリデーションに引っかかった場合の処理(元の画面の戻る)
                return redirect('/register')
                ->withErrors($validator)//バリデーションかけられた状態
                ->withInput();

            } else {
            //成功時の処理
            $request->session()->put('username',$data['username']);
            $this->create($data);//createメソッドの処理が行われる
            return redirect('added');
            }
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
