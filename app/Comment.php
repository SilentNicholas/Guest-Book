<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    use Sluggable;

    /**
     * @const int
     */
    public const IS_PUBLISHED = 1;

    /**
     * @const int
     */
    public const IS_DRAFT = 0;

    /**
     * @var array
     */
    protected $fillable = ['title', 'text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @param array $fields
     * @return Comment
     */
    public static function add(array $fields)
    {
        $comment = new static;
        $comment->fill($fields);
        $comment->user_id = $fields['user']->id;
        $comment->save();
        return $comment;
    }

    /**
     * @param Comment $comment
     */
    public function toggleStatus(Comment $comment)
    {
        if ($comment->published === 0) {
            $comment->published = self::IS_PUBLISHED;
        } else {
            $comment->published = self::IS_DRAFT;
        }
        $comment->save();
    }
}
