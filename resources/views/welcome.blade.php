<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
    <title>Document</title>
</head>

<body>
    <div id="app">
        <p class="post">Легендарное государство, объединявшее всю цивилизованную часть Галактики, просуществовало примерно 25000 лет.
            Не раз оно оказывалось на самом краю гибели, но джедаям всегда удавалось встать на пути у любых угроз и защитить невинных граждан.
            Впрочем, сами рыцари Ордена несли Республике определенную опасность: изгнанные джедаи становились могучими адептами Темной стороны Силы
            и развязывали войны против бывших товарищей.</p>

        @if(count ($errors) >0)
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>

        @endif

        <button class="btn btn-outline-primary" v-on:click='AddComment = !AddComment'>Добавить комментарий</button>
        <form v-if="AddComment" method="POST" action="{{ route('AddComment') }}">
            {{csrf_field()}}

            <div class="form-group col-md-3">
                <div class="author_new col-md-6">
                    <label>Ваше имя:</label>
                    <input class="form-control" type="text" name="author">
                </div>
                <div class="body_new">
                    <label>Комментарий:</label>
                    <input type="text" class="form-control" name="body">
                    </textarea>
                </div>
                <button class="btn btn-outline-primary" type="submit">Добавить</button>
            </div>
        </form>
        @foreach($data as $comment )
        <div class="card col-md-3" id="comment">
            <h3 class="card-title"><em>{{ $comment->author }}</em></h3>

            <div class="card-text">
                <p>{{ $comment->body }}</p>

                <div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-success" v-on:click="ResponseComment = !ResponseComment">Ответить</button>
                        <button class="btn btn-outline-warning" v-on:click="EditComment = !EditComment">Редактировать</button>
                        <form action="{{ route('DeleteComment',['comment' => $comment->id]) }}" method="POST">
                            {{ method_field('DELETE')}}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>

                        <form action="{{ route('Parent') }}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <button class="btn btn-light" type="submit">Комментарии </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <form v-if="EditComment" method="POST" action="{{ route('Edit', ['comment' => $comment->id]) }}">
            <input type="hidden" name="id" value="{{ $comment->id }}">
            {{csrf_field()}}
            <div class="form-group col-md-3" id="comment">
                <div class="author_new col-md-6">
                    <label>Ваше имя:</label>
                    <input class="form-control" type="text" name="author" value="{{ $comment->author }}">
                </div>
                <div class="body_new">
                    <label>Комментарий:</label>
                    <input class="form-control" type="text" name="body" value="{{ $comment->body }}">
                    </textarea>
                </div>
                <button class="btn btn-outline-primary" type="submit">Добавить</button>
            </div>
        </form>
        <form v-if="ResponseComment" method="POST" action="{{ route('AddComment') }}">
            {{csrf_field()}}
            <div class="form-group col-md-3" id="comment">
                <div class="author_new col-md-6">
                    <label>Ваше имя:</label>
                    <input class="form-control" type="text" name="author">
                </div>
                <div class="body_new">
                    <label>Комментарий:</label>
                    <input type="text" class="form-control" name="body">
                    </textarea>
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                </div>
                <button class="btn btn-outline-primary" type="submit">Добавить</button>
            </div>
        </form>

        @endforeach
    </div>

    <div>
        <a class="btn btn-outline-primary" href="{{ URL::route('index') }}">Назад</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11/dist/vue.js"></script>
    <script src="{{ URL::asset('js/app.js')}}"></script>
</body>

</html>