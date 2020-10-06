<?php

namespace App\Http\Controllers\Web;

use App\Course;
use App\Http\Controllers\Controller;
use App\Statistic;

class PagesController extends Controller
{
    public function __construct()
    {
        Statistic::add();
    }

    public function getHome()
    {
        $courses = Course::getFormOptions();

        return view('home', compact('courses'));
    }

    public function getCourseForm()
    {
        $courses = Course::getFormOptions();

        return view('course-form', compact('courses'));
    }
}
