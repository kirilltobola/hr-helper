@extends('layouts')

@section('head')
    @include('cv._head')
@endsection

@section('content')
    <h2>Изменить резюме</h2>
    <form class="form-control" action="{{route('cvs.update', ['cv' => $cv->id])}}" method="post">
        @csrf
        @method('put')

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Имя</span>
            <input type="text" class="form-control form-control-sm w-25" id="name-id" name="name" value="{{$cv->candidate->name}}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">e-mail</span>
            <input type="text" class="form-control form-control-sm w-25" id="email-id" name="email" value="{{$cv->candidate->email}}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Позиция</span>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="position" name="position">
                @foreach ($positions as $key => $position)
                    @if($position == $cv->position->name)
                        <option selected value={{$cv->position->id}}>{{$cv->position->name}}</option>
                    @else()
                        <option value={{$key}}>{{$position}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('position')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Уровень</span>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="programming_level" name="programming_level">
                @foreach ($levels as $key => $level)
                    @if($level == $cv->level->name)
                        <option selected value={{$cv->level->id}}>{{$cv->level->name}}</option>
                    @else()
                        <option value={{$key}}>{{$level}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('programming_level')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <span class="input-group-text" id="span-name">Дата</span>
            <input type="date" class="form-control form-control-sm w-25" id="date" name="date" value="{{$cv->date}}">
        </div>
        @error('date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="input-skills" class="form-label">Ключевые навыки</label>
            <div class="mb-3" id="skills">{!! $cv->skills !!}</div>
            <textarea id="input-skills" name="skills" style="display: none">{{ $cv->skills }}</textarea>
        </div>
        @error('skills')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="input-cv" class="form-label">Резюме</label>
            <div class="mb-3" id="cv">{!! $cv->cv !!}</div>
            <textarea id="input-cv" name="cv" style="display: none">{{ $cv->cv }}</textarea>
        </div>
        @error('cv')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="input-experience" class="form-label">Опыт</label>
            <div class="mb-3" id="experience">{!! $cv->experience !!}</div>
            <textarea id="input-experience" name="experience" style="display: none">{{ $cv->experience }}</textarea>
        </div>
        @error('experience')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button class="btn btn-dark" type="submit">Изменить</button>
    </form>

    <script src="{{asset('js/cv_generate_email.js')}}"></script>
    <script src="{{asset('js/cv_quill.js')}}"></script>
@endsection
