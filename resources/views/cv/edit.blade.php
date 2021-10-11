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

    <script>
        var toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'link', ];
        var cv = new Quill('#cv', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });
        cv.on('text-change', function (delta, oldDelta, source) {
            document.getElementById('input-cv').innerText = (document.getElementById('cv').querySelector('.ql-editor').innerHTML);
        });

        var skills = new Quill('#skills', {
            theme: 'snow'
        });
        skills.on('text-change', function (delta, oldDelta, source) {
            document.getElementById('input-skills').innerText = (document.getElementById('skills').querySelector('.ql-editor').innerHTML);
        });

        var experience = new Quill('#experience', {
            theme: 'snow'
        });
        experience.on('text-change', function (delta, oldDelta, source) {
            document.getElementById('input-experience').innerText = (document.getElementById('experience').querySelector('.ql-editor').innerHTML);
        });
    </script>
    <script>
        const source = document.getElementById('name-id');
        const result = document.getElementById('email-id');

        const inputHandler = function(e) {
            const suffix = '-dev@adict.ru';
            let inp = e.target.value.split(/\s+/);
            if (inp.length > 1) {
                let name = translitirate(inp[0].toLowerCase());
                let surname = translitirate(inp[1].toLowerCase().charAt(0));
                result.value = (name + '.' + surname) + suffix;
            } else {
                let name = inp[0];
                name = translitirate(name.toLowerCase());
                result.value = name + suffix;
            }
        }
        source.addEventListener('input', inputHandler);
        source.addEventListener('change', inputHandler);

        function translitirate(str) {
            const alphabet = {
                'а': 'a',
                'б': 'b',
                'в': 'v',
                'г': 'g',
                'д': 'd',
                'е': 'e',
                'ё': 'e',
                'ж': 'zh',
                'з': 'z',
                'и': 'i',
                'й': 'i',
                'к': 'k',
                'л': 'l',
                'м': 'm',
                'н': 'n',
                'о': 'o',
                'п': 'p',
                'р': 'r',
                'с': 's',
                'т': 't',
                'у': 'u',
                'ф': 'f',
                'х': 'kh',
                'ц': 'ts',
                'ч': 'ch',
                'ш': 'sh',
                'щ': 'shch',
                'э': 'ye',
                'ю': 'yu',
                'я': 'ya',
            }

            let res = '';
            for(let i = 0; i < str.length; i++) {
                res += alphabet[str[i]];
            }
            return res;
        }
    </script>
@endsection
