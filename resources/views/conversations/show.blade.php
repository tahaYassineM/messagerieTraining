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
                    @foreach($messages as $message)
                        <div class="col-md-10 {{ $message->from->id !== $user->id ? 'offset-md-2 text-right' : ''  }}">
                            <p>
                                <strong>{{ $message->from->id !== $user->id ? 'Moi' : $message->from->name  }}</strong><br>
                                {{ $message->content }}
                            </p>
                        </div>
                    @endforeach
                        <form action="" method="post">
                        {{ csrf_field() }}
                            <div class="form-group">
                              <label for=""></label>
                              <textarea class="form-control" name="content" rows="3" placeholder="votre message..."></textarea>
                            </div>
                            <button type="submit" name="Envoyer" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection