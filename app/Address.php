<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $table = 'addresses';
    public $rules = [
        'user_id' => 'required',
        'street_name' => 'required',
        'house_number'=>'required',
        'zip_code'=>'required',
    ];
    public $ruleschange = [
        'street_name' => 'required',
        'house_number'=>'required',
        'zip_code'=>'required',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'street_name', 'house_number', 'zip_code',
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
}
