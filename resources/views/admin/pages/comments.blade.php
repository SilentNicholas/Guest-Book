@extends('layouts.main_layout')

@section('content')
    <table class="table table-sm table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Краткая выдержка</th>
            <th scope="col">Автор</th>
            <th scope="col">Опубликовано</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($comments as $comment)
        <tr>
            <th scope="row">{{ $comment->id }}</th>
            <td>{{ $comment->title }}</td>
            <td>{{ substr($comment->text, 0, 15). '...' }}</td>
            <td>{{ $comment->author->name }}</td>
            <td>{{ $comment->published }}</td>
            <td>
                <a><i class="fa fa-ban"></i></a>
                <a><i class="fa fa-trash"></i></a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection