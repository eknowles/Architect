<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * Get all of the Pages that are assigned this link.
     */
    public function pages()
    {
        return $this->morphedByMany('App\Page', 'linkable');
    }

    /**
     * Get all of the Projects that are assigned this link.
     */
    public function projects()
    {
        return $this->morphedByMany('App\Project', 'linkable');
    }
}
