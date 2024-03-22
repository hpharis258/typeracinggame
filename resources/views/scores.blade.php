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
      Main Content

      </body>
      </html>
      </x-app-layout>

@else 
    <x-guest-layout>

    </x-guest-layout>

@endif
