<?php

use App\Http\Controllers\AnswerController;
use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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
    return Inertia('Home');
});
Route::get('/questions',[QuestionController::class,'index']);
Route::post('/questions',[QuestionController::class,'store']);
Route::put('/answers',[AnswerController::class,'update']);