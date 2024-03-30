// Global Variables
let isLoading = false;
let isGameOver = false; 

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
    return `<div class="word" style="margin: 5px"><span class="letter">${word.split('').join('</span><span class="letter">')}</span></div><div class="space">SPACE</div>`;
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
    const currentWord = document.querySelector('.current-word');
    let currentLetter = document.querySelector('.current-letter');
    // Get the expected letter
    const expectedLetter = currentLetter?.innerHTML == null ? ' ' : currentLetter.innerHTML;
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
                    // First Check if there is a space next
                    isSpaceNext = currentWord.nextElementSibling?.classList.contains('space');
                    if(isSpaceNext)
                    {
                        alert('Space is next');
                        // move current letter to the space
                        //currentLetter.classList.remove('current-letter');
                        //currentWord.nextElementSibling.classList.add('current-letter');
                    }
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
            else
            {
                // if key incorrect add incorrect class to the letter
                currentLetter.classList.add('incorrect');
                // move to the next letter
                //currentLetter.classList.remove('current-letter');
                if(currentLetter.nextElementSibling !== null)
                {
                    currentLetter.nextElementSibling.classList.add('current-letter');
                    currentLetter.classList.remove('current-letter');
                }else
                {
                    // Check if there is a next word
                    let nextWord = currentWord?.nextElementSibling?.nextElementSibling;
                    if(nextWord === null)
                    {
                        
                        // Get the next quote and format the words
                        //GetQuoteAndFormatWords();
                        return;
                    }else
                    {
                        // Move to the next word
                        currentWord.classList.remove('current-word');
                        nextWord.classList.add('current-word');
                        alert(nextWord.firstElementChild.innerHTML);
                        nextWord.firstElementChild.classList.add('current-letter');
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
    if(isSpace)
    {
        // Re - write the code that handles the space key
    }
    if(isBackspace)
    {
        // Re - write the code that handles the backspace key
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
                alert('Game Over');
            }
            timerElement.innerHTML = "Time Left: 00:" + this.timeLeft;
            this.timeLeft--;
        }, 1000);
    }
};

var game = new Game(30, 0, 0, false);
