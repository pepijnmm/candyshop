<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $rules = [
        'first_name' => 'required||max:30',
        'second_name' => 'required|max:30',
        'email' => 'required|max:500',
        'phone_number' => '',
        'password' => 'required',
    ];
        public $updaterules = [
        'first_name' => 'required||max:30',
        'second_name' => 'required|max:30',
        'email' => 'required|max:500',
        'phone_number' => '',
        'password' => 'required',
        'role'     =>   'required'
    ];

    protected $fillable = [
        'first_name', 'second_name', 'email', 'phone_number', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function Address()
    {
        return $this->hasOne('App\Address');
    }
    public function Orders()
    {
        return $this->hasMany('App\Order');
    }
}
