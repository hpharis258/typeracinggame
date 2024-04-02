// Global Variables
let isLoading = false;
let isGameOver = false; 

// show end game modal
function showEndGameModal() {
    // Get the element with WPM
    let wpmElement = document.getElementById('wpm-display').innerHTML;
    //console.log(document.getElementById('wpm-display'));
    //console.log(wpmElement);
    let elementString = wpmElement.toString();
    elementString = elementString.replace(/\D/g,'');

    document.cookie = "wpm=" + elementString;
    $('#modalTriggerButton').click();
};

// API URL
const RANDOM_QUOTE_API_URL = 'http://api.quotable.io/random';
// Element to display the quote
const quoteDisplayElement = document.getElementById('wordsToType');
// Fetch a random quote from the Quotable API
function getRandomQuote() {
    return fetch(RANDOM_QUOTE_API_URL)
        .then(response => response.json())
        .then(data => data.content)
}
// Gets the next random quote and updates the DOM
async function getNextQuote() {
    const quote = await getRandomQuote()
    quoteDisplayElement.innerText = quote;
}
// Formats the quote into HTML elements
function formatWord(word){
    return `<div class="word" style="margin: 5px"><span class="letter">${word.split('').join('</span><span class="letter">')}</span></div><div class="space">⠀</div>`;
}
// Adds the letter classes onto each of the words and sets the firts word and letter as the current word and letter
function addLetterClassesToWords(){
    let html = document.getElementById('wordsToType').innerHTML; 
    let words = html.split(' ');
    for(let i = 0; i < words.length; i++){
        words[i] = formatWord(words[i]);
    }
    document.getElementById('wordsToType').innerHTML = words.join(' ');
    // Add classes to the first word and letter
    $('.word').first().addClass('current-word');
    $('.letter').first().addClass('current-letter');
    // Remove last space element
    // access all elements by class
    var ele = document.getElementsByClassName('space');
    // find last element
    var lastEle = ele[ ele.length-1 ]; 
    // remove it
    lastEle.remove();
    isLoading = false;
}



// Add Keyup event listener 
document.getElementById("GameArea").addEventListener("keyup", function(event) {
    if(isGameOver)
    {
        // return early if game and has already been played
        quoteDisplayElement.innerText = 'GAME OVER';
        return;
    }
    // Check if game is Started? If not started then start the gameI
    if(!game.isGameRunning)
    {
        game.isGameRunning = true;
        game.StartGame();
    }
    // currently pressed key
    const PressedKey = event.key;
    //alert(PressedKey);
    if(PressedKey === 'CapsLock')
    {
        // return early if CapsLock is pressed as it is not a valid key
        return;
    }
    const isBackspace = PressedKey === 'Backspace';
    const isLetter = PressedKey.length === 1 && PressedKey !== ' ';
    const isSpace = PressedKey === ' ';
    // Get Current Letter and Current Word
    let currentWord = document.querySelector('.current-word');
    let currentLetter = document.querySelector('.current-letter');
    // Get the expected letter
    const expectedLetter = currentLetter?.innerHTML;

    // First check backspace
    if(isBackspace)
    {
        //alert('Backspace Pressed');
        // Handle Backspace
        let prevLetter = currentLetter?.previousElementSibling;
        let prevWord = currentWord?.previousElementSibling;
        if(prevLetter === null && currentWord === wordsToType.firstElementChild)
        {
            //alert('No previous letter or word to move to');
            // there is no previous letter or word to move to 
            return;
        }
        if(prevWord !== null)
        {
            // First Letter in the current word
            if(prevLetter === null)
            {
                // This should only happen if the previous letter is null
            if(prevWord.classList.contains('space'))
            {
                //alert('Previous is at space');
                let prevSpace = prevWord;
                let tempPrevWord = prevWord.previousElementSibling;
                if(prevSpace === null)
                {
                    alert('No previous word to move to');
                    return;
                }
                if(tempPrevWord === null)
                {
                    alert('No current letter to move to');
                    return;
                }
                // Set previous space to current letter
                prevSpace.classList.add('current-letter');
                // Remove current letter correct and incorrect classes
                currentLetter.classList.remove('current-letter');
                currentLetter.classList.remove('correct');
                currentLetter.classList.remove('incorrect');
                // Set current letter to the space
                currentLetter = prevSpace;
                // remove correct and incorrect classes from the current letter (the space)
                currentLetter.classList.remove('correct');
                currentLetter.classList.remove('incorrect');
                // move the current word to the previous word
                currentWord.classList.remove('current-word');
                tempPrevWord.classList.add('current-word');
               
                currentWord = tempPrevWord;
                console.log(prevSpace);
                console.log(tempPrevWord);
                // //console.log(tempPrevWord);
                // // set current letter to the space
                // tempCurrentLetter.classList.add('current-letter');
                // tempCurrentLetter.classList.remove('correct');
                // tempCurrentLetter.classList.remove('incorrect');
                // currentLetter.classList.remove('current-letter');
                // currentLetter = tempCurrentLetter;
                // // move to the previous word
                // //alert('Previous is at space');
                // tempPrevWord.classList.add('current-word');
                // currentWord.classList.remove('current-word');
                // currentWord = tempPrevWord;
            }
            }
            
        }
        if(prevLetter !== null)
        {
            if(prevLetter.classList.contains('letter'))
            {
                // MOVE TO THE PREVIOUS LETTER
                currentLetter.classList.remove('current-letter');
                prevLetter.classList.add('current-letter');
                prevLetter.classList.remove('correct');
                prevLetter.classList.remove('incorrect');
                //console.log('Move to the previous letter');
            }
            if(prevLetter.classList.contains('word'))
            {
                // Current is at space
                let prevLetter = currentLetter.previousElementSibling;
                //console.log(prevLetter);
                //console.log('I am at space move to the previous letter');
                // MOVE TO THE PREVIOUS LETTER
                currentLetter.classList.remove('current-letter');
                prevLetter.lastChild.classList.add('current-letter');
                prevLetter.lastChild.classList.remove('correct');
                prevLetter.lastChild.classList.remove('incorrect');
                currentLetter = prevLetter.lastChild;
            }
        }
    }else
    {
        // then check space
        if(isSpace)
        {
            //alert('Space Pressed');
            //console.log(expectedLetter);
            if(expectedLetter === '⠀')
            {
                //alert('Space is expected');
                // Move to the next letter if there is one
                if(currentLetter.nextElementSibling !== null)
                {
                    currentLetter.nextElementSibling.childNodes[0].classList.add('current-letter');
                    currentLetter.classList.add('correct');
                    currentLetter.classList.remove('current-letter');
                    let nextWord = currentWord.nextElementSibling;
                    currentWord.classList.remove('current-word');
                    nextWord.nextElementSibling.classList.add('current-word');
                    currentWord = nextWord;
                }else{
                    //alert('No next letter word or space to move to');
                    GetQuoteAndFormatWords();
                }
            }
        }else{
            // Handle Change of Letter
            if(isLetter)
            {
                if(currentLetter)
                {
                    if(PressedKey === expectedLetter)
                    {
                        // if key correct add correct class to the letter and move to the next letter
                        currentLetter.classList.add('correct');
                        currentLetter.classList.remove('current-letter');
                        //alert(currentLetter.nextElementSibling.innerHTML);
                        if(currentLetter.nextElementSibling !== null)
                        {
                            currentLetter.nextElementSibling.classList.add('current-letter');
                        }else
                        {
                            //  Check if there is a space next
                            let isSpaceNext = currentWord.nextElementSibling?.classList.contains('space');
                            if(isSpaceNext)
                            {
                                //alert('Space is next');
                                // move current letter to the space
                                currentLetter.classList.remove('current-letter');
                                currentWord.nextElementSibling.classList.add('current-letter');
                            }else
                            {
                                // Check if thre is a next word
                                let nextWord = currentWord?.nextElementSibling?.nextElementSibling;
                                if(nextWord === null || nextWord === undefined)
                                {
                                    // Get the next quote and format the words
                                    //GetQuoteAndFormatWords();
                                    return;
                                }else
                                {
                                    // Move to the next word
                                    currentWord.classList.remove('current-word');
                                    nextWord.classList.add('current-word');
                                    nextWord.firstElementChild.classList.add('current-letter');
                                }
                            }
                            
                        }
                        
                    }
                    else
                    {
                        // if at space and pressed letter instead of space
                        if(currentLetter.classList.contains('space'))
                        {
                            // Pressed Letter instead of space
                            currentLetter.classList.add('incorrect');
                            // Move to the next Word
                            let tempNextWord = currentWord?.nextElementSibling?.nextElementSibling;
                            if(tempNextWord !== null)
                            {
                                // There is a next word to move to.
                                console.log(tempNextWord);
                                tempNextWord.classList.add('current-word');
                                currentWord.classList.remove('current-word');
                                currentWord = tempNextWord;
                                // Move to the first letter of the next word
                                let tempNextLetter = tempNextWord.firstElementChild;
                                currentLetter.classList.remove('current-letter');
                                currentLetter = tempNextLetter;
                                currentLetter.classList.add('current-letter');
                            }else
                            {
                                //alert('No next word to move to');
                                GetQuoteAndFormatWords();
                            }
                        }else
                        {
                            // This is at letter and pressed wrong key
                            // if key incorrect add incorrect class to the letter
                            currentLetter.classList.add('incorrect');
                            let tempNextLetter = currentLetter.nextElementSibling;
                            if(tempNextLetter !== null)
                            {
                                console.log("wrong letter pressed and there is a next letter to mover to");
                                currentLetter.nextElementSibling.classList.add('current-letter');
                                currentLetter.classList.remove('current-letter');
                            }else
                                {
                                    // No next letter to move to
                                    // Check if there is a space to move to
                                    let tempSpace = currentWord?.nextElementSibling;
                                    if(tempSpace !== null)
                                    {
                                        // Move current letter to the space
                                        tempSpace.classList.add('current-letter');
                                        currentLetter.classList.remove('current-letter');
                                        currentLetter = tempSpace;
                                    }else
                                    {
                                        //alert('No next letter or space to move to');
                                        GetQuoteAndFormatWords();
                                    }
                                }
                            }
                        

                    }
                } else
                {
                    if(isLoading === false)
                    {
                        alert(currentLetter.innerHTML);
                        //alert('No current letter');
                        // Get the next quote and format the words
                        //GetQuoteAndFormatWords();
                    }
                    //alert('No current letter');
                
                }
            }
        }
    }
});

