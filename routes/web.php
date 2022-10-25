<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiswaController;
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
    return view('master.dashboard');
});
//Route::get('/dashboard', function () {
//    return view('master.dashboard');
//});

//Route::get('/master_project', function () {
//    return view('master.master_project');
//});

//Route::get('/master_contact', function () {
//    return view('master.master_contact');
//});

//Route::get('/master_siswa', function () {
//    return view('master.master_siswa');
//});

//Guest

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login'); //->middleware('guest');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/about', function () {
        return view('about');
    });

    Route::get('/project', function () {
        return view('project');
    });

    Route::get('/contact', function () {
        return view('contact');
    });
});


//Admin

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('master_siswa/{id_siswa}/hapus', [SiswaController::class, 'hapus'])->name('master_siswa.hapus');
    Route::resource('master_siswa', SiswaController::class)->middleware('auth');
    Route::get('master_project/create/{id_siswa}', [ProjectController::class, 'tambah'])->name('master_project.tambah');
    Route::get('master_project/{id_siswa}/hapus', [ProjectController::class, 'hapus'])->name('master_project.hapus');
    Route::resource('master_project', ProjectController::class);
    Route::resource('master_contact', ContactController::class);
    Route::get('master_contact/create/{id_siswa}', [ContactController::class, 'tambah'])->name('master_contact.tambah');
    Route::get('master_contact/{id_siswa}/hapus', [ContactController::class, 'hapus'])->name('master_contact.hapus');
});

Route::get('/admin', function () {
    return view('layout.admin');
});

Route::resource('home', HomeController::class);
Route::resource('about', AboutController::class);
Route::resource('contact', TContactController::class);
Route::resource('project', TProjectController::class);
