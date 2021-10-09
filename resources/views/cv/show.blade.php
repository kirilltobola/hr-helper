<html>
<head>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>

<div class="container-sm">
    <h2>{{$cv->candidate->name}}</h2>
    <p>email : {{$cv->candidate->email}}</p>
    <p>Позиция: {{$cv->position->name}}</p>
    <p>Уровень: {{$cv->programming_level->name}}</p>
    <p>Дата собеседования: {{$cv->date}}</p>
    <p>Статус: {{$cv->status->name}}</p>
    <div>
        <label>Ключивые навыки:</label>
        <textarea>{{$cv->skills}}</textarea>
    </div>
    <div>
        <label>Резюме:</label>
        <textarea>{{$cv->cv}}</textarea>
    </div>
    <div>
        <label>Опыт:</label>
        <textarea>{{$cv->experience}}</textarea>
    </div>

    <a type="button" href="{{route('cvs.save',['cv' => $cv->id])}}">cохранить</a>
    <form action="{{route('cvs.destroy',['cv' => $cv->id])}}" method="post">
        @csrf
        @method('delete')

        <button type="submit" class="btn">удалить cv</button>
    </form>
</div>
</body>
</html>
