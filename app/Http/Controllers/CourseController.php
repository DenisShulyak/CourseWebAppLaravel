<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        if(!\Auth::user()->is_admin){
            return abort(403);
        }
        $languages = Language::get();
        return view('add')->with(["languages"=>$languages]);
    }

    public function store(Request $request)
    {
        if(!\Auth::user()->is_admin){
            return abort(403);
        }
        if($request->input('number') <= 0){
            return abort(400);
        }
        $course = new Course();
        $course->title = $request->input('name');
        $course->description = $request->input('description');
        $course->begin = $request->input('begin');
        $course->number = $request->input('number');
        $course->busy = $request->input('number');
        $course->language_id = $request->input('language');
        $course->img = 'a1.jpg';
        $course->save();
        return redirect('admin');
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy($id)
    {
        if(!\Auth::user()->is_admin){
            return abort(403);
        }
        $course = Course::whereId($id)->first();
        $course->delete();
        return redirect('admin');
    }
}
