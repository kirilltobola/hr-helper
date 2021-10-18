@extends('layouts')

@section('head')
    @include('_head')
@endsection
@section('content')
<div class="d-flex flex-wrap flex-row w-100">
    <div class="d-flex justify-content-end mb-3 w-100">
        <div class="me-auto">
            <button class="btn btn-dark d-xl-none hide-form-btn" type="button">Фильтрация</button>
        </div>
        <a class="btn btn-dark" href="{{route('cvs.create')}}">Добавить резюме</a>
    </div>
    <div class="d-flex flex-nowrap w-100">
        <div class="me-4 border d-none d-xl-block bg-white" id="filterFrom" style="z-index:1">
            <h3 class="text-center">Фильтрация</h3>
            <form action="{{route('dashboard')}}" method="get">
                <fieldset>
                    <legend class="text-center">По имени</legend>
                    <div class="mx-sm-2">
                        <input type="text" class="form-control" id="searchByName" placeholder="Введите имя"
                               name="nameSearch">
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-center">По позиции</legend>
                    <div class="d-flex form-check flex-column ms-2">
                        @foreach($positions as $key => $position)
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="position_id[]"
                                   value={{$key}}>{{$position}}
                        </label>
                        @endforeach
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-center">По уровню</legend>
                    <div class="d-flex form-check flex-column ms-2">
                        @foreach($programming_levels as $key => $level)
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="programming_level_id[]"
                                   value={{$key}}>{{$level}}
                        </label>
                        @endforeach
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-center">По дате</legend>
                    <div class="d-flex flex-column justify-content-center ms-1">
                        <div class="d-flex form-group flex-row mb-1">
                            <label for="dateFrom" class="align-self-center">От: </label>
                            <input class="form-control mx-sm-2" type="date" id="dateFrom" name="dateFrom">
                        </div>
                        <div class="d-flex form-group flex-row">
                            <label for="dateTo" class="align-self-center">До: </label>
                            <input class="form-control mx-sm-2" type="date" id="dateTo" name="dateTo">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-center">По решению</legend>
                    <div class="d-flex form-check flex-column ms-2">
                        @foreach($statuses as $key => $status)
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="status_id[]"
                                   value={{$key}}>{{$status}}
                        </label>
                        @endforeach
                    </div>
                </fieldset>
                <div class="d-flex justify-content-center mb-1">
                    <button class="btn btn-dark" type="submit">Применить фильтры</button>
                </div>
            </form>
        </div>
        <div class="table-responsive w-100">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <p class="mb-0">Имя</p>
                                <form action="{{route('dashboard')}}" method="get">
                                    <input type="hidden" name="sort" value="name">
                                    <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                    <button class="btn btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th class="text-center" scope="col">
                            <div class="d-flex flex-row justify-content-center">
                                <p class="mb-0">email</p>
                            </div>
                        </th>
                        <th class="text-center" scope="col">
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <p class="mb-0">Позиция</p>
                                <form action="{{route('dashboard')}}" method="get">
                                    <input type="hidden" name="sort" value="position_id">
                                    <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                    <button class="btn btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th class="text-center" scope="col">
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <p class="mb-0">Уровень<p>
                                <form action="{{route('dashboard')}}" method="get">
                                    <input type="hidden" name="sort" value="programming_level_id">
                                    <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                    <button class="btn btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th class="text-center" scope="col">
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <p class="mb-0">Дата собеседования<p>
                                <form action="{{route('dashboard')}}" method="get">
                                    <input type="hidden" name="sort" value="date">
                                    <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                    <button class="btn btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th class="text-center" scope="col">
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <p class="mb-0">Решение<p>
                                <form action="{{route('dashboard')}}" method="get">
                                    <input type="hidden" name="sort" value="status_id">
                                    <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                    <button class="btn btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th class="text-center" scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cvs as $cv)
                    <tr>
                        <th scope="row" class="text-center">{{$cv->candidate->name}}</th>
                        <td class="text-center">{{$cv->candidate->email}}</td>
                        <td class="text-center">{{$cv->position->name}}</td>
                        <td class="text-center">{{$cv->level->name}}</td>
                        <td class="text-center">{{$cv->date}}</td>
                        <td class="text-center">
                            <form action="{{route('status', ['id' => $cv->id])}}" method="post">
                                @csrf
                                <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="cv_status"
                                        onchange="this.form.submit()">
                                    @foreach($statuses as $key => $status)
                                        @if($status == $cv->status->name)
                                            <option selected value={{$cv->status->id}}>{{$cv->status->name}}</option>
                                        @else()
                                            <option value={{$key}}>{{$status}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        Действия
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <li>
                                            <a href="{{route('cvs.show', ['cv' => $cv->id])}}"
                                               class="dropdown-item">Показать</a>
                                        </li>
                                        <li>
                                            <a href="{{route('cvs.edit', ['cv' => $cv->id])}}"
                                               class="dropdown-item">Изменить</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset('js/hide_filter_from.js')}}"></script>
<script src="{{asset('js/toggle_filter_form.js')}}"></script>
@endsection
