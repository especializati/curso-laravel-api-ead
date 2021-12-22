<?php

use App\Http\Controllers\Api\{
    CourseController
};
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});
