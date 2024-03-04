<?php

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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//===== LOGIN CONTROLLER ======//
    Route::get('/', function () {
        if (Session::has('user_info_sess')){ return view('index'); }
        else                               { return view('auth.login'); } // if session doesn't exist/logout
    })
    ->name('index'); //main/homepage
    //->middleware('auth');
    Route::post('/authenticate', 'Auth\LoginController@authenticate');
    Route::get('about', 'HomeController@about')->name('home.about');

//===== HOME CONTROLLER ======//

    //User Management
    Route::get('user-management/create', 'HomeController@userCreate')->name('user.create');
    Route::post('user-management/save', 'HomeController@userSave')->name('user.save');
    Route::get('user-management/list', 'HomeController@userList')->name('user.list');
    Route::get('user-management/edit/{id}', 'HomeController@userEdit')->name('user.edit');
    Route::post('user-management/update', 'HomeController@userUpdate')->name('user.update');

    //Profile Management
    Route::get('profile-management/change-password-field', 'HomeController@changePasswordField')->name('password.change.x');
    Route::post('profile-management/update-password-action', 'HomeController@updatePasswordAction')->name('password.update.x');

    //Member Management
    Route::get('member-management/create', 'HomeController@memberCreate')->name('member.create');
    Route::post('member-management/save', 'HomeController@memberSave')->name('member.save');
    Route::get('member-management/list', 'HomeController@memberList')->name('member.list');
    Route::get('member-management/edit/{id}', 'HomeController@memberEdit')->name('member.edit');
    Route::post('member-management/update', 'HomeController@memberUpdate')->name('member.update');
    
//===== /HOME CONTROLLER ======//

    Auth::routes(['verify' => true]);
    Route::get('{any}', 'HomeController@index');
