<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$cv->candidate->name}}</title>

    <style>
        body {
            font-family: Arial;
            font-size: 12pt;
        }
        div {
            margin-left: 10%;
        }
        h1 {
            font-size: 20pt;
        }
        h2 {
            font-weight: normal;
            font-size: 12pt;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h1>{{$cv->candidate->name}}</h1>

        <p>email: <a href="{{$cv->candidate->email}}">{{$cv->candidate->email}}</a></p>
        <p>позиция: {{$cv->position->name}}</p>
        <p>уровень: {{$cv->level->name}}</p>
        <p>дата: {{$cv->date}}</p>
        <p>статус: {{$cv->status->name}}</p>

        <br><br>

        <h2>Ключевые навыки</h2>
        <p>{!! $cv->skills !!}</p>

        <br><br>

        <h2>Резюме</h2>
        <p>{!! $cv->cv !!}</p>

        <br><br>

        <h2>Опыт</h2>
        <p>{!! $cv->experience !!}</p>
    </div>
</body>
</html>
