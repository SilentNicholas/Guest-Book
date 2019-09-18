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
                @if($comment->published === 0)
                    <td>Нет</td>
                @else
                    <td>Да</td>
                @endif
                <td>
                    @if($comment->published === 0)
                        <button><a href="{{ route('comment.edit', $comment->id) }}"><i class="fa fa-check"></i></a>
                        </button>
                    @else
                        <button><a href="{{ route('comment.edit', $comment->id) }}"><i class="fa fa-ban"></i></a>
                        </button>
                    @endif
                    {{ Form::open(['route' => ['comment.destroy', $comment->id], 'method' => 'delete']) }}
                    <button type="submit"
                            onclick="return confirm('Вы действительно хотите удалить данный комментарий ?'); "><i
                                class="fa fa-trash"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection