// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var closePassChange = document.getElementById("closePassChange");

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closePassChange.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}




// Get the modal
var blackListModal = document.getElementById('blackListModal');

// Get the button that opens the modal
var btnBlackList = document.getElementById("btnBlackList");

// Get the <span> element that closes the modal
var closeBlackList = document.getElementById("closeBlackList");

// When the user clicks on the button, open the modal 
btnBlackList.onclick = function() {
    blackListModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeBlackList.onclick = function() {
    blackListModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == blackListModal) {
        blackListModal.style.display = "none";
    }
}


// Get the modal
var gamesModal = document.getElementById('gamesModal');

// Get the button that opens the modal
var gameBtn = document.getElementById("gameBtn");

// Get the <span> element that closes the modal
var closeGames = document.getElementById("closeGames");

// When the user clicks on the button, open the modal 
gameBtn.onclick = function() {
    gamesModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeGames.onclick = function() {
    gamesModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == gamesModal) {
        gamesModal.style.display = "none";
    }
}





var emojiModal = document.getElementById('emojiModal');

// Get the button that opens the modal
var btnEmojiList = document.getElementById("btnEmojiList");

// Get the <span> element that closes the modal
var closeEmojiList = document.getElementById("closeEmojiList");

// When the user clicks on the button, open the modal 
btnEmojiList.onclick = function() {
    emojiModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeEmojiList.onclick = function() {
    emojiModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == emojiModal) {
        emojiModal.style.display = "none";
    }
}
