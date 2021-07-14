<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    Log::channel('my')->info('welcome!');
    return view('welcome');
});

Route::get('/db', function () {
    $users = DB::select('select * from users where active = ?', [1]);
    return view('user.index', ['users' => $users]);
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