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

        public $rules = [
        'name' => 'required|unique:categories,name',
        'child_from' => '',
        'image_location'=>'',
    ];
    public $ruleschange = [
        'name' => 'required',
        'child_from' => '',
        'image_location'=>'',
    ];
    protected $fillable = [
        'name', 'child_from','image_location',
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
        return $this->hasMany('App\Category','child_from','id');
    }
	public function Parent()
    {
        return $this->belongsTo('App\Category','child_from','id');
    }
	public function Products()
    {
        return $this->belongsToMany('App\Product');
    }
}