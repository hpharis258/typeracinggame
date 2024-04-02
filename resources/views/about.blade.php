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
      <div class="flex h-screen text-center">
            <div class="m-auto md:px-96">
            <h1 class="text-5xl ">About Type racing game</h1>
            <p class="text-2xl ">The type racing game is a website created for the Advanced Web Development module which is part of a Computer science Bsc degree at University of Wolwerhampton. The website is created using Laravel 11 and MySQL database, utilising Model View Controller pattern. The website is created by Haroldas Varanauskas as an attempt to pass the module, learn more about PHP, Laravel and improve existing web development skills. This website is hugely inspired by <a href="https://monkeytype.com/">https://monkeytype.com/</a> I always wondered how something like this is built, so I decided to actually build it. In this game the Words per minute are not calculated using the standard formula of 5 characters being one word, instead the actual number of correctly typed words is used. </p>
            </div>
      </div>  
      </body>
      </html>
      </x-app-layout>

@else 
    <x-guest-layout>
      <div class="flex h-screen text-center">
            <div class="m-auto md:px-96">
            <h1 class="text-5xl ">About Type racing game</h1>
            <p class="text-2xl ">The type racing game is a website created for the Advanced Web Development module which is part of a Computer science Bsc degree at University of Wolwerhampton. The website is created using Laravel 11 and MySQL database, utilising Model View Controller pattern. The website is created by Haroldas Varanauskas as an attempt to pass the module, learn more about PHP, Laravel and improve existing web development skills. This website is hugely inspired by <a href="https://monkeytype.com/">https://monkeytype.com/</a> I always wondered how something like this is built, so I decided to actually build and improve it.</p>
            </div>
      </div>  
    </x-guest-layout>

@endif
