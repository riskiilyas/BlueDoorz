<?php

use Illuminate\Routing\Router;
use OpenAdmin\Admin\Facades\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/users', \App\Admin\Controllers\UserController::class);
    $router->resource('/room-types', \App\Admin\Controllers\RoomTypeController::class);
    $router->resource('/branch-address', \App\Admin\Controllers\BranchAddressController::class);
    $router->resource('/rooms', \App\Admin\Controllers\RoomController::class);
    $router->resource('/room-images', \App\Admin\Controllers\RoomImageController::class);
    $router->resource('/reservations', \App\Admin\Controllers\ReservationController::class);
    $router->resource('/ratings', \App\Admin\Controllers\RatingController::class);
    $router->resource('/cs', \App\Admin\Controllers\CustomerServiceController::class);

});
