<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik+Scribble&family=Workbench:SCAN@-12&display=swap" rel="stylesheet">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</iframe>
@vite(['resources/js/game.js'])
@if(Auth::check()) 
@php
$user = Auth::user();
@endphp
        <x-app-layout>
       <!-- Modal toggle -->
       <script>
        let isCamera = false;
        function ToggleImageInput() {
          if (isCamera) {
            document.getElementById("fileInputArea").hidden = false;
            document.getElementById("cameraPreviewArea").hidden = true;
            document.getElementById("PhotoArea").hidden = true;
            isCamera = false;
          } else {
            document.getElementById("fileInputArea").hidden = true;
            document.getElementById("cameraPreviewArea").hidden = false;
            document.getElementById("PhotoArea").hidden = false;
            isCamera = true;
          }
        }
        </script>
    <button id="modalTriggerButton" style="display:none" data-modal-target="loggedInGameOverModal" data-modal-toggle="loggedInGameOverModal" type="button">
      Toggle modal
    </button>
    <div id="gameCompleteModal"><!-- Logged in modal, need to pass WPM, Username. Ability to create score -->
<div id="loggedInGameOverModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Post Score 
                </h3>
                <button type="button" onclick="window.location.href='/'" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                     Great job! {{$user->name}} You have completed the game. Your WPM is: <b id="wpmModalDisplay"></b> Would you like to post your score?
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    If you post your score it will be visible in the Scores page. The image that you upload will be stored in a public cloud storage and will be visible to everyone. Uploading inappropriate images will result in a ban.
                </p>
            </div>
            <form id="scoreStoreForm" class="p-4 md:p-5" enctype="multipart/form-data" method="post" action= "{{route('scores.store')}}">
                @csrf
                @method('post')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$user->name}}" readonly required="">
                    </div>
                    <div class="col-span-2">
                        <label for="wpm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Words Per Minute</label>
                        <input type="text" name="wpm" id="wpmModalValue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="wpm" readonly required="">
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                      <input type="checkbox" value="" onClick="ToggleImageInput()" class="sr-only peer">
                      <div  class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                      <span  class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Use Camera?</span>
                    </label>
                    <div id="cameraPreviewArea" class="camera col-span-2">
                      <h2>Video Preview</h2>
                      <video id="video">Video stream not available.</video>
                      <button style="background-color:#1F2937; color:white; width: 20%; margin-top: 5px; border-radius: 5px;" id="startbutton">Take photo</button>
                  </div>
                  <canvas style="display:none"; id="canvas"> </canvas>
                  <div id="PhotoArea" class="output">
                    <h2>Photo</h2>
                    <img id="photo" alt="The screen capture will appear in this box." />
                  </div>
                    <div id="fileInputArea" class="col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <div style="border-radius: 5px;">
                            <input id="imageInput" name="imageInput" type="file" accept="image/*" />
                          </div>
                        
                    </div>
                   
                  <script> 
                  
                      (() => {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  const width = 320; // We will scale the photo width to this
  let height = 0; // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  let streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  let video = null;
  let canvas = null;
  let photo = null;
  let startbutton = null;

  function showViewLiveResultButton() {
    if (window.self !== window.top) {
      // Ensure that if our document is in a frame, we get the user
      // to first open it in its own tab or window. Otherwise, it
      // won't be able to request permission for camera access.
      document.querySelector(".contentarea").remove();
      const button = document.createElement("button");
      //button.textContent = "View live result of the example code above";
      document.body.append(button);
      button.addEventListener("click", () => window.open(location.href));
      return true;
    }
    return false;
  }

  function startup() {
    if (showViewLiveResultButton()) {
      return;
    }
    video = document.getElementById("video");
    canvas = document.getElementById("canvas");
    photo = document.getElementById("photo");
    startbutton = document.getElementById("startbutton");
    // Hide camera initially
    document.getElementById("cameraPreviewArea").hidden = true;
    document.getElementById("PhotoArea").hidden = true;
    //
    navigator.mediaDevices
      .getUserMedia({ video: true, audio: false })
      .then((stream) => {
        video.srcObject = stream;
        video.play();

      })
      .catch((err) => {
        console.error(`An error occurred: ${err}`);
        
      });

    video.addEventListener(
      "canplay",
      (ev) => {
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth / width);

          // Firefox currently has a bug where the height can't be read from
          // the video, so we will make assumptions if this happens.

          if (isNaN(height)) {
            height = width / (4 / 3);
          }

          video.setAttribute("width", width);
          video.setAttribute("height", height);
          canvas.setAttribute("width", width);
          canvas.setAttribute("height", height);
          streaming = true;
        }
      },
      false,
    );

    startbutton.addEventListener(
      "click",
      (ev) => {
        ev.preventDefault();
        takepicture();
        
      },
      false,
    );

    clearphoto();
  }

  // captured.

  function clearphoto() {
    const context = canvas.getContext("2d");
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    const data = canvas.toDataURL("image/png");
    photo.setAttribute("src", data);
  }

  //
  function dataURLtoFile(dataurl, filename) {

    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, { type: mime });
}
  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.

  function takepicture() {
    const context = canvas.getContext("2d");
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);

      const data = canvas.toDataURL("image/png");
      //console.log(data);
      let userName = document.getElementById("username").value;
      const file = dataURLtoFile(data, userName + Date.now() + ".png");
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      //console.log(file);
      //const blob = dataURItoBlob(data);
      //const imageFile = new File(blob, userName + ".png", { type: "image/png" });

      // Set as the image source
      let input = document.getElementById("imageInput");
      console.log(input);
      input.files = dataTransfer.files;
      //console.log(input);
      //document.getElementsByName("imageInput")[0].setAttribute("value", data);

      //console.log(data);

      photo.setAttribute("src", data);
    } else {
      clearphoto();
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener("load", startup, false);
})();
           function submitForm(){
              event.preventDefault();
              let fileInput = document.getElementById("imageInput");
              if(fileInput.files.length == 0){
                alert("Please upload an image");
                return;
              }
              

              document.getElementById("scoreStoreForm").submit();
           }
                  </script>
                </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

               
            </div> 
                <button data-modal-hide="static-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="submitForm(event)">Post</button>
                <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" onclick="window.location.href='/'">Decline</button>
            </div>
            </form>

    </div>
</div>
    <div id="game-information">
        <div id="timer">Time Left: 00:30</div>
        <div id="wordPerMinuteArea"><h1 id="wpm-display">WPM: 0</h1></div>
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
        <div id="wordPerMinuteArea"><h1 id="wpm-display">WPM: 0</h1></div>
    </div>
   
    <div id="GameArea" tabindex="0">
        <div id="wordsToType">Loading Quote...</div>
        <div id="cursor"></div>
        <div id="focusError">Click here to start typing!</div>
    </div>
  
    </x-guest-layout>

@endif


                              
