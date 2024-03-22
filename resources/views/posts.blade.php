@if(Auth::check()) 
        <x-app-layout>
      <!doctype html>
      <html>
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
      </head>
      <body>
      <a href="{{route('posts.create')}}">Create new Post</a>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Up-vote Count</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td>{{$post->image}}</td>
                <td>{{$post->up_vote_count}}</td>
                <td>
                    <a href="{{route('posts.edit', ['post' => $post])}}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{route('posts.delete', ['post' => $post])}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

      </body>
      </html>
      </x-app-layout>

@else 
    <x-guest-layout>
    <a href="{{route('posts.create')}}">Create new Post</a>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Up-vote Count</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td>{{$post->image}}</td>
                <td>{{$post->up_vote_count}}</td>
                <td>
                    <a href="{{route('posts.edit', ['post' => $post])}}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{route('posts.delete', ['post' => $post])}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
    </x-guest-layout>

@endif

