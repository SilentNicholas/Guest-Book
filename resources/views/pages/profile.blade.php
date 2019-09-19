@extends('layouts.main_layout')
@section('content')
    <ul class="list-group">
        <li class="list-group-item active">{{ $user->name }}</li>
        @foreach($user->comments as $comment)
            <li class="list-group-item">
                <div class="card w-75">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->title }}</h5>
                        <p class="card-text">{{ $comment->text }}</p>
                        <p class="cart-text">{{ $comment->updated_at }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
