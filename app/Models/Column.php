<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    protected $fillable = [
        'name'
    ];

    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
