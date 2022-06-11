@extends('layouts.site')
@section('content')
<section>

  <div class="section_main">

      <div class="row">

          <section class="eight columns">
@if($language_id != -1)
              <div><a href="/language/{{$language_id}}/status/1">Нет мест</a> <a href="/language/{{$language_id}}/status/2">Активно</a> <a href="/language/{{$language_id}}/status/3">Прошли</a></div>
              @else
                  <div><a href="/status/1">Нет мест</a> <a href="/status/2">Активно</a> <a href="/status/3">Прошли</a></div>
              @endif
                  <br>
              @foreach($courses as $course)
                  <article class="blog_post">

                      <div class="three columns">
                          <a href="/course/{{$course['id']}}" class="th"><img src="{{asset("storage/images/". $course['img'])}}" alt="desc" /></a>
                      </div>
                      <div class="nine columns">
                          <a href="/course/{{$course['id']}}"><h4>{{$course['title']}}</h4></a>
                          <p>{{$course['description']}}</p>
                      </div>
                  </article>
              @endforeach
          </section>
      </div>
    </div>
</section>
@endsection
