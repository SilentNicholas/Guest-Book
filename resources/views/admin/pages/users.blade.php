@extends('layouts.main_layout')

@section('content')
    <table class="table table-sm table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Никнейм</th>
            <th scope="col">Email</th>
            <th scope="col">Подтвержден</th>
            <th scope="col">Бан</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                @if ($user->banned === 1)
                    <td>Да</td>
                @else
                    <td>Нет</td>
                @endif
                <td>
                    @if ($user->banned === 1)
                        <button><a href="{{ route('user.edit', $user->id) }}"><i class="fa fa-check"></i></a></button>
                    @else
                        <button><a href="{{ route('user.edit', $user->id) }}"><i class="fa fa-ban"></i></a></button>
                    @endif
                    {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete']) }}
                    <button type="submit"
                            onclick="return confirm('Вы уверены, что хотите удалить данного пользователя?'); "><i
                                class="fa fa-trash"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection