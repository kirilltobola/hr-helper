@extends('layouts')

@section('head')
    @include('cv._head')
@endsection

@section('content')
    <h2>Добавить резюме</h2>
    <form class="form-control" method="POST" action="{{route('cvs.store')}}">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Имя</span>
            <input value="{{old('name')}}" type="text" class="form-control form-control-sm w-25" id="name-id" name="name" placeholder="Введите имя">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">e-mail</span>
            <input value="{{old('email')}}" type="text" class="form-control form-control-sm w-25" id="email-id" name="email">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Позиция</span>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="position" name="position">
                @foreach ($positions as $key => $position)
                    <option value="{{$key}}">{{$position}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Уровень</span>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="programming_level" name="programming_level" required>
                @foreach ($levels as $key => $level)
                    <option value="{{$key}}">{{$level}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Дата</span>
            <input value="{{old('date')}}" type="date" class="form-control form-control-sm w-25" id="date" name="date">
        </div>
        @error('date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="skills" class="form-label">Ключевые навыки</label>
            <div class="mb-3" id="skills">{!! old('skills') !!}</div>
            <textarea id="input-skills" name="skills" style="display: none">{!! old('skills') !!}</textarea>
        </div>
        @error('skills')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="cv" class="form-label">Резюме</label>
            <div class="mb-3" id="cv">{!! old('cv') !!}</div>
            <textarea id="input-cv" name="cv" style="display: none">{!! old('cv') !!}</textarea>
        </div>
        @error('cv')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="experience" class="form-label">Опыт</label>
            <div class="mb-3" id="experience">{!! old('experience') !!}</div>
            <textarea id="input-experience" name="experience" style="display: none">{!! old('experience') !!}</textarea>
        </div>
        @error('experience')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button class="btn btn-dark" type="submit">Добавить</button>
    </form>

    <script src="{{asset('js/cv_generate_email.js')}}"></script>
    <script src="{{asset('js/cv_quill.js')}}"></script>
@endsection
