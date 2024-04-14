

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
    <div style="margin-top: 20px;" class="flex flex-col justify-center items-center rounded-xl">
    <table class="w-1/3 text-sm  text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg" style="font-size: 20px;">
                    User
                </th>
                <th scope="col" class="px-6 py-3" style="font-size: 20px;">
                    WPM
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg" style="font-size: 20px;">
                    Photo
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($scores as $score)
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" style="font-size: 18px;">
                    {{$score->username}}
                </th>
                <td class="px-6 py-4" style="font-size: 18px;">
                    {{$score->wpm}}
                </td>
                <td class="px-6 py-4">
                    <?php $url = asset('uploads/scores/'.$score->imageurl) ?>
                    <img src="{{$url}}" style="max-width: 100px" />
                </td>
                <!-- <td>
                {{Storage::url($score->imageurl);}}
                </td> -->
            </tr>
            @endforeach
        </tbody>
       
    </table>
    {{ $scores->links()}}
   
</div>


      </body>
      </html>
      </x-app-layout>

@else 
    <x-guest-layout>
    <!doctype html>
      <html>
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
      </head>
      <body>
        <h1 style="font-size:36px; margin-top:5%; height: 20%; text-align:center; width:100%;">Please log in or sign up to see the scores page! </h1>
        <img style="display:block;margin-left:auto;margin-right: auto; margin-bottom: 100px;" src=" https://api.memegen.link/images/ds/Log_in/Create_Account.jpg?watermark=MemeComplete.com&token=oz2grt80ns2xujdwweic" />
      </body>
      </html>
    </x-guest-layout>

@endif
