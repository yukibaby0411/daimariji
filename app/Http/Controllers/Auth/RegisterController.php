<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/notices';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'unique:users',
                'max:16',
                'regex:/^((?!admin|root).)*$/',
                'alpha_num'
            ],
            'tel' => [
                'required',
                'unique:users',
                'regex:/^'.session()->get('tel_num').'$/',
            ],
            'code' => ['regex:/^'.session()->get('tel_code').'$/'],
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //验证密码强度
        $pass = $data['password'];
        $pass_leng = strlen($pass);
        $strong = 0;
        if(preg_match('/[0-9]+/', $pass)) $strong+=15;
        if(preg_match('/[a-z]+/', $pass)) $strong+=15;
        if(preg_match('/[A-Z]+/', $pass)) $strong+=15;
        if(preg_match('/((?=[\x21-\x7e]+)[^A-Za-z0-9])/', $pass)) $strong+=15;
        if($pass_leng>8) $strong+=10;
        if($pass_leng>16) $strong+=10;
        if($pass_leng>32) $strong+=20;
        return User::create([
            'name' => strtolower($data['name']),
            'tel' => $data['tel'],
            'password' => bcrypt($data['password']),
            'pass_strong' => $strong
        ]);
    }
}
