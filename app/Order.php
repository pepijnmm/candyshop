<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status','trackcode','totalprice','adres_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	public function address()
    {
        return $this->belongsTo('App\Addresses');
    }
	public function products()
    {
        return $this->belongsToMany('App\Products');
    }
}
