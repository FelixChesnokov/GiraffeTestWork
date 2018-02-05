@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="text-center post_form">
                <h1>Add Post</h1>
                <hr>
                <form method="post">
                    {!! csrf_field() !!}
                    <p>Title</p>
                    <input type="text" name="title" class="form-control" required>
                    <br>
                    <p>Description</p>
                    <textarea name="description" class="form-control" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-success">Create</button>
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