@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{--Register|Login form--}}
        <div class="col-md-8 col-md-offset-2">
            <?php if(!Auth::check()) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Register|Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="add_post_link text-center">
                    <a href="{!! route('add') !!}" >Create or Add Post</a>
                </div>
            <?php } ?>
        </div>
    </div>

    {{--POSTS--}}
    <div class="all_posts col-md-offset-2 col-md-8">
        <?php if(Auth::check()) { ?>
            <p class="posts_list  text-center">Posts</p>
        @foreach($posts as $post)
            <div class="post">
                <div class="text-center">
                    <a href="{!! route('view', ['id'=>$post->id]) !!}" ><b>{{$post->title}}</b></a>
                </div>
                <hr>
                <p>{{$post->description}}</p>
                <hr>
                <span><b>Author:</b> </span><span>{{$post->author}}</span>
                <span><b>Date:</b> </span><span>{{$post->created_at}}</span>
                <?php if($post->author == $nameAuth) { ?>
                <div class="text-center">
                    <a href="{!! route('edit', ['id'=>$post->id]) !!}" ><button class="btn btn-info">Edit</button></a>
                    <input type="button" class="delete  btn btn-danger" value="Delete" rel="{{$post->id}}">
                </div>
                <?php }?>
            </div>
            <br>
        @endforeach
            <div class="text-center">
            {{ $posts->links() }}
            </div>
        <?php }?>
    </div>
</div>
@endsection
