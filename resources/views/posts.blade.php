<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type racing game | Posts</title>
</head>
<body>
    <h1>Posts</h1>
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
</html>