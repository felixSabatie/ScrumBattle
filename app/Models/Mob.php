<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mob extends Model
{
    //
    public function project()
    {
        return $this->hasOne('App\Models\Project');
    }
}
