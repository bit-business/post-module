<?php

namespace NadzorServera\Skijasi\Module\Post\Helpers;

class Route
{
    public static function getController($key)
    {
        // get config 'controllers' from config/skijasi-post.php
        $controllers = config('skijasi-post.controllers');

        // if the key is not found, return $key
        if (! isset($controllers[$key])) {
            return 'NadzorServera\\Skijasi\\Module\\Post\\Controllers\\'.$key;
        }

        // return the value of the key
        return $controllers[$key];
    }
}
