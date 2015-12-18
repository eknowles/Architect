<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }
}
