<?php

use Illuminate\Support\Facades\Route;
use NadzorServera\Skijasi\Middleware\ApiRequest;
use NadzorServera\Skijasi\Middleware\SkijasiCheckPermissions;
use NadzorServera\Skijasi\Module\Post\Helpers\Route as HelpersRoute;

$api_route_prefix = \config('skijasi.api_route_prefix');

Route::group(['prefix' => $api_route_prefix, 'as' => 'skijasi.', 'middleware' => [ApiRequest::class]], function () {
    Route::group(['prefix' => 'module/post/v1'], function () {
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', HelpersRoute::getController('PostController@browse'));
            Route::get('/browse-analytics', HelpersRoute::getController('PostController@browseWithAnalytics'))->middleware(SkijasiCheckPermissions::class.':browse_posts');
            Route::get('/popular', HelpersRoute::getController('PostController@browseMostPopularPost'));
            Route::get('/read', HelpersRoute::getController('PostController@read'))->middleware(SkijasiCheckPermissions::class.':read_posts');
            Route::get('/read-slug', HelpersRoute::getController('PostController@readBySlug'));
            Route::get('/author', HelpersRoute::getController('PostController@author'));
            Route::post('/add', HelpersRoute::getController('PostController@add'))->middleware(SkijasiCheckPermissions::class.':add_posts');
            Route::put('/edit', HelpersRoute::getController('PostController@edit'))->middleware(SkijasiCheckPermissions::class.':edit_posts');
            Route::delete('/delete', HelpersRoute::getController('PostController@delete'))->middleware(SkijasiCheckPermissions::class.':delete_posts');
            Route::delete('/delete-multiple', HelpersRoute::getController('PostController@deleteMultiple'))->middleware(SkijasiCheckPermissions::class.':delete_posts');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', HelpersRoute::getController('CategoryController@browse'));
            Route::get('/read', HelpersRoute::getController('CategoryController@read'));
            Route::get('/read-slug', HelpersRoute::getController('CategoryController@readBySlug'));
            Route::post('/add', HelpersRoute::getController('CategoryController@add'))->middleware(SkijasiCheckPermissions::class.':add_categories');
            Route::put('/edit', HelpersRoute::getController('CategoryController@edit'))->middleware(SkijasiCheckPermissions::class.':edit_categories');
            Route::delete('/delete', HelpersRoute::getController('CategoryController@delete'))->middleware(SkijasiCheckPermissions::class.':delete_categories');
            Route::delete('/delete-multiple', HelpersRoute::getController('CategoryController@deleteMultiple'))->middleware(SkijasiCheckPermissions::class.':delete_categories');
        });

        Route::group(['prefix' => 'tag'], function () {
            Route::get('/', HelpersRoute::getController('TagController@browse'));
            Route::get('/read', HelpersRoute::getController('TagController@read'));
            Route::get('/read-slug', HelpersRoute::getController('TagController@readBySlug'));
            Route::post('/add', HelpersRoute::getController('TagController@add'))->middleware(SkijasiCheckPermissions::class.':add_tags');
            Route::put('/edit', HelpersRoute::getController('TagController@edit'))->middleware(SkijasiCheckPermissions::class.':edit_tags');
            Route::delete('/delete', HelpersRoute::getController('TagController@delete'))->middleware(SkijasiCheckPermissions::class.':delete_tags');
            Route::delete('/delete-multiple', HelpersRoute::getController('TagController@deleteMultiple'))->middleware(SkijasiCheckPermissions::class.':delete_tags');
        });

        Route::group(['prefix' => 'comment'], function () {
            Route::get('/', HelpersRoute::getController('CommentController@browse'))->middleware(SkijasiCheckPermissions::class.':browse_comments');
            Route::get('/post', HelpersRoute::getController('CommentController@getCommentByPostSlug'));
            Route::get('/read', HelpersRoute::getController('CommentController@read'))->middleware(SkijasiCheckPermissions::class.':read_comments');
            Route::post('/add', HelpersRoute::getController('CommentController@add'))->middleware(SkijasiCheckPermissions::class.':add_comments');
            Route::put('/edit', HelpersRoute::getController('CommentController@edit'))->middleware(SkijasiCheckPermissions::class.':edit_comments');
            Route::delete('/delete', HelpersRoute::getController('CommentController@delete'))->middleware(SkijasiCheckPermissions::class.':delete_comments');
            Route::delete('/delete-multiple', HelpersRoute::getController('CommentController@deleteMultiple'))->middleware(SkijasiCheckPermissions::class.':delete_comments');
        });
    });
});
