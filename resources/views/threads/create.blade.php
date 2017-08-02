@extends('layouts.front')

@section('heading', "Create Thread")

@section('content')

   @include('layouts.partials.errors')
   @include('layouts.partials.success')


    <div class="row">
        <div class="well">
            <form class="form-vertical" action="{{route('thread.store')}}" method="POST" role="form" id="create-thread-form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input.." value="{{old('subject')}}">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" name="type" id="" placeholder="Input.." value="{{old('type')}}">
                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea  class="form-control" name="thread" id="" placeholder="Input.." value="{{old('thread')}}"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>


            </form>
        </div>
    </div>

    @endsection