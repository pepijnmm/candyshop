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
        'user_id', 'session_id', 'status', 'track_code', 'total_price', 'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
	public function User()
    {
        return $this->belongsTo('App\User');
    }
	public function Address()
    {
        return $this->belongsTo('App\Address');
    }
	public function Products()
    {
        return $this->belongsToMany('App\Product')->withPivot('amount');
    }
}
