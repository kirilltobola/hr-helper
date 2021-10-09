@extends('layouts')
@section('head')
    @include('_head')
@endsection
@section('content')
    <form action="{{ route('admin.store', ['model' => $modelAlias]) }}" method="post">
        @csrf
        @foreach($attributes as $attribute)
            <div class="form-floating mb-3">
                <input class="form-control" id="{{ $attribute }}" name="{{ $attribute }}" type="text" value="{{old($attribute)}}">
                <label for="{{$attribute}}">{{ $attribute }}</label>
                @error($attribute)
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach
        <button class="btn btn-dark" type="submit">Добавить</button>
    </form>
@endsection
