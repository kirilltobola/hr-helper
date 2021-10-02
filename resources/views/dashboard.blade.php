@extends('layouts')

@section('content')
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-dark" href="{{route('cv_add_get')}}">Добавить резюме</a>
        </div>
        <div class="d-flex flex-row">
            <div class="me-4 border">
                <h3 class="text-center">Фильтрация</h3>
                <form action="{{route('dashboard')}}" method="get">
                    @csrf
                    <fieldset>
                        <legend class="text-center">По позиции</legend>
                        <div class="d-flex flex-column ms-2">
                            @foreach($positions as $position)
                                <label><input type="checkbox" name="positions[]" value={{$position->id}}>{{$position->name}}</label>
                            @endforeach
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-center">По уровню</legend>
                        <div class="d-flex flex-column ms-2">
                        @foreach($programming_levels as $level)
                            <label><input type="checkbox" name="levels[]" value={{$level->id}}>{{$level->name}}</label>
                        @endforeach
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-center">По дате</legend>
                        <div class="d-flex flex-column justify-content-center ms-2">
                            <label>От<input type="date" name="dateFrom"></label>
                            <label>До<input type="date" name="dateTo"></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-center">По решению</legend>
                        <div class="d-flex flex-column ms-2">
                            @foreach($statuses as $status)
                                <label><input type="checkbox" name="statuses[]" value={{$status->id}}>{{$status->name}}</label>
                            @endforeach
                        </div>
                    </fieldset>
                    <input class="btn btn-dark" type="submit" value="Применить фильтры">
                </form>
            </div>
            <div class="d-flex align-items-start flex-fill">
                <table class="table table-bordered table-responsive">
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
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cvs as $cv)
                        <tr>
                            <td class="text-center">{{$cv->candidate->name}}</td>
                            <td class="text-center">{{$cv->candidate->email}}</td>
                            <td class="text-center">{{$cv->position->name}}</td>
                            <td class="text-center">{{$cv->programming_level->name}}</td>
                            <td class="text-center">{{$cv->date}}</td>
                            <td class="text-center">
                                <form action="{{route('status', ['id' => $cv->id])}}" method="post">
                                    @csrf
                                    <select name="cv_status" onchange="this.form.submit()">
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
