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

    public static function add($fields)
    {
        $comment = new static;
        $comment->fill($fields);
        $comment->user_id = $fields['user']->id;
        $comment->save();
        return $comment;
    }
    
    public function toggleStatus($comment)
    {
        if ($comment->published === 0) {
            $comment->published = self::IS_PUBLISHED;
        } else {
            $comment->published = self::IS_DRAFT;
        }
        $comment->save();
    }
}
