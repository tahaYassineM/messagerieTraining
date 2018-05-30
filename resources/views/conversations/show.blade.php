@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                @include('conversations.users', [ 'users' => $users])
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{ $user->name }}
                    </div>
                    <div class="card-body conversation">
                        <form action="{{ route('conversations.store') }}" method="post">
                            <div class="form-group">
                              <label for=""></label>
                              <textarea class="form-control" name="" id="" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection