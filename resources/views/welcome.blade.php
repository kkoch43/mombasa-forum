@extends('layouts.front')

@section('banner')
    <div class="jumbotron">
        <div class="container">
            <h1>Join Mombasa Tech Forum</h1>
            <p>Help and get Help</p>
            <p>
                <a class="btn btn-primary btn-lg">Learn more</a>
            </p>
        </div>
    </div>

    @endsection

@section('heading', "Threads")

@section('content')

    @include('threads.partials.thread-list')




@endsection