<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }
}
