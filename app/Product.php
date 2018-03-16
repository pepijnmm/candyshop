<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        public $rules = [
        'name' => 'required||unique:posts|max:100',
        'price' => 'required|max:30|regex:/^[0-9]{3}+\.?[0-9]{2}$/',
        'description' => 'required|max:500',
        'stock' => 'required',
        'weight' => 'required',
        'image_location' => 'required',
        'discount' => '',
    ];
    protected $fillable = [
        'name', 'price','description','stock','weight','image_location','discount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
	public function Categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function Orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
