@php
$user = Auth::user();
@endphp
<script src="http://code.jquery.com/jquery-1.9.0rc1.js"></script>

<x-app-layout>
<div class="flex flex-col justify-center items-center rounded-xl ">
<iframe src="https://apimeme.com/" height="500px" width="50%"></iframe>
    <div class="w-1/4 mb-20 mt-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    
    <h1 class="flex flex-col justify-center items-center rounded-xl"> Share a Meme </h1>
        
        <form method="post" action="{{route('memes.store')}}">
            @csrf
            @method('post')
            <div class="mb-6 col-span-2">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" name="username" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
            </div>
            <div class="mb-6">
                <label for="imageurl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meme Link</label>
                <input type="text" id="imageurl" name="imageurl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          
            
            <div class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            </div>
            <div class="flex flex-col justify-center items-center rounded-xl mt-6" >
                <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit" value="Create">
            </div>  
            


        </form>
       
    
    </div>
</div>
      
</x-app-layout>