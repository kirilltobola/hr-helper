<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-sm">
    <a class="btn btn-dark" type="button" href="{{ route('admin.index') }}">Home</a>
    <a class="btn btn-dark" href="{{ route('admin.create', ['model' => $modelAlias]) }}" type="button">Add {{ $modelAlias }}</a>
    <table class="table">
        <thead>
            <tr>
                @foreach($attributes as $attribute)
                    <th scope="col">{{ $attribute }}</th>
                @endforeach
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($models as $model)
                <tr>
                    @foreach($attributes as $attribute)
                        <td>{{ $model->$attribute }}</td>
                    @endforeach
                    <td>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li>
                                    <a href="{{ route('admin.edit', ['model' => $modelAlias, 'id' => $model->id]) }}" class="dropdown-item">edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.destroy', ['model' => $modelAlias, 'id' => $model->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item">delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
