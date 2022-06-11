@extends('layouts.site')
@section('content')
<section>
  <div class="section_main">

      <div class="row">

          <section class="eight columns">

          <h3> Заголовок   </h3>
            @foreach($courses as $course)
                  <article class="blog_post">

                      <div class="three columns">
                          <a href="/course/{{$course['id']}}" class="th"><img src="{{asset('storage/images/'.$course['img'])}}" alt="desc" /></a>
                      </div>
                      <div class="nine columns">
                          <a href="/course/{{$course['id']}}"><h4>{{$course['title']}}</h4></a>
                          <p>{{$course['description']}}</p>
                          <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button style="display: inline-block;
	box-sizing: border-box;
	padding: 0 20px;
	margin: 0 15px 15px 0;
	outline: none;
	border: none;
	border-radius: 4px;
	height: 32px;
	line-height: 32px;
	font-size: 14px;
	font-weight: 500;
	text-decoration: none;
	color: #fff;
	background-color: #3775dd;
	box-shadow: 0 2px #21487f;
	cursor: pointer;
	user-select: none;
	appearance: none;
	touch-action: manipulation;
	vertical-align: top;" class="btn btn-primary" type="submit">Удалить</button>
                          </form>

                      </div>

                  </article>
            @endforeach

          </section>
          <section class="four columns">
            <H3>  &nbsp; </H3>
             <div class="panel">
              <h3>Админ-панель</h3>

            <ul class="accordion">
              <li class="active">
                <div class="title">
                   <a href="{{ route('courses.create') }}"><h5>Добавить курс</h5></a>
                </div>

              </li>
            </ul>

             </div>
          </section>
      </div>
    </div>
</section>
@endsection
