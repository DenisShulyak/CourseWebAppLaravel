@extends('layouts.site')
@section('content')
    <header>

            <div class="row">
               <h4> </h4>
    <article>

             <div class="twelve columns">
                 <h1>{{$course['title']}}</h1>
                      <p class="excerpt">
                     Начало курса: <b>{{$course['begin']}}</b>.
                      </p>
   <p class="excerpt">
                     Количество мест: <b>{{$course['number']}}</b>.
                      </p>
                 <p class="excerpt">
                     Свободных мест: <b>{{$course['busy']}}</b>.
                 </p>
             </div>

    </article>


            </div>

    </header>

<!-- ######################## Section ######################## -->

<section class="section_light">


      <div class="row">


      <p> <img src="{{asset("storage/images/".$course['img'])}}" alt="desc" width=400 align=left hspace=30>
      {{$course['description']}}
          <br>
          @if($course->begin < date('Y-m-d H:i:s') || $course->busy <= 0)
              <a href="#">Запись запрещена</a>
          @else
          <a href="/enrol/{{$course->id}}">Записаться</a>
          @endif
      </p>

      </div>
</section>
@endsection
