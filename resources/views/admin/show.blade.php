@extends('layouts')

@section('head')
    @include('_head')
@endsection
@section('content')
    <a class="btn btn-dark" type="button" href="{{ route('admin.index') }}">Home</a>
    <a class="btn btn-dark" href="{{ route('admin.create', ['model' => $modelAlias]) }}" type="button">Add {{ $modelAlias }}</a>
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
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li>
                                <a href="{{ route('admin.edit', ['model' => $modelAlias, 'id' => $model->id]) }}" class="dropdown-item">edit</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.destroy', ['model' => $modelAlias, 'id' => $model->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item">delete</button>
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
