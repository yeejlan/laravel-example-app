<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'indexAction']);

Route::get('/{module}/{controller}/{action}', function ($module, $controller, $action) {
    $controllerArr = array_map('ucfirst', explode('_', $controller));
    $controller = implode('', $controllerArr);
    $className = 'App\\Http\\Controllers\\' . $module . '\\' . ucfirst($controller) . 'Controller';
    try{
        $class = App::make($className);
    }catch(Illuminate\Contracts\Container\BindingResolutionException $e){
        //class not existed.
        abort(404);
    }

    $action .= 'Action';
    //action not existed.
    if (!method_exists($class, $action)) {
        abort(404);
    }
    // Call action and return response.
    return app()->call([$class, $action]);
});

Route::get('/{controller}/{action}', function ($controller, $action) {
    $controllerArr = array_map('ucfirst', explode('_', $controller));
    $controller = implode('', $controllerArr);
    $className = 'App\\Http\\Controllers\\' . ucfirst($controller) . 'Controller';
    try{
        $class = App::make($className);
    }catch(Illuminate\Contracts\Container\BindingResolutionException $e){
        //class not existed.
        abort(404);
    }

    $action .= 'Action';
    //action not existed.
    if (!method_exists($class, $action)) {
        abort(404);
    }
    // Call action and return response.
    return app()->call([$class, $action]);
});