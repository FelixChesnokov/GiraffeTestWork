@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="text-center post_form">
                <h1>Edit Post</h1>
                <hr>
                <form method="post">
                    {!! csrf_field() !!}
                    <p><b>Title</b></p>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}" required>
                    <br>
                    <p><b>Description</b></p>
                    <textarea name="description" class="form-control" required>{{$post->description}}</textarea>
                    <br>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

