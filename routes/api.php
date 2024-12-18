<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ExerciseTypeController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ReviewDopamineController;
use App\Http\Controllers\Api\TasksController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');    
});

// http://127.0.0.1:8000/api/documentation


Route::get('/languages',[LanguageController::class,'index']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chapters',[ChapterController::class,'index']);
    Route::get('/lessons',[LessonController::class,'index']); 
    Route::get('/exercises',[ExerciseController::class,'index']);
    Route::get('/review-dopamines',[ReviewDopamineController::class,'index']);
    // Route::get('/exercise-types',[ExerciseTypeController::class,'index']);
    Route::group(['prefix' => 'exercise/'],function(){
        Route::get('vocabulary',[TasksController::class,'vocabulary']);//1
        Route::get('translationA',[TasksController::class,'translationTest1']);//2
        Route::get('video',[TasksController::class,'video']);//3
        Route::get('translation',[TasksController::class,'translation']);//4
        Route::get('question-image',[TasksController::class,'questionImage']);//5
        Route::get('vocabulary-spelling',[TasksController::class,'vocabularySpelling']);//6
        Route::get('pronunciation',[TasksController::class,'pronunciation']);//7
        Route::get('grammar-theory',[TasksController::class,'grammarTeory']);//8
        Route::get('audio-question',[TasksController::class,'audioQuestion']);//9
        Route::get('translationB',[TasksController::class,'translationTest2']);//10
        Route::get('listening',[TasksController::class,'listening']);//11
        Route::get('review',[TasksController::class,'review']);//12
    });
    Route::get('/informations',[InformationController::class,'index']);
// })->middleware(AuthenticateOnceWithBasicAuth::class);



