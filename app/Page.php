<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }
}
