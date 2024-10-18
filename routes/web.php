<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\GoogleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/callback/google', function () {
    $user = Socialite::driver('google')->user();

    // Simpan user ke database atau lakukan tindakan lainnya
    // ...

    return redirect('/home'); // Ganti '/home' dengan halaman tujuan setelah login
});