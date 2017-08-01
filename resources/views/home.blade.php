@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            You are logged in!
                                <br>
                                <form class='form-group' method='post' action='/send'>
                                    <input type='text' class='form-control' name='author'><br>
                                    <textarea class="form-control" name="commentary"></textarea>
                                    <br>
                                    {{ csrf_field() }}
                                    <button type='submit' class='btn btn-primary'>Send</button>
                                </form>
                        </div>
                </div>
            @foreach($comments as $comment)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>{{ $comment->name }}</h4>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted text-info">{{ $comment->commentary }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
