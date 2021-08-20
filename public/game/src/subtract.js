var sum2 = 0;
var count2 = 0;
var pop2 = 0;
var meme2 = document.getElementById("demo2");
var sec2 = 10;

// countdown time
var ct2 = document.getElementById('countdownTime2');
var cd2;

function countDown2() {
    if (sec2 < 0) {
        // disable input 
        document.getElementById('answercheck2').disabled = true;

        ct2.innerHTML = 'Remaining Time: ';

        // move to next question
        if (confirm("Times up!\nThe correct answer is " + sum2 + ".\nPlease try next question.")) {
            Reload2();
        }
    }

    else {
        ct2.innerHTML = "Remaining Time: " + sec2;
        sec2--;
        cd2 = setTimeout(countDown2, 1000);
        cd2;
    }
}

// stop counting when user quit
var close2 = document.getElementById('close2');
close2.addEventListener('click', closeProgram2);

function closeProgram2() {
    Reload2();
}


// prompt user to asnwer
function readyToAnswer2() {
    let demo2 = document.getElementById('demo2');
    demo2.innerHTML = "Enter answer";
    demo2.style.fontSize = "70px";
    document.getElementById('numberIndex2').innerHTML = 'Number: ';
}

// hit enter to check answer
var enterAnswer2 = document.getElementById('answercheck2');
enterAnswer2.addEventListener('keyup', checkAnswer2);

function checkAnswer2(event) {
    if (event.keyCode == 13 && enterAnswer2.value != '') {
        Check2();
    }
}

function timr2() {
    document.getElementById('beginButton2').disabled = true;

    if (count2 < document.getElementById("count2").value) {
        setTimeout(Subtract, document.getElementById("num2").value * 1000);
        count2++;
    }
    else {
        setTimeout(readyToAnswer2, document.getElementById("num2").value * 1000);
        setTimeout(countDown2, 1000);
        count2 = 0;
    }
}

function Subtract() {
    var x2 = document.getElementById("demo2");
    var y2 = document.getElementById("digits2").value;
    var numIndex2 = document.getElementById('numberIndex2');

    pop2 = ((Math.round(Math.random()) * 2) - 1) * (Math.floor(Math.random() * (Math.pow(10, y2) - Math.pow(10, (y2 - 1))) + Math.pow(10, (y2 - 1))));
    sum2 += pop2;

    numIndex2.innerHTML = "Number: " + count2;

    x2.innerHTML = pop2;
    timr2();
    meme2.style.display = '';
}

function Reload2() {
    clearTimeout(cd2);
    sec2 = 10;
    ct2.innerHTML = "Remaining Time: ";

    document.getElementById('answercheck2').disabled = false;
    document.getElementById('beginButton2').disabled = false;

    document.getElementById("answercheck2").value = '';

    sum2 = 0;
    pop2 = 0;
    count2 = 0;

    meme2.style.display = 'none';
}

function Hiding2() {
    alert(sum2);
}

function Check2() {
    if (document.getElementById("answercheck2").value == '') {
        alert("Please enter your answer");
    }

    else if (document.getElementById("answercheck2").value == sum2) {
        clearTimeout(cd2);
        ct2.innerHTML = 'Remaining Time: ';

        // move to next question
        if (confirm("You are right!\nTry next question!")) {
            Reload2();
        }
    }
    else {
        alert("Wrong answer.\nPlease try again.");
        document.getElementById("answercheck").value = '';
    }
}