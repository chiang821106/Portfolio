<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        
        
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'u_account';
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        // 登入加入驗證 ()
        $active_active = User::where($this->username(), $request[$this->username()])
            ->where('u_right', User::STATUS_ACTIVE)->first();
        $active_member = User::where($this->username(), $request[$this->username()])
            ->where('u_right', User::STATUS_MEMBER)->first();
        $active_user = User::where($this->username(), $request[$this->username()])
            ->where('u_right', User::STATUS_USER)->first();
        if ($active_active !== null) {
            return $this->guard()->attempt(
                $this->credentials($request), $request->has('remember')
            );
        }
        if ($active_member !== null) {
            return $this->guard()->attempt(
                $this->credentials($request), $request->has('remember')
            );
        }
        if ($active_user !== null) {
            return $this->guard()->attempt(
                $this->credentials($request), $request->has('remember')
            );
        }
        return false;
    }
    
}
