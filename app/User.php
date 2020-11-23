<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public function orders()
{
    return $this->hasMany('App\Order','u_id');
}
    public function product()
{
    return $this->hasMany('App\Product',"u_id");
}
    

    

    const STATUS_USER = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_MEMBER = '2';
    const STATUS_IDLE = '3';

    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    


     
    protected $primaryKey = 'u_id';
    protected $fillable = [
        'role',
        'u_right',
        'email',
        'password',
         'u_account',
        //  'u_password',
         'u_name',
        //  'u_email',
         'u_address',
         'u_phone',
         'u_author',
         'u_bonus',
        // 'name', 'email', 'password','address','phone'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'u_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
