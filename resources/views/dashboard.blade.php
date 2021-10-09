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
                <div class="me-4 border d-none d-xl-block bg-white" id="filterFrom">
                        <h3 class="text-center">Фильтрация</h3>
                        <form class="form-group" action="{{route('dashboard')}}" method="get">
                            <fieldset>
                                <legend class="text-center">По позиции</legend>
                                <div class="d-flex flex-column ms-2">
                                    @foreach($positions as $position)
                                    <label>
                                        <input type="checkbox" name="position[]" value={{$position->id}}>{{$position->name}}
                                    </label>
                                    @endforeach
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-center">По уровню</legend>
                                <div class="d-flex flex-column ms-2">
                                    @foreach($programming_levels as $level)
                                    <label>
                                        <input type="checkbox" name="programming_level[]" value={{$level->id}}>{{$level->name}}
                                    </label>
                                    @endforeach
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-center">По дате</legend>
                                <div class="d-flex flex-column justify-content-center ms-2">
                                    <label>От: <input type="date" name="dateFrom"></label>
                                    <label>До: <input type="date" name="dateTo"></label>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="text-center">По решению</legend>
                                <div class="d-flex flex-column ms-2">
                                    @foreach($statuses as $status)
                                    <label>
                                        <input type="checkbox" name="status[]" value={{$status->id}}>{{$status->name}}
                                    </label>
                                    @endforeach
                                </div>
                            </fieldset>
                            <input class="btn btn-dark" type="submit" value="Применить фильтры">
                        </form>
                    </div>
                    <div class="d-flex align-items-start flex-fill">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>Имя</p>
                                            <form action="{{route('dashboard')}}" method="get">
                                                <input type="hidden" name="sort" value="name">
                                                <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                                <input type="submit" value="" onclick="this.form.submit()">
                                            </form>
                                        </div>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>email</p>
                                        </div>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>Позиция</p>
                                            <form action="{{route('dashboard')}}" method="get">
                                                <input type="hidden" name="sort" value="position">
                                                <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                                <input type="submit" value="" onclick="this.form.submit()" >

                                            </form>
                                        </div>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>Уровень<p>
                                            <form action="{{route('dashboard')}}" method="get">
                                                <input type="hidden" name="sort" value="programming_level">
                                                <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                                <input type="submit" value="" onclick="this.form.submit()">
                                            </form>
                                        </div>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>Дата<p>
                                            <form action="{{route('dashboard')}}" method="get">
                                                <input type="hidden" name="sort" value="date">
                                                <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                                <input type="submit" value="" onclick="this.form.submit()">
                                            </form>
                                        </div>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p>Решение<p>
                                            <form action="{{route('dashboard')}}" method="get">
                                                <input type="hidden" name="sort" value="status">
                                                <input type="hidden" name="order" value="{{isset($sort) ? $sort : 'asc'}}">
                                                <input type="submit" value="" onclick="this.form.submit()">
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
                                    <td class="text-center">{{$cv->programming_level->name}}</td>
                                    <td class="text-center">{{$cv->date}}</td>
                                    <td class="text-center">
                                        <form action="{{route('status', ['id' => $cv->id])}}" method="post">
                                            @csrf
                                            <select class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example" name="cv_status"
                                                    onchange="this.form.submit()">
                                                @foreach($statuses as $status)
                                                    @if($status->name == $cv->status->name)
                                                        <option selected value={{$status->id}}>{{$status->name}}</option>
                                                    @endif
                                                    @if($status->name != $cv->status->name)
                                                        <option value={{$status->id}}>{{$status->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" name="forma" onchange="location = this.value;">
                                            <option selected disabled>Action</option>
                                            <option value="{{route('cvs.show', ['cv' => $cv->id])}}">View</option>
                                            <option value="{{route('cvs.edit', ['cv' => $cv->id])}}">Edit</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    <script>
        const btn = document.querySelector('.hide-form-btn');
        const div = document.querySelector('#filterFrom');
        const dropmenu = document.querySelector('.actions');
        btn.onclick = function (){
            div.classList.toggle('position-absolute');
            div.classList.toggle('w-100');
            div.classList.toggle('h-100');
            div.classList.toggle('d-none');
            div.classList.toggle('top-10');
            div.classList.toggle('start-0');
            dropmenu.classList.toggle('d-none');

        }
    </script>
    <script>
        let filterForm = $('#filterFrom');
        $(window).resize(function (){
            if($(window).width() >= 1200) {
                filterForm.removeClass('position-absolute');
                filterForm.removeClass('w-100');
                filterForm.removeClass('h-100');
            }else{
                filterForm.addClass('d-none');
            }
            if(filterForm.hasClass('d-none')){
                filterForm.removeClass('position-absolute');
                filterForm.removeClass('top-10');
                filterForm.removeClass('start-0');
                filterForm.removeClass('w-100');
                filterForm.removeClass('h-100');
            }
        })
    </script>
@endsection

