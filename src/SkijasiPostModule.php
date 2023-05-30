<?php

namespace NadzorServera\Skijasi\Module\Post;

class SkijasiPostModule
{
    protected $protected_tables = [
        'categories',
        'comments',
        'posts',
        'post_tag',
        'tags',
    ];

    public function getProtectedTables()
    {
        return $this->protected_tables;
    }
}
