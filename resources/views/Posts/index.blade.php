@extends('layout')
@section('title')
CineCaster Tweeter
@endsection

@section('content')

@if ( session()->get('success') )
<div role="alert">
    {{ session()->get('success') }}
</div>
@endif

@section('js')
    <script>
        var updatePostStats = {
            Like: function (postId) {
                document.querySelector('#likes-count-' + postId).textContent++;
            },

            Unlike: function(postId) {
                document.querySelector('#likes-count-' + postId).textContent--;
            }
        };


        var toggleButtonText = {
            Like: function(button) {
                button.textContent = "Unlike";
            },

            Unlike: function(button) {
                button.textContent = "Like";
            }
        };

        var actOnPost = function (event) {
            var postId = event.target.dataset.postId;
            var action = event.target.textContent;
            toggleButtonText[action](event.target);
            updatePostStats[action](postId);
            axios.post('/posts/' + postId + '/act',
                { action: action });
        };

        Echo.channel('post-events')
        .listen('PostAction', function (event) {
            console.log(event);
            var action = event.action;
            updatePostStats[action](event.postId);
        })

    </script>
    @endsection

@foreach($posts ?? '' as $post)
    <ul>
            <li> 
                @auth
                <a href="{{ route('profiles.show', $post->profile_ID) }}" class="text-dark" class="nav-link" ><strong>{{ $post->username }}</strong></a>
                @endauth

                @guest
                <strong>{{ $post->username }}</strong>
                @endguest


                <div class="float-right">
                    @if($follower ?? '') 
                    <small>You are following this profile</small>

                    @else 
                    <small>You are not following this profile</small>

                    @endif
                </div>

               
                <figure>
                    <img class="rounded-circle z-depth-2" class="img-responsive" src="{{ $post->picture }}" alt="Profile picture" style="width:10%" />
                </figure>

                <p>
                    {{ $post->content }}    
                </p>

                @auth 
                <a href="{{ route('posts.show', $post->id ) }}" class="btn btn-primary">View Post</a>
                
                <a href="{{ route('posts.edit', $post->id ) }}" class="btn btn-primary">Edit Post</a>
                
                <div class="float-right">
                    <button  onclick="actOnPost(event);" data-post-id="{{ $post->id }}">Like</button>
                    <span id="likes-count-{{ $post->id }}">{{ $post->likes_count }}</span>
                </div>
            
                @endauth
            </li>       
    </ul>
@endforeach
@endsection
@auth 
@endauth