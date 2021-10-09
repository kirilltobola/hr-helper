@extends('layouts')

@section('head')
    @include('cv._head')
@endsection
@section('content')
    <h2>{{$cv->candidate->name}}</h2>
    <p>email : {{$cv->candidate->email}}</p>
    <p>Позиция: {{$cv->position->name}}</p>
    <p>Уровень: {{$cv->programming_level->name}}</p>
    <p>Дата собеседования: {{$cv->date}}</p>
    <p>Статус: {{$cv->status->name}}</p>
    <div>
        <label>Ключевые навыки:</label>
        <textarea>{{$cv->skills}}</textarea>
    </div>
    <div>
        <label>Резюме:</label>
        <textarea>{{$cv->cv}}</textarea>
    </div>
    <div>
        <label>Опыт:</label>
        <textarea>{{$cv->experience}}</textarea>
    </div>

    <a type="button" href="{{route('cvs.save',['cv' => $cv->id])}}">cохранить</a>
    <form action="{{route('cvs.destroy',['cv' => $cv->id])}}" method="post">
        @csrf
        @method('delete')

        <button type="submit" class="btn">удалить cv</button>
    </form>
@endsection
