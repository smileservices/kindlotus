<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $data = [
        'tags' => App\Tag::allUsed(),
        'needs' => App\Need::allUsed(),
        'lastCauses' => App\Cause::orderBy('created_at', 'desc')->active()->take(3),
        'lastUpdates' => App\Update::orderBy('created_at', 'desc')->active()->take(3)
    ];
    return view('welcome', $data);
});

Route::group(['prefix' => 'about', 'middleware' => ['web']], function () {
    Route::get('/', function(){
        return view('about/about');
    });
    Route::get('/guide', function(){
        return view('about/guide');
    });
});

Route::get('/home', 'UserController@index')->middleware('auth');

Route::post('/message', 'MessageController@guestMessage');

Route::auth();

// socialite login
Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', 'Auth\AuthController@handleProviderCallback');

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/login','AdminAuth\AuthController@showLoginForm');
    Route::post('/login','AdminAuth\AuthController@login');
    Route::get('/logout','AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('/register', 'AdminAuth\AuthController@create');

    Route::get('/', 'AdminController@index');

    //Password reset Routes...
    Route::post('/password/email','AdminAuth\PasswordController@sendResetLinkEmail');
    Route::post('/password/reset','AdminAuth\PasswordController@reset');
    Route::get('/password/reset/{token?}','AdminAuth\PasswordController@showResetForm');

    //Tags
    Route::get('/tags', 'AdminController@tags');
    Route::post('/tags', 'AdminController@storeTag');
    Route::get('/tags/{tag}', 'AdminController@deleteTag');
    Route::get('/needs/{need}', 'AdminController@deleteNeed');

});



Route::group(['prefix' => 'ngo', 'middleware' => ['web']], function () {

    //Login Routes...
    Route::get('/login','NgoAuth\AuthController@showLoginForm');
    Route::post('/login','NgoAuth\AuthController@login');
    Route::get('/logout','NgoAuth\AuthController@logout');

    // Registration Routes...
    Route::get('/register', 'NgoAuth\AuthController@showRegistrationForm')->middleware('admin');
    Route::post('/register', 'NgoAuth\AuthController@create')->middleware('admin');

    Route::get('/home', 'NgoController@dashboard')->middleware('ngo');

    //Password reset Routes...
    Route::post('/password/email','NgoAuth\PasswordController@sendResetLinkEmail');
    Route::post('/password/reset','NgoAuth\PasswordController@reset');
    Route::get('/password/reset/{token?}','NgoAuth\PasswordController@showResetForm');

    // NGO Profile
    Route::get('/', 'NgoController@index');
    Route::get('/profile/{ngo}', 'NgoController@profile');
    Route::get('/edit', 'NgoController@edit')->middleware('ngo');
    Route::patch('/patch', 'NgoController@update')->middleware('ngo');
    Route::delete('/delete', 'NgoController@destroy')->middleware('ngo');
});

Route::group(['prefix' => 'causes', 'middleware' => ['web']], function () {

    Route::get('/', 'CauseController@index');
    Route::get('/create', 'CauseController@create')->middleware('ngo');
    Route::post('/', 'CauseController@store')->middleware('ngo');
    Route::get('/{cause}/edit', 'CauseController@edit')->middleware('ngo');
    Route::patch('/{cause}', 'CauseController@update')->middleware('ngo');
    Route::delete('/{cause}', 'CauseController@destroy')->middleware('ngo');
    Route::get('/{cause}/delete/media/{media}', 'CauseController@destroyMedia')->middleware('ngo');
    Route::post('/{cause}/active', 'CauseController@active')->middleware('ngo');
    Route::post('/{cause}/success', 'CauseController@success')->middleware('ngo');

    // User interactions
    Route::get('/{cause}/help', 'UserController@help')->middleware('auth');
    Route::get('/{cause}/leave', 'UserController@leave')->middleware('auth');
    Route::post('/{cause}/update', 'CauseController@receiveUpdates');

    // Guest interactions
    Route::get('/{cause}', 'CauseController@show');
});

Route::group(['prefix' => 'user', 'middleware' => ['web']], function() {

    Route::get('/profile/{user}', 'UserController@show');
    Route::get('/ban/{user}', 'UserController@ban')->middleware('admin');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PassController@showResetForm');
    Route::post('password/email', 'Auth\PassController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PassController@reset');
});


Route::group(['prefix' => 'updates', 'middleware' => ['web']], function() {

    Route::get('/{update}/active', 'UpdateController@active')->middleware('admin');
    Route::get('/{update}/delete', 'UpdateController@delete');
//    Route::get('/{update}/report', 'UpdateController@report')->middleware('auth');
    Route::get('/{cause}/media/{media}/remove', 'UpdateController@deleteMedia')->middleware('admin');

});

Route::group(['prefix' => 'search', 'middleware' => ['web']], function() {

    Route::get('/tag/{tag}/{tagName}', 'SearchController@tags')->middleware('web');
    Route::get('/need/{need}/{tagName}', 'SearchController@needs')->middleware('web');
    Route::post('/causes', 'SearchController@causes')->middleware('web');

});



