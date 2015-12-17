<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Project extends Model
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function scopePublic($query)
    {
        return $query->where('public', 1);
    }

    public function scopePrivate($query)
    {
        return $query->where('public', 0);
    }
}
