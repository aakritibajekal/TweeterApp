@extends('layout')

@section('title')
View Comments
@endsection

@section('content')


<h4> See Comments</h4>

<strong> Username: </strong>
    
<h5> {{ $profile->username }} </h5>

<p>{{ $post->content }}</p>
   
@endsection