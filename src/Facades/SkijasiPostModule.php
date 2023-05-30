<?php

namespace NadzorServera\Skijasi\Module\Post\Facades;

use Illuminate\Support\Facades\Facade;

class SkijasiPostModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'skijasi-post-module';
    }
}
