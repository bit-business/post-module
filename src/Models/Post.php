<?php

namespace NadzorServera\Skijasi\Module\Post\Models;

use Illuminate\Database\Eloquent\Model;
use NadzorServera\Skijasi\Models\User;

class Post extends Model
{
    protected $table = null;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('skijasi.database.prefix');
        $this->table = $prefix.'posts';
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'user_id',
        'parent_id',
        'category_id',
        'title',
        'title_en',
        'title_it',
        'content_en',
        'content_it',
        'link',
        'slug',
        'meta_title',
        'meta_description',
        'summary',
        'content',
        'thumbnail',
        'published',
        'comment_count',
        'created_at',
        'updated_at',
        'published_at',
    ];

    protected $hidden = ['pivot'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, config('skijasi.database.prefix').'post_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
