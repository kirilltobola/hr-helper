@extends('layouts')
@section('head')
    @include('_head')
@endsection
@section('content')

    <div class="list-group">
        <h2>Auth</h2>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
            users
        </a>
    </div>

    <div class="list-group">
        <h2>Catalog</h2>
        @foreach($models as $model)
            <a href="{{ route('admin.show', ['model' => $model]) }}" class="list-group-item list-group-item-action">
                {{ $model }}
            </a>
        @endforeach
    </div>
@endsection
