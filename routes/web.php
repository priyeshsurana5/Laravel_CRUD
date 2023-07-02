<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Profile Routes
Route::resource('profiles', ProfileController::class);
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::get("datatables",[ProfileController::class,'datatables']);
Route::get("edit/{id}",[ProfileController::class,'edit']);
Route::post("deletedata",[ProfileController::class,'deletedata']);



// Route::get('profiles/datatables', 'ProfileController@datatables')->name('profiles.datatables');

// Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
// Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
// Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
// Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
// Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
// Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
// Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
// Route::get('profiles/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
