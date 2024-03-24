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

getNextQuote().then(() => {
    addLetterClassesToWords();
});

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
    $('.word').first().addClass('current-word');
    $('.letter').first().addClass('current-letter');
}

// Add Keyup event listener 
document.getElementById("GameArea").addEventListener("keyup", function(event) {
    const key = event.key;
    const currentLetter = document.querySelector('.current-letter');
    const expectedLetter = currentLetter.innerHTML;
    const currentWord = document.querySelector('.current-word');


    console.log(event.key, expectedLetter);
});

//addLetterClassesToWords();