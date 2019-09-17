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
            <td>{{ $user->banned }}</td>
            <td>
                <a><i class="fa fa-ban"></i></a>
                <a><i class="fa fa-trash"></i></a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection