const RANDOM_QUOTE_API_URL = 'http://api.quotable.io/random';
const quoteDisplayElement = document.getElementById('wordsToType');
function getRandomQuote() {
    return fetch(RANDOM_QUOTE_API_URL)
        .then(response => response.json())
        .then(data => data.content)
}

async function getNextQuote() {
    const quote = await getRandomQuote()
    console.log(quote)
    quoteDisplayElement.innerText = quote;
}

// getNextQuote().then(() => {
//     addLetterClassesToWords();
// });

function formatWord(word){
    return `<div class="word" style="margin: 5px"><span class="letter">${word.split('').join('</span><span class="letter">')}</span></div>`;
}

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
}

// Add Keyup event listener 
document.getElementById("GameArea").addEventListener("keyup", function(event) {
    const key = event.key;
    let currentLetter = document.querySelector('.current-letter');
    if(currentLetter === null)
    {
        // Space
        currentLetter = "";
    }
    console.log(currentLetter);
    const expectedLetter = currentLetter?.innerHTML == null ? ' ' : currentLetter.innerHTML;
    alert("Expected Letter: " + expectedLetter);
    const currentWord = document.querySelector('.current-word');
    const isLetter = key.length === 1 && key !== ' ';
    const isSpace = key === ' ';
    if(isLetter)
    {
        if(currentLetter)
        {
            if(key === expectedLetter)
            {
                // if key correct add correct class to the letter and move to the next letter
                currentLetter.classList.add('correct');
                currentLetter.classList.remove('current-letter');
                if(currentLetter.nextElementSibling !== null)
                {
                    currentLetter.nextElementSibling.classList.add('current-letter');
                }
                
            }
            else
            {
                // if key incorrect add incorrect class to the letter
                currentLetter.classList.add('incorrect');
            }
        } 
    }
    if(isSpace)
    {
        alert("Current Letter: " + currentLetter);
        // Check if on the last letter of the word and if so move to the next word
        if(currentLetter === currentWord.lastElementChild)
        {
            alert('On the last letter of the word lets move to the next word');
            currentWord.classList.remove('current-word');
            currentWord.nextElementSibling.classList.add('current-word');
            currentLetter = currentWord.firstChild;
            console.log(currentLetter);

        }
        if(expectedLetter !== ' ')
        {
            // space not expexted so add incorrect class to the letter and move to the next letter
            currentLetter.classList.add('incorrect');
            currentLetter.classList.remove('current-letter');
            currentLetter.nextElementSibling.classList.add('current-letter');
        }
    }
    console.log(event.key, expectedLetter);
});

function Game(){
    getNextQuote().then(() => {
        addLetterClassesToWords();
    });
}

Game();

//addLetterClassesToWords();