var product = 1;
var count3 = 0;
var pop3 = 0;
var meme3 = document.getElementById("demo3");
var sec3 = 10;

// pop up
var popup3 = document.getElementById("popup3");
var popup_content3 = document.getElementById("popup_content3");
var popup_text3 = document.getElementById('popup_text3');
var close_popup3 = document.getElementById("close_popup3");
var popup_next3 = document.getElementById('popup_next3');

// common operation apply to all
close_popup3.onclick = function () {
    popup3.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == popup3) {
        popup3.style.display = "none";
    }
}

// countdown time
var ct3 = document.getElementById('countdownTime3');
var cd3;

function countDown3() {
    if (sec3 < 0) {
        // disable input 
        document.getElementById('answercheck3').disabled = true;

        ct3.innerHTML = 'Remaining Time: ';

        // show pop up 
        popup_text3.innerHTML = "Times up! The correct answer is " + product + ".";
        popup_next3.innerHTML = "Next question";
        popup3.style.display = 'block';
        popup_content3.style.backgroundColor = 'rgba(245, 229, 54, 1)';

        popup_next3.focus();

        popup_next3.addEventListener('click', Reload3);

        // hit enter key 
        popup_next3.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload3();
            }
        }
    }

    else {
        ct3.innerHTML = "Remaining Time: " + sec3;
        sec3--;
        cd3 = setTimeout(countDown3, 1000);
        cd3;
    }
}

// stop counting when user quit
var close3 = document.getElementById('close3');
close3.addEventListener('click', closeProgram3);

function closeProgram3() {
    Reload3();
}


// prompt user to asnwer
function readyToAnswer3() {
    let demo3 = document.getElementById('demo3');
    demo3.innerHTML = "Enter answer";
    demo3.style.fontSize = "70px";
    document.getElementById('numberIndex3').innerHTML = 'Number: ';
}

// hit enter to check answer
var enterAnswer3 = document.getElementById('answercheck3');
enterAnswer3.addEventListener('keyup', checkAnswer3);

function checkAnswer3(event) {
    if (event.keyCode == 13 && enterAnswer3.value != '') {
        Check3();
    }
}


function timr3() {
    document.getElementById('answercheck3').focus();

    document.getElementById('beginButton3').disabled = true;

    if (count3 < document.getElementById("count3").value) {
        setTimeout(Multiply, document.getElementById("num3").value * 1000);
        count3++;
    }
    else {
        setTimeout(readyToAnswer3, document.getElementById("num3").value * 1000);
        setTimeout(countDown3, 1000);
        count3 = 0;
    }
}


function Multiply() {
    var x3 = document.getElementById("demo3");
    var y3 = document.getElementById("digits3").value;
    var numIndex3 = document.getElementById('numberIndex3');

    pop3 = Math.floor(Math.random() * (Math.pow(10, y3) - Math.pow(10, (y3 - 1))) + Math.pow(10, (y3 - 1)));
    product *= pop3;
    numIndex3.innerHTML = "Number: " + count3;

    x3.innerHTML = pop3;

    timr3();
    meme3.style.display = '';
}

function Reload3() {
    popup3.style.display = 'none';

    clearTimeout(cd3);
    sec3 = 10;
    ct3.innerHTML = "Remaining Time: ";

    document.getElementById('answercheck3').disabled = false;
    document.getElementById('beginButton3').disabled = false;

    document.getElementById("answercheck3").value = '';

    product = 1;
    pop3 = 0;
    count3 = 0;

    meme3.style.display = 'none';
}

function Hiding3() {
    alert(product);
}

function Check3() {
    popup3.style.display = "block";

    // without answer
    if (document.getElementById("answercheck3").value == '') {
        popup_content3.style.backgroundColor = 'rgba(254, 254, 254, 1)';

        popup_text3.innerHTML = "Please enter your answer";
        popup_next3.innerHTML = 'OK';

        popup_next3.focus();

        popup_next3.onclick = function () {
            popup3.style.display = 'none';
        };

        // hit enter key 
        popup_next3.onkeyup = function (event) {
            if (event.keyCode == 13) {
                popup3.style.display = 'none';
            }
        }
    }

    // answer is correct
    else if (document.getElementById("answercheck3").value == product) {
        clearTimeout(cd3);
        ct3.innerHTML = 'Remaining Time: ';

        popup_content3.style.backgroundColor = 'rgba(73, 245, 111, 1)';

        popup_text3.innerHTML = "You are right!";
        popup_next3.innerHTML = "Next Question";
        popup_next3.focus();

        popup_next3.addEventListener('click', Reload3);

        // hit enter key 
        popup_next3.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload3();
            }
        }
    }

    // asnwer is wrong
    else {
        popup_content3.style.backgroundColor = 'rgba(255, 92, 92, 1)';

        popup_text3.innerHTML = "Wrong answer. Please try again.";
        popup_next3.innerHTML = "Try again.";
        popup_next3.focus();

        popup_next3.removeEventListener('click', Reload3);
        popup_next3.onclick = function () {
            document.getElementById("answercheck3").value = '';
            popup3.style.display = 'none';
            document.getElementById("answercheck3").focus();
        }

        // hit enter key 
        popup_next3.onkeyup = function (event) {
            if (event.keyCode == 13) {
                document.getElementById("answercheck3").value = '';
                popup3.style.display = 'none';
                document.getElementById("answercheck3").focus();
            }
        }

    }
}