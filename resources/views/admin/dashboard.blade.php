@extends('layouts')
@section('head')
    @include('_head')
@endsection
@section('content')
    <div class="list-group">
        @foreach($models as $model)
            <a href="{{ route('admin.show', ['model' => $model]) }}" class="list-group-item list-group-item-action">
                {{ $model }}
            </a>
        @endforeach
    </div>
@endsection
