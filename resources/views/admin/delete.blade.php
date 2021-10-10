@extends('layouts')

@section('head')
    @include('_head')
@endsection

@section('content')
    @if($amount > 0)
        <h2>Есть зависимости!</h2>
        <p>Заменить на:</p>
        <form action="{{ route('admin.delete', ['model' => $model, 'id' => $id]) }}" method="post">
            @csrf
            @method('delete')

            <div class="input-group mb-3">
                <span class="input-group-text" id="span-name">{{$model}}</span>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="change-id" name="change">
                    @foreach ($change as $item)
                        <option value="{{ $item->id }}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Удалить с заменой</button>
        </form>

        <form action="{{ route('admin.delete', ['model' => $model, 'id' => $id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Все равно удалить</button>
        </form>
    @else
        <h3>Нет зависимостей, можно безопасно удалить</h3>
        <form action="{{ route('admin.delete', ['model' => $model, 'id' => $id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-dark">Удалить</button>
        </form>
    @endif
@endsection
