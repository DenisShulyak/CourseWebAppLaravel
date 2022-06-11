<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use App\Models\UserCourses;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::get();
        $languages = Language::get();
        return view('index')->with(["languages"=>$languages, "courses"=>$courses, "language_id"=>-1]);
    }

    public function byLanguageByStatus($language_id, $status){
        $courses = [];
        switch ($status){
            case "1":
                $courses = Course::whereBusy(0)->whereLanguageId($language_id)->get();
                break;
            case "2":
                $coursesAll = Course::whereLanguageId($language_id)->get();
                foreach ($coursesAll as $course){
                    if($course->begin > date('Y-m-d H:i:s'))
                    {
                        $courses[] = $course;
                    }
                }
                break;
            case "3":
                $coursesAll = Course::whereLanguageId($language_id)->get();
                foreach ($coursesAll as $course){
                    if($course->begin <= date('Y-m-d H:i:s'))
                    {
                        $courses[] = $course;
                    }
                }
                break;
        }
        $languages = Language::get();
        return view('index')->with(["languages"=>$languages, "courses"=>$courses, "language_id"=>$language_id]);
    }

    public function filter($status)
    {
        $courses = [];
        switch ($status){
            case "1":
                $courses = Course::whereBusy(0);
                break;
            case "2":
                $coursesAll = Course::get();
                foreach ($coursesAll as $course){
                    if($course->begin > date('Y-m-d H:i:s'))
                    {
                        $courses[] = $course;
                    }
                }
                break;
            case "3":
                $coursesAll = Course::get();
                foreach ($coursesAll as $course){
                    if($course->begin <= date('Y-m-d H:i:s'))
                    {
                        $courses[] = $course;
                    }
                }
                break;
        }
        $languages = Language::get();
        return view('index')->with(["languages"=>$languages, "courses"=>$courses, "language_id"=>-1]);
    }

    public function home()
    {
        return view('home');
    }

    public function byLanguage($language_id){
        $courses = Course::whereLanguageId($language_id)->get();
        $languages = Language::get();
        return view('index')->with(["languages"=>$languages, "courses"=>$courses, "language_id"=>$language_id]);
    }

    public function viewCourse($id){
        $course = Course::whereId($id)->first();
        $languages = Language::get();
        return view('kurs')->with(["languages"=>$languages, "course"=>$course, "language_id"=>-1]);
    }


    public function admin()
    {
        if(!\Auth::user()->is_admin){
            return abort(403);
        }
        $courses = Course::get();
        $languages = Language::get();
        return view('admin')->with(["languages"=>$languages, "courses"=>$courses, "language_id"=>-1]);
    }

    public function enrol($id){
        $user_id = \Auth::id();
        $user_course_check = UserCourses::whereUserId($user_id)->whereCourseId($id)->get();
        $course = Course::whereId($id)->first();
        if(count($user_course_check) != 0 || $course->busy === 0){
            return view('home');
        }
        $user_course = new UserCourses();
        $user_course->user_id = \Auth::id();
        $user_course->course_id = $id;
        $user_course->save();

        $course->busy = $course->busy - 1;
        $course->save();
        return view('home');
    }

    public function unsubscribe($id){
        $user_id = \Auth::id();
        $course = Course::whereId($id)->first();
        $user_course = UserCourses::whereUserId($user_id)->whereCourseId($id)->first();

        if($user_course == null || strtotime(date('Y-m-d H:i:s') . " + 1 day") >= $course->begin){
            return view('home');
        }
        $user_course->delete();
        $course->busy = $course->busy + 1;
        $course->save();
        return view('home');
    }
}
