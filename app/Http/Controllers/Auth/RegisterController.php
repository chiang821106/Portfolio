<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // 驗證
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            // 'u_account' => ['required', 'string', 'max:255','unique:users'],
            'u_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255','unique:users'],
            // 'u_email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'u_address' => ['required', 'string', 'max:255'],
            'u_phone' => ['required', 'string', 'digits:10'],
            'u_account' => ['required', 'string', 'between:6,12'],

            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'address' => ['required', 'string', 'max:255'],
            // 'phone' => ['required', 'string', 'max:255'],

        ]);
        
        
    }

    
    // 創會員->users資料表
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            // 'u_email' => $data['u_email'],
            'u_account' => $data['u_account'],
            'password' => Hash::make($data['password']),
            // 'u_password' => $data['u_password'],
            'u_name' => $data['u_name'],
            'u_address' => $data['u_address'],
            'u_phone' => $data['u_phone'],
            // 'u_author' => $data['u_author'],
            // 'u_bonus' => $data['u_bonus'],
            'role' => User::ROLE_USER,  // 預設為一般使用者
            'u_right' => $data['u_right'],
            
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
            // 'address' => $data['address'],
            // 'phone' => $data['phone'],
            
        ]);
    }
}
