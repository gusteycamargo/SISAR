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
    return view('main.main');
});
Route::get('/negado', function () {
    return view('negado.index');
});
Route::resource('matriculas', 'Matriculas');
Route::get('/alunosmatricula/{id}', 'Alunos@redirectMatricula');

Route::resource('alunos', 'Alunos');
Route::resource('cursos', 'Cursos');
Route::resource('disciplinas', 'Disciplinas');
Route::resource('professores', 'Professores');
