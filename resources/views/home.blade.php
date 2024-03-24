<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/js/game.js'])
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
        <h1> WPM:0 </h1>

      </body>
      </html>
      </x-app-layout>

@else 
    <x-guest-layout>
    
    <div id="wordPerMinuteArea"><h1>WPM: 0</h1></div>
    <div id="timer">Time Left: 30</div>
    <div id="GameArea" tabindex="0">
        <div id="wordsToType">Loading Quote...</div>
        <div id="focusError">Click on here to start typing!</div>
    </div>
  
    </x-guest-layout>

@endif


                              
