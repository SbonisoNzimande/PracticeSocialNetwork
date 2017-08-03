<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        // relation
        return $this->belongsTo('App\User');
    }
}
