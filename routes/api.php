<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('professores/load', 'Professores@loadJson');
Route::get('cursos/load', 'Cursos@loadJson');
Route::post('matriculas', 'Matriculas@store');
Route::resource('alunos', 'Alunos');
Route::resource('cursos', 'Cursos');
Route::resource('disciplinas', 'Disciplinas');
Route::resource('professores', 'Professores');

