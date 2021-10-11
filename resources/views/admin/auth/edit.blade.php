@extends('layouts')
@section('head')
    @include('_head')
@endsection
@section('content')
    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
        @method('put')
        @csrf

        @foreach($attributes as $attribute)
            <div class="form-floating mb-3">
                <input class="form-control" id="{{ $attribute }}" name="{{ $attribute }}" type="text" value="{{ $user->$attribute }}">
                <label for="{{$attribute}}">{{ $attribute }}</label>
            </div>
            @error($attribute)
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        @endforeach
        <button class="btn btn-dark" type="submit">Редактировать</button>
    </form>
@endsection
