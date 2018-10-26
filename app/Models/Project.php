<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function columns()
    {
        return $this->hasMany('App\Models\Columns');
    }

    public function project()
    {
        return $this->hasMany('App\Models\Mob');
    }
}
