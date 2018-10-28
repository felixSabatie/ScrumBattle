<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = [
        'name', 'mob_id',
    ];

    public function columns()
    {
        return $this->hasMany('App\Models\Column');
    }

    public function mob()
    {
        return $this->belongsTo('App\Models\Mob');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withPivot('total_points', 'done_points');
    }
}
