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
    return view('home');
})->name('initial');

Route::get('/negado', function () {
    return view('negado.index');
})->middleware('auth');;

Route::resource('matriculas', 'Matriculas')->middleware('auth:admin');;
Route::get('/alunosmatricula/{id}', 'Alunos@redirectMatricula')->middleware('auth:admin');;
Route::resource('alunos', 'Alunos')->middleware('auth:admin');;
Route::resource('cursos', 'Cursos')->middleware('auth:admin');
Route::resource('disciplinas', 'Disciplinas')->middleware('auth:admin');;
Route::resource('professores', 'Professores')->middleware('auth:admin');;

Route::get('/provas', 'Provas@index')->name('prova')->middleware('auth');;
Route::get('/admin', 'AdminController@index')->name('home-admin');
Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('login-admin');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('login-admin-submit');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('logout-admin');

Auth::routes();

Route::get('/home',function () {
    return view('main.main');
})->name('home')->middleware('auth');;
