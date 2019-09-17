<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Sluggable;

    public const IS_PUBLISHED = 1;

    public const IS_DRAFT = 0;

    protected $fillable = ['title', 'text'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
