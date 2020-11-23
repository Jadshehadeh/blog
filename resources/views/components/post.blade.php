@props(['post' => $post])


<div>
    <div class="mb-6">
        <div class="mb-3 flex justify-between">
            <a href="{{ route('user.posts', $post->user) }} " class="font-bold ">{{ $post->user->name }}</a>
            <span class="text-gray-600 text-sm-right ">{{ $post->created_at->diffForHumans() }} </span>
        </div>
        <p class="mb-2">{{ $post->body }}</p>
            @can('delete', $post)
                
            <form action="{{ route('posts.delete', $post )}}" method="POST" class="ml-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Delete
                </button>
            </form>
            @endcan
    </div>
    <div class="flex justify-between mb-5">
        @auth
        <div class="flex content-center">
            @if (!$post->likedBy(auth()->user()))
            
            <form action="{{ route('posts.likes', $post )}} " method="POST" class="mr-1">
                @csrf
                <button type="submit" class="text-blue-500">like
                </button>
            </form>
            @else
            <form action="{{ route('posts.likes', $post )}}" method="POST" class="ml-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">unlike
                </button>
            </form>
            @endif
            
        </div>
        <div><span>{{$post->likes->count()}} </span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </div>
        @endauth
    </div>
</div>