<html>
<head>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-sm">



    <div class="col-xs-12">
        <h2>Basic Form</h2>
        <form class="form-control" method="POST" action="{{route('cvs.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input required type="text" class="form-control form-control-sm w-25" id="name" name="name" value="" placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input  required type="text" class="form-control form-control-sm w-25" value="" id="email" name="email" placeholder="name@example.com">
            </div>
            <div>
                <label for="position">Позиция</label>
                <select class="form-select form-select-sm w-25" aria-label=".form-select-sm example" id="position" name="position" required>
                    <option value="" disabled selected hidden>php</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{$position->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="level">Уровень</label>
                <select class="form-select form-select-sm w-25" aria-label=".form-select-sm example" id="programming_level" name="programming_level" required>
                    <option disabled selected hidden>intern</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{$level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group p-50">
                <label for="date">Дата</label>
                <input required type="date" class="form-control form-control-sm w-25" id="date" name="date">
            </div>
            <div class="form-group">
                <label for="skills" class="form-label">Ключевые навыки</label>
                <div class="mb-3" id="skills"></div>
                <textarea  id="input-skills" name="skills" required style="display: none"></textarea>
            </div>
            <div class="form-group">
                <label for="cv" class="form-label">Резюме</label>
                <div class="mb-3" id="cv"></div>
                <textarea  id="input-cv" name="cv" required style="display: none"></textarea>
            </div>
            <div>
                <label for="experience" class="form-label">Опыт</label>
                <div class="mb-3" id="experience"></div>
                <textarea  id="input-experience" name="experience" required style="display: none"></textarea>
            </div>
            <button class="btn btn-dark" type="submit">Add</button>

{{--            <a type="button" href="{{route('cvs.save',['cv'=>$cv->id])}}">СОХРАНИТЬ PDF</a>--}}
        </form>
    </div>

</div>
<script>

    var cv = new Quill('#cv', {
        theme: 'snow'
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
    var email_update = document.getElementById('name')
    email_update.addEventListener("focusout", event => {
        if(document.getElementById('name').value.length != 0){
            document.getElementById('email').value = generate_email();
        }
    });


    function generate_email()
    {
        var name = document.getElementById('name').value.toLowerCase()
        var position = document.getElementById('position').value
        name = translit(name)
        name = name.split(' ').slice(0,2)
        var domen = "dev@adict.ru"
        var email = name[0] + "." + name[1] + "-" + domen
        return email
    }
    function translit(str)
    {
        var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")
        var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")
        var res = '';
        for(var i=0, l=str.length; i<l; i++)
        {
            var s = str.charAt(i), n = ru.indexOf(s);
            if(n >= 0) { res += en[n]; }
            else { res += s; }
        }
        return res;
    }
</script>
</body>
</html>
