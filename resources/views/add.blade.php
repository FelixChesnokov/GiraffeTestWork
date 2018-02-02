@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="text-center post_form">
                <h1>Edit Post</h1>
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
            </div>
        </div>
    </div>
@endsection