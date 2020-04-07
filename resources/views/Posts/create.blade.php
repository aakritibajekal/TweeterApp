@extends('layouts.app')

@section('title')
Create a Post
@endsection

@section('content')

<h1 class="text-center"> Create a new post!</h1>

<div class="container-fluid">
<form method="post" action="{{ route( 'posts.store' ) }}" enctype="multipart/form-data">
<div class="form-group container h-100">
         
    @csrf

    <label for="content">
        <strong> What is on your mind? </strong>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
        <label>Mood:
        <textarea class="form-mood" name="mood" id="mood" cols="30" rows="10">
        </textarea>
        </label>
    </label>
    </div>

    <div class="form-group container h-100">
    <label for="picture">
    <strong>Upload an image:</strong>
    <br>
    <input type="file" name="picture" id="picture">
    </label>
    </div>


    <div class="form-group container h-100">
    <input class="btn btn-primary btn-customized align-bottom" type="submit" value="Post this">
    </div>
    
</form>

</div>
@endsection