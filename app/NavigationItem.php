<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $table = 'navigation_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'action', 'route', 'child_from',
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
        return $this->hasMany('App\NavigationItem');
    }
    public function Parent()
    {
        return $this->belongsTo('App\NavigationItem');
    }
}
