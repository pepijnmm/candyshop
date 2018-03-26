<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOnOrder extends Model
{
	protected $table = 'product_on_order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'order_id', 'amount',

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
	public function product()
    {
        return $this->belongsTo('App\Product');
    }
        public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
