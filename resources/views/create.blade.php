<!DOCTYPE html>
<html>
    <head>
        <title>Create New Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <h1> Create New Post </h1>
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="post" action="{{route('posts.store')}}">
            @csrf
            @method('post')
            <div>
                <label>Title</label>
                <input type="text" name="title">
            </div> 
            <div>
                <label>Content</label>
                <input type="text" name="content">
            </div>   
            <div>
                <label>Image</label>
                <input type="file" name="image">
            </div>   
            <div>
                <input type="submit" value="Create new Post!">
            </div>  
    

        </form>
    </body>
</html>