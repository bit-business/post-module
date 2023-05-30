<?php

namespace NadzorServera\Skijasi\Module\Post\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use NadzorServera\Skijasi\Module\Post\SkijasiPostModule;
use NadzorServera\Skijasi\Module\Post\Commands\SkijasiPostSetup;
use NadzorServera\Skijasi\Module\Post\Commands\SkijasiPostTestSetup;
use NadzorServera\Skijasi\Module\Post\Facades\SkijasiPostModule as FacadesSkijasiPost;

class SkijasiPostModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('SkijasiPostModule', FacadesSkijasiPost::class);

        $this->app->singleton('skijasi-post-module', function () {
            return new SkijasiPostModule();
        });

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'skijasi_post');

        $this->publishes([
            __DIR__.'/../Config/skijasi-post.php' => config_path('skijasi-post.php'),
            __DIR__.'/../Seeder' => database_path('seeders/Skijasi/Post'),
        ], 'SkijasiPostModule');

        $this->publishes([
            __DIR__.'/../Swagger' => app_path('Http/Swagger/swagger_models'),
        ], 'SkijasiPostSwagger');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommands();
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(SkijasiPostSetup::class);
        $this->commands(SkijasiPostTestSetup::class);
    }
}
