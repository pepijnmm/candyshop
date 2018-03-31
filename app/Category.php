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
    ];
    public $ruleschange = [
        'name' => 'required',
        'child_from' => '',
    ];
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
	public function children()
    {
        return $this->hasMany('App\Category','child_from','id');
    }
	public function parent()
    {
        return $this->belongsTo('App\Category','child_from','id');
    }
	public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}