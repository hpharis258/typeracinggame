<!DOCTYPE html>
<html>
    <head>
        <title>Create New Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <h1> Edit Post </h1>
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="post" action="{{route('posts.update', ['post' => $post])}}" >
            @csrf
            @method('put')
            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{$post->title}}">
            </div> 
            <div>
                <label>Content</label>
                <input type="text" name="content" value="{{$post->content}}">
            </div>   
            <div>
                <label>Image</label>
                <input type="file" name="image" value="{{$post->image}}">
            </div>   
            <div>
                <input type="submit" value="Update Post">
            </div>  
    

        </form>
    </body>
</html>