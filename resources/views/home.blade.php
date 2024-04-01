<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik+Scribble&family=Workbench:SCAN@-12&display=swap" rel="stylesheet">

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
        <!-- Modal toggle -->
    <button id="modalTriggerButton" style="display:none" data-modal-target="static-modal" data-modal-toggle="static-modal" type="button">
      Toggle modal
    </button>
    <div id="gameCompleteModal">@component('components.gameCompleteModalNotLoggedIn') @endcomponent</div>
    <div id="game-information">
        <div id="timer">Time Left: 00:30</div>
        <div id="wordPerMinuteArea"><h1>WPM: 0</h1></div>
    </div>
   
    <div id="GameArea" tabindex="0">
        <div id="wordsToType">Loading Quote...</div>
        <div id="cursor"></div>
        <div id="focusError">Click here to start typing!</div>
    </div>
  
    </x-guest-layout>

@endif


                              
