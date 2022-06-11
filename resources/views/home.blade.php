<?php
$coursesIds = \App\Models\UserCourses::whereUserId(Auth::id())->get();
$courses = [];
foreach ($coursesIds as $coursesId){
    $courses[] = \App\Models\Course::whereId($coursesId['course_id'])->first();
}
$now = new DateTime();
$now->format('Y-m-d H:i:s');
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-img">
                        <img height="200px" width="200px" src="{{asset("storage/images/" . Auth::user()['img'])}}">
                    </div>
                    {{ __('Login: ' . Auth::user()['login']) }}
                    <p>Курсы</p>
                    @foreach($courses as $course)
                        <p><a href="/course/{{$course->id}}}"><label>{{$course->title}}</label></a> - <a href="/unsubscribe/{{$course->id}}">Отписаться</a>
                        @if($course->begin <= date('Y-m-d H:i:s') )
                            Активно
                        @endif
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
