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
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Up-vote Count</th>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td>{{$post->image}}</td>
                <td>{{$post->up_vote_count}}</td>
            </tr>
            @endforeach
        </table>
    </div>
   
</body>
</html>