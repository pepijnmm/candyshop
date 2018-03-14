<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'child_from',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
	public function Children()
    {
        return $this->hasMany('App\Category');
    }
	public function Parent()
    {
        return $this->belongsTo('App\Category');
    }
	public function Products()
    {
        return $this->hasMany('App\Product');
    }
}
