@extends('layouts.main_layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    {{ Form::open(['url' => '/', 'method' => 'post']) }}
        <div class="form-group">
            {{ Form::label('username', 'Ваш никнейм') }}
            {{ Form::text('username', '', ['placeholder' => 'Введите ваш ник', 'class' => 'form-control', 'id' => 'username']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Ваш Email') }}
            {{ Form::email('email', '', ['placeholder' => 'Введите ваш email', 'class' => 'form-control', 'id' => 'email']) }}
        </div>
        <div class="form-group">
            {{ Form::label('theme', 'Тема Комментария') }}
            {{ Form::text('theme', '', ['placeholder' => 'Введите тему комментария', 'class' => 'form-control', 'id' => 'theme']) }}
        </div>
        <div class="form-group">
            {{ Form::label('comment', 'Текст комментария') }}
            {{ Form::textarea('comment', '', ['placeholder' => 'Введите текст комментария', 'class' => 'form-control', 'id' => 'comment']) }}
        </div>
        {{ Form::submit('Отправить', ['class' => 'brn btn-primary', 'name' => 'submit']) }}
    {{ Form::close() }}
    @foreach ($comments as $comment)
    <div class="card">
        <div class="card-header">
            <a href="user/{{$comment->author->id}}">{{ $comment->author->name }}</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $comment->title }}</h5>
            <p class="card-text">{{ $comment->text }}</p>
            <p class="card-text">{{ $comment->updated_at }}</p>
        </div>
    </div>
    @endforeach

    {{ $comments->links() }}

@endsection