// Get the next quote and format the words
function GetQuoteAndFormatWords(){
    isLoading = true;
    getNextQuote().then(() => {
        addLetterClassesToWords();
    });
}
// Call the function to get the next quote and format the words on load of the page
GetQuoteAndFormatWords();

// New Game Object will be created on load of the page
// Game starts when a person starts typing
class Game {
    timeLeft = 30;
    wordsPerMinute = 0;
    wordsTypedCorrectly = 0;
    isGameRunning = false;


    constructor(timeLeft, wordsPerMinute, wordsTypedCorrectly, isGameRunning){
        this.timeLeft = timeLeft;
        this.wordsPerMinute = wordsPerMinute;
        this.wordsTypedCorrectly = wordsTypedCorrectly;
        this.isGameRunning = isGameRunning;
    }

    StartGame(){
        // Start Timer
        var timerElement = document.getElementById('timer');
        console.log(this.timeLeft);
        var timer = setInterval(() => {
            if(this.timeLeft <= 0)
            {
                clearInterval(timer);
                this.isGameRunning = false;
                isGameOver = true;
                quoteDisplayElement.innerText = 'GAME OVER';
                showEndGameModal();
            }
            timerElement.innerHTML = "Time Left: 00:" + this.timeLeft;
            this.timeLeft--;
        }, 1000);
    }
};

var game = new Game(30, 0, 0, false);

// Always Highlight the current Letter for simplicity
// KEY EVENTS POSSIBLE SCENARIOS
// Check the direction of movement if not backspace -> else <-, then check if there is the next element to move to
// 1. Correct Key Pressed -> Highlight the letter correct and move to the next letter
// 2. Incorrect Key Pressed -> Highlight the letter incorrect and move to the next letter
// 3. Space Key Pressed -> Move to the next letter or space
// 4. Backspace Key Pressed -> delete current letter and move to the previous letter
