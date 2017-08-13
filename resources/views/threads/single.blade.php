@extends('layouts.front')

@section('content')

    <div class="content-wrap well">

    <h4>{{$thread->subject}}</h4>

    <hr>

    <div class="thread-details">
        {!! \Michelf\Markdown::defaultTransform($thread->thread)!!}
    </div>

    <br>
@if(Auth::check())
    @if(Auth::user()->id == $thread->user_id)

    <div class="action">
        <a href="{{route('thread.edit', $thread->id)}}" class="btn btn-info btn-xs">Edit</a>

        {{--//delete form--}}
        <form action="{{route('thread.destroy', $thread->id)}}" method="POST" class="inline-it">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input class="btn btn-xs btn-danger" type="submit" value="Delete">
        </form>

    </div>
        @endif



    @endif

    </div>

    <hr>

    {{--Answers/comments--}}

    @foreach($thread->comments as $comment)

    <div class="comment-list well well-lg">

            <h4>{{$comment->body}}</h4>
            <lead>{{$comment->user->name}}</lead>


        <div class="action">

        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#{{$comment->id}}">Edit</a>
        <div class="modal fade" id="{{$comment->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="comment-form">
                            <form action="{{route('comment.update', $comment->id)}}" method="post" role="form">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <legend>Edit comment</legend>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="body" id="" placeholder="Input..." value="{{$comment->body}}">
                                </div>

                                <button type="submit" class="btn btn-primary">Comment</button>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!---modal content -->
            </div><!-- modal dialog -->
        </div><!--modal dialog -->

            <form action="{{route('comment.destroy', $comment->id)}}" method="POST" class="inline-it">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <input class="btn btn-xs btn-danger" type="submit" value="Delete">
            </form>
        </div>

    </div>

    {{--reply to comment --}}
    <button class="btn btn-xs btn-default" onclick="toggleReply('{{$comment->id}}')">Reply</button>

    <br>

    {{--reply form --}}
    <div class="reply-form-{{$comment->id}} hidden">
        <form action="{{route('replycomment.store', $comment->id)}}" method="post" role="form">
            {{csrf_field()}}
            <legend>Create reply</legend>

            <div class="form-group">
                <input type="text" class="form-control" name="body" id="" placeholder="Reply...">
            </div>

            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
    </div>
    <br>


            @foreach($comment->comments as $reply)
            <div class="small well text-info reply-list" style="margin-left:60px ">
                <p>{{$reply->body}}</p>
                <lead>by {{$reply->user->name}}</lead>

                <div class="action">

                    <a class="btn btn-primary btn-xs" data-toggle="modal" href="#{{$reply->id}}">Edit</a>
                    <div class="modal fade" id="{{$reply->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="comment-form">
                                        <form action="{{route('comment.update', $reply->id)}}" method="post" role="form">
                                            {{csrf_field()}}
                                            {{method_field('put')}}
                                            <legend>Edit comment</legend>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="body" id="" placeholder="Input..." value="{{$reply->body}}">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Reply</button>
                                        </form>
                                    </div>

                                </div>
                            </div><!---modal content -->
                        </div><!-- modal dialog -->
                    </div><!--modal dialog -->

                    <form action="{{route('comment.destroy', $comment->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                    </form>
                </div>

            </div>







            @endforeach
    <hr>


    @endforeach

    <br>

    <div class="comment-form">
        <form action="{{route('threadcomment.store', $thread->id)}}" method="post" role="form">
            {{csrf_field()}}
            <legend>Create comment</legend>

            <div class="form-group">
                <input type="text" class="form-control" name="body" id="" placeholder="Input...">
            </div>

            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    </div>



@endsection

@section('js')
    <script>
        function toggleReply(commentId){
            $('.reply-form-'+commentId).toggleClass('hidden');
        }
    </script>

    @endsection