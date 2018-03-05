<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
	protected $table = 'addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'streetname', 'housenumber', 'postcode','telephonenumber',
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
}
