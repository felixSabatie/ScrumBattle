<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function column()
    {
        return $this->belongsTo('App\Models\Column');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
