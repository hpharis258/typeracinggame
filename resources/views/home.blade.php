<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik+Scribble&family=Workbench:SCAN@-12&display=swap" rel="stylesheet">

@vite(['resources/js/game.js'])
@if(Auth::check()) 
        <x-app-layout>
       <!-- Modal toggle -->
    <button id="modalTriggerButton" style="display:none" data-modal-target="loggedInGameOverModal" data-modal-toggle="loggedInGameOverModal" type="button">
      Toggle modal
    </button>
    <div id="gameCompleteModal">@component('components.gameCompleteModalLoggedIn') @endcomponent</div>
    <div id="game-information">
        <div id="timer">Time Left: 00:30</div>
        <div id="wordPerMinuteArea"><h1 id="wpm-display">WPM: 56</h1></div>
    </div>
   
    <div id="GameArea" tabindex="0">
        <div id="wordsToType">Loading Quote...</div>
        <div id="cursor"></div>
        <div id="focusError">Click here to start typing!</div>
    </div>
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
        <div id="wordPerMinuteArea"><h1 id="wpm-display">WPM: 22</h1></div>
    </div>
   
    <div id="GameArea" tabindex="0">
        <div id="wordsToType">Loading Quote...</div>
        <div id="cursor"></div>
        <div id="focusError">Click here to start typing!</div>
    </div>
  
    </x-guest-layout>

@endif


                              
