<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\informationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PublicationController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FollowedNotification;
use Illuminate\Support\Facades\Notification;


Route::get('/verify_email/{hash}', [ProfilController::class, 'verify_email']);

// Route::name('profiles.')->prefix('/profiles')->group(function () {
//     Route::controller(ProfilController::class)->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/create', 'create')->name('create');
//         Route::post('/', 'store')->name('store');
//         Route::get('/{profile}', 'show')->name('show');
//         Route::delete('/{profile}', 'destroy')->name('destroy');
//         Route::get('/{profile}/edit', 'edit')->name('edit');
//         Route::put('/{profile}', 'update')->name('update');
//     });
// });

Route::resource('profiles', ProfilController::class);
Route::post('/profiles/{profile}/follow', [ProfilController::class, 'follow'])->name('profiles.follow');

Route::resource('publications', PublicationController::class);
// Like Route
Route::post('/publications/{publication}/like', [PublicationController::class, 'like'])->name('publications.like');
// Comment Route
Route::post('/publications/{publication}/comment', [PublicationController::class, 'comment'])->name('publications.comment');
// Toggle Save Routea
Route::post('/publications/{publication}/toggleSave', [PublicationController::class, 'toggleSave'])->name('publications.toggleSave');

Route::get('/my-saves', [PublicationController::class, 'allSaves'])->name('allSaves');


Route::get('/settings', [informationController::class, "index"])->name('settings.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, "show"])->name('login.show');
    Route::post('/login', [LoginController::class, "login"])->name('login');
});

Route::get('/', [homeController::class, "index"])->name('homepage');
Route::get('/logout', [LoginController::class, "logout"])->name('login.logout')->middleware('auth');



Route::get('/route', function () {
    dd(Route::current());
    // dd(Route::currentRouteAction());
    // dd(Route::currentRouteName());
    // dd(Route::currentRouteParameters());

    // dd(Route::currentRouteOptions());

    // dd(Route::getRoutes());
    
});


Route::view('/form', 'form');
Route::post('/form', function (Request $request) {
    dd($request->input('name'));
})->name('form');


Route::get('/cookie/get', function (Request $request) {
    dd($request->cookie('age'));
});

Route::get('/cookie/set/{cookie}', function ($cookie) {
    $response = new Response();
    $cookieObject = cookie()->forever('age', $cookie);
    return $response->withCookie($cookieObject);

});
Route::get('/headers', function (Request $request) {
    $response = new Response(['data' => $request->headers->all()]);
    // dd($request->url(),$request->fullUrl());
    // dd($request->path());
    // dd($request->is('profiles/{profile}'));

});

Route::get('/notifications', function () {
    $notifications = Auth::user()->unreadNotifications; // Fetch all notifications
    return view('notifications.all', compact('notifications'));
})->name('notifications.all');
Route::get('/notifications/read/{id}', function ($id) {
    $user = Auth::user();
    
    if (!$user) {
        return redirect()->back()->with('error', 'User not authenticated');
    }
    
    $notification = $user->notifications()->where('id', $id)->first();
    
    if ($notification) {
        $notification->markAsRead();
    }

    return redirect()->back();
})->name('notifications.read');

