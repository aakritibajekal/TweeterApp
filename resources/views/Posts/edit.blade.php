@extends('layouts.app')

@section('title')
Edit Tweet
@endsection
@section('content')
<p>Use this form to edit a Tweet.</p>
{{--display errors--}}
@include('partials.error')
<form method="post" action="{{ route('tweets.update', $tweet->id) }}">
    @csrf
    @method('PATCH')
    <label for="message">
        <strong>Input a Message:</strong>
        <textarea name="message" id="message" cols="30" rows="10">{{ $tweet->message }}</textarea>
    </label>
    {{-- <label for="author">
        <strong>Author name:</strong>
        <input type="text" name="author" id="author" value="{{ $tweet->author }}">
    </label> --}}
    <input type="submit" Value="Update Tweet">
</form>
@endsection