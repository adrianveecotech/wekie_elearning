var sum = 0;
var count = 0;
var pop = 0;
var meme = document.getElementById("demo");
var sec = 10;

// pop up
var popup = document.getElementById("popup");
var popup_content = document.getElementById("popup_content");
var popup_text = document.getElementById('popup_text');
var close_popup = document.getElementById("close_popup");
var popup_next = document.getElementById('popup_next');

// common operation apply to all
close_popup.onclick = function () {
    popup.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}



// countdown time
var ct = document.getElementById('countdownTime');
var cd;


function countDown() {
    if (sec < 0) {
        // disable input 
        document.getElementById('answercheck').disabled = true;

        ct.innerHTML = 'Remaining Time: ';

        // move to next question
        popup_text.innerHTML = "Times up! The correct answer is " + sum + ".";
        popup_next.innerHTML = "Next question";
        popup.style.display = 'block';
        popup_content.style.backgroundColor = 'rgba(245, 229, 54, 1)';

        popup_next.focus();

        popup_next.addEventListener('click', Reload);

        // hit enter key 
        popup_next.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload();
            }
        }
    }

    else {
        ct.innerHTML = "Remaining Time: " + sec;
        sec--;
        cd = setTimeout(countDown, 1000);
        cd;
    }
}

// stop counting when user quit
var close = document.getElementById('close');
close.addEventListener('click', closeProgram);

function closeProgram() {
    Reload();    
}

// prompt user to asnwer
function readyToAnswer() {
    let demo = document.getElementById('demo');
    demo.innerHTML = "Enter answer";
    demo.style.fontSize = "70px";
    document.getElementById('numberIndex').innerHTML = 'Number: ';
}

// hit enter to check answer
var enterAnswer = document.getElementById('answercheck');
enterAnswer.addEventListener('keyup', checkAnswer);

function checkAnswer(event) {
    if (event.keyCode == 13 && enterAnswer.value != '') {
        Check();
    }
}

function timr() {
    document.getElementById('answercheck').focus();
    document.getElementById('beginButton').disabled = true;
    if (count < document.getElementById("count").value) {
        setTimeout(Adding, document.getElementById("num").value * 1000);
        count++;
    }
    else {
        setTimeout(readyToAnswer, document.getElementById("num").value * 1000);
        setTimeout(countDown, 1000);
        count = 0;
    }
}

function Adding() {
    var x = document.getElementById("demo")
    var y = document.getElementById("digits").value
    var numIndex = document.getElementById('numberIndex');

    pop =  ((Math.round(Math.random()) * 2) - 1) * (Math.floor(Math.random() * (Math.pow(10, y) - Math.pow(10, (y - 1))) + Math.pow(10, (y - 1))));
    sum += pop;

 
    numIndex.innerHTML = "Number: " + count;
    x.innerHTML = pop;
    timr();
    meme.style.display = '';
}

function Reload() {
    popup.style.display = 'none';

    clearTimeout(cd);
    ct.innerHTML = 'Remaining Time: ';
    sec = 10;

    document.getElementById('answercheck').disabled = false;
    document.getElementById('beginButton').disabled = false;

    document.getElementById("answercheck").value = '';

    sum = 0;
    pop = 0;
    count = 0;

    meme.style.display = 'none';
}

function Hiding() {
    alert(sum);
}

function Check() {
    popup.style.display = "block";

    // without answer 
    if (document.getElementById("answercheck").value == '') {
        popup_content.style.backgroundColor = 'rgba(254, 254, 254, 1)';

        popup_text.innerHTML = "Please enter your answer";
        popup_next.innerHTML = 'OK';

        popup_next.focus();

        popup_next.onclick = function () {
            popup.style.display = 'none';
        };

        // hit enter key 
        popup_next.onkeyup = function (event) {
            if (event.keyCode == 13) {
                popup.style.display = 'none';
            }
        }
    }

    // answer is correct
    else if (document.getElementById("answercheck").value == sum) {
        clearTimeout(cd);
        ct.innerHTML = 'Remaining Time: ';

        popup_content.style.backgroundColor = 'rgba(73, 245, 111, 1)';

        popup_text.innerHTML = "You are right!";
        popup_next.innerHTML = "Next Question";
        popup_next.focus();

        popup_next.addEventListener('click', Reload);

        // hit enter key 
        popup_next.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload();
            }
        }
    }

    // wrong answer 
    else {
        popup_content.style.backgroundColor = 'rgba(255, 92, 92, 1)';

        popup_text.innerHTML = "Wrong answer. Please try again.";
        popup_next.innerHTML = "Try again.";
        popup_next.focus();

        popup_next.removeEventListener('click', Reload);
        popup_next.onclick = function () {
            document.getElementById("answercheck").value = '';
            popup.style.display = 'none';
            document.getElementById("answercheck").focus();
        }

        // hit enter key 
        popup_next.onkeyup = function (event) {
            if (event.keyCode == 13) {
                document.getElementById("answercheck").value = '';
                popup.style.display = 'none';
                document.getElementById("answercheck").focus();
            }
        }
    }


}   

