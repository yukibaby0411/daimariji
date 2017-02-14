<?php
if(!isset($_SESSION['members'])) {
    $_SESSION['members'] = \App\Models\User::where('id', '>', 0)->count();
}
Route::get('/404', function () {
    return view('errors.404');
});
//短信重置密码
Route::get('/password/reset/tel', function () {
    if(Auth::check() === FALSE) {
        return view('auth.passwords.tel');
    } else {
        return back();
    }
});
//邮件重置密码
Route::get('/password/tel', 'TelsController@logout');
Route::post('/password/tel', 'TelsController@reset');

//创建会话
Route::get('/sessions/{from}/{key}/{value}', 'SessionsController@create');

Route::get('/ajax/code/tel', 'Ajax\CodeController@tel');
Route::get('/ajax/code/email', 'Ajax\CodeController@email');

Route::get('/test', 'TestController@index');

Route::get('/users/{id}/set', 'UsersController@set');
Route::get('/users/{id}/email/{email}/{action}/{token}', 'UsersController@get_email');
Route::get('/users/{id}/email/{email}', 'UsersController@send_mail');

Route::resource('users', 'UsersController');
/*
get('/users', 'UsersController@index')->name('users.index');
get('/users/{id}', 'UsersController@show')->name('users.show');
get('/users/create', 'UsersController@create')->name('users.create');
post('/users', 'UsersController@store')->name('users.store');
get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
patch('/users/{id}', 'UsersController@update')->name('users.update');
delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');
 */
Auth::routes();
//定义在vendor/laravel/framework/src/Illuminate/Support/Facades/Auth.php
/*
 // Authentication Routes...
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        $this->post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');
 */
Route::get('/home', 'HomeController@index');
Route::get('/promise', 'HomeController@promise');
Route::get('/notices', 'NoticesController@index');
Route::get('/', function () {
    return view('static_pages.home');
});

Route::get('/{miss}', function() {
    return view('errors.404');
});