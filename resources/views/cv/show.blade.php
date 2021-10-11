@extends('layouts')

@section('head')
    @include('cv._head')
@endsection

@section('content')
    <div class="container mb-3" >
        <h2>{{$cv->candidate->name}}</h2>

        <table class="table table-hover text-nowrap">
            <tr>
                <th scope="row">Email:</th>
                <td>{{$cv->candidate->email}}</td>
            </tr>
            <tr>
                <th scope="row">Позиция:</th>
                <td>{{$cv->position->name}}</td>
            </tr>
            <tr>
                <th scope="row">Уровень:</th>
                <td>{{$cv->level->name}}</td>
            </tr>
            <tr>
                <th scope="row">Дата собеседования:</th>
                <td>{{$cv->date}}</td>
            </tr>
            <tr>
                <th scope="row">Статус:</th>
                <td>{{$cv->status->name}}</td>
            </tr>
        </table>
        <div class="mb-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark">Ключевы навыки:</li>
                <li class="list-group-item list-group-item-light">{!! $cv->skills !!}</li>
            </ul>
        </div>
        <div class="mb-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark">Резюме:</li>
                <li class="list-group-item list-group-item-light">{!! $cv->cv !!}</li>
            </ul>
        </div>
        <div class="mb-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark">Опыт:</li>
                <li class="list-group-item list-group-item-light">{!! $cv->experience !!}</li>
            </ul>

        </div>
        <div class="d-flex flex-row">
            <a class="btn btn-primary" href="{{route('cvs.save',['cv' => $cv->id])}}" role="button">Сохранить</a>
            <div class="ms-auto ">
                <form action="{{route('cvs.destroy',['cv' => $cv->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-dark">Удалить cv</button>
                </form>
            </div>
        </div>
    </div>
@endsection
