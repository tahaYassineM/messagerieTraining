@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-3">
            <div class="list-group">
                @foreach($users as $user)
                    <a href="{{ route('conversations.show', $user->id) }}" class="list-group-item">{{ $user->name }}</li>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection