<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Blogs;
use App\Http\Livewire\Produtos;
use App\Http\Livewire\CategoriasProdutos;


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
    return view('welcome');
});

Route::get('/rota/aularotas', function () {
    return view('aularotas');
});

Route::get('/cadnovo', function () {
    return ('Olá cad novo');
});

Route::get('/user/outro', [UserController::class, 'outro']);

Route::resource('user', UserController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/items', function () {
    return view('items');
})->name('items');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/categoria',Categorias::class)->name('categoria');
Route::middleware(['auth:sanctum', 'verified'])->get('/blog',Blogs::class)->name('blog');
Route::middleware(['auth:sanctum', 'verified'])->get('/categoriasprodutos',CategoriasProdutos::class)->name('categoriasprodutos');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos',Produtos::class)->name('produtos');


