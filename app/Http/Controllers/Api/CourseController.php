<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::get();

        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return new CourseResource($course);
    }
}
