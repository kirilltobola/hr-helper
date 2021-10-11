@extends('layouts')

@section('head')
    @include('_head')
@endsection

@section('content')
    <a class="btn btn-dark" type="button" href="{{ route('admin.index') }}">На главную</a>
    <a class="btn btn-dark" href="{{ route('admin.users.create') }}" type="button">Добавить</a>
    <table class="table">
        <thead>
            <tr>
                @foreach($attributes as $attribute)
                    <th scope="col">{{ $attribute }}</th>
                @endforeach
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    @foreach($attributes as $attribute)
                        <td>{{ $user->$attribute }}</td>
                    @endforeach
                    <td>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Действия
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li>
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="dropdown-item">Редактировать</a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item" type="submit">Удалить</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
