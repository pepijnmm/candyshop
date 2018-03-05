<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
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
	public function childeren()
    {
        return $this->hasMany('App\Categorie');
    }
	public function parent()
    {
        return $this->belongsTo('App\Categorie');
    }
	public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
