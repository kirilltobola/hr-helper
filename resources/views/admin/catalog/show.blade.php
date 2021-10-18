@extends('layouts')

@section('head')
    @include('_head')
@endsection
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a class="me-2 btn btn-dark" type="button" href="{{ route('admin.index') }}">На главную</a>
        <a class="btn btn-dark" href="{{ route('admin.create', ['model' => $modelAlias]) }}" type="button">Добавить</a>
    </div>

    <div class="table-responsive">
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
            @foreach($models as $model)
                <tr>
                    @foreach($attributes as $attribute)
                        <td>{{ $model->$attribute }}</td>
                    @endforeach
                    <td>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Действия
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li>
                                    <a href="{{ route('admin.edit', ['model' => $modelAlias, 'id' => $model->id]) }}" class="dropdown-item">Редактировать</a>
                                </li>
                                @if ($model->id != 1)
                                    <li>
                                        <a href="{{ route('admin.delete', ['model' => $modelAlias, 'id' => $model->id]) }}" class="dropdown-item">Удалить</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
