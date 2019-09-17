@extends('layouts.main_layout')

@section('content')
    <a href="{{ route('admin.users') }}" type="button" class="btn btn-primary btn-lg btn-block">Пользователи</a>
    <a href="{{ route('admin.comments') }}" type="button" class="btn btn-secondary btn-lg btn-block">Комментарии</a>
@endsection