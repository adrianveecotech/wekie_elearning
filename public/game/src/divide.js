var quo = 0;
var q1 = 0;
var q2 = 0;
var realans = 0;
var meme4 = document.getElementById("demo4");
var sec4 = 10;
var count4 = 0;
var hasRun = false;

// pop up
var popup4 = document.getElementById("popup4");
var popup_content4 = document.getElementById("popup_content4");
var popup_text4 = document.getElementById('popup_text4');
var close_popup4 = document.getElementById("close_popup4");
var popup_next4 = document.getElementById('popup_next4');

// common operation apply to all
close_popup4.onclick = function () {
    popup4.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == popup4) {
        popup4.style.display = "none";
    }
}

// countdown time
var ct4 = document.getElementById('countdownTime4');
var cd4;

function countDown4() {
    if (sec4 < 0) {
        // disable input 
        document.getElementById('answercheck4').disabled = true;

        ct4.innerHTML = 'Remaining Time: ';

        // show pop up
        popup_text4.innerHTML = "Times up! The correct answer is " + realans + ".";
        popup_next4.innerHTML = "Next question";
        popup4.style.display = 'block';
        popup_content4.style.backgroundColor = 'rgba(245, 229, 54, 1)';

        popup_next4.focus();

        popup_next4.addEventListener('click', Reload4);

        // hit enter key 
        popup_next4.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload4();
            }
        }
    }

    else {
        ct4.innerHTML = "Remaining Time: " + sec4;
        sec4--;
        cd4 = setTimeout(countDown4, 1000);
        cd4;
    }
}

// stop counting when user quit
var close4 = document.getElementById('close4');
close4.addEventListener('click', closeProgram4);

function closeProgram4() {
    Reload4();
}

// prompt user to asnwer
function readyToAnswer4() {
    let demo4 = document.getElementById('demo4');
    demo4.innerHTML = "Enter answer";
    demo4.style.fontSize = "70px";
    document.getElementById('numberIndex4').innerHTML = 'Number: ';
}

// hit enter to check answer
var enterAnswer4 = document.getElementById('answercheck4');
enterAnswer4.addEventListener('keyup', checkAnswer4);

function checkAnswer4(event) {
    if (event.keyCode == 13 && enterAnswer4.value != '') {
        Check4();
    }
}

function timr4() {
    document.getElementById('answercheck4').focus();

    document.getElementById('beginButton4').disabled = true;

    if (count4 < 2) {
        setTimeout(Divide, document.getElementById("num4").value * 1000);
        count4++;
    }
    else {
        setTimeout(readyToAnswer4, document.getElementById("num4").value * 1000);
        setTimeout(countDown4, 1000);
        count4 = 0;
    }
}


function Divide() {
    var x4 = document.getElementById("demo4");
    var y4 = document.getElementById("digits4").value;
    var numIndex4 = document.getElementById('numberIndex4');

    if (!hasRun) {
        q2 = Math.floor(Math.random() * (Math.pow(10, y4) - Math.pow(10, (y4 - 1))) + Math.pow(10, (y4 - 1)));
        q1 = Math.floor(Math.random() * (Math.pow(10, y4) - Math.pow(10, (y4 - 1))) + Math.pow(10, (y4 - 1)));
        quo = q1 * q2;
        realans = q1;
        hasRun = true;
    }


    numIndex4.innerHTML = "Number: " + count4;

    if (count4 == 1) {
        x4.innerHTML = quo
    }
    else {
        x4.innerHTML = q2;
    }

    timr4();
    meme4.style.display = '';
}

function Reload4() {
    popup4.style.display = 'none';

    clearTimeout(cd4);
    sec4 = 10;
    ct4.innerHTML = "Remaining Time: ";

    hasRun = false;
    document.getElementById('answercheck4').disabled = false;
    document.getElementById('beginButton4').disabled = false;

    document.getElementById("answercheck4").value = '';

    realans = 0;
    q2 = 0;
    q1 = 0;
    quo = 0;
    count4 = 0;

    meme4.style.display = 'none';
}

function Hiding4() {
    alert(realans);
}

function Check4() {
    popup4.style.display = "block";

    // without answer
    if (document.getElementById("answercheck4").value == '') {
        popup_content4.style.backgroundColor = 'rgba(254, 254, 254, 1)';

        popup_text4.innerHTML = "Please enter your answer";
        popup_next4.innerHTML = 'OK';

        popup_next4.focus();

        popup_next4.onclick = function () {
            popup4.style.display = 'none';
        };

        // hit enter key 
        popup_next4.onkeyup = function (event) {
            if (event.keyCode == 13) {
                popup4.style.display = 'none';
            }
        }
    }

    // answer is correct
    else if (document.getElementById("answercheck4").value == realans) {
        clearTimeout(cd4);
        ct4.innerHTML = 'Remaining Time: ';

        popup_content4.style.backgroundColor = 'rgba(73, 245, 111, 1)';

        popup_text4.innerHTML = "You are right!";
        popup_next4.innerHTML = "Next Question";
        popup_next4.focus();

        popup_next4.addEventListener('click', Reload4);

        // hit enter key 
        popup_next4.onkeyup = function (event) {
            if (event.keyCode == 13) {
                Reload4();
            }
        }
    }

    // answer is wrong 
    else {
        popup_content4.style.backgroundColor = 'rgba(255, 92, 92, 1)';

        popup_text4.innerHTML = "Wrong answer. Please try again.";
        popup_next4.innerHTML = "Try again.";
        popup_next4.focus();

        popup_next4.removeEventListener('click', Reload4);
        popup_next4.onclick = function () {
            document.getElementById("answercheck4").value = '';
            popup4.style.display = 'none';
            document.getElementById("answercheck4").focus();
        }

        // hit enter key 
        popup_next4.onkeyup = function (event) {
            if (event.keyCode == 13) {
                document.getElementById("answercheck4").value = '';
                popup4.style.display = 'none';
                document.getElementById("answercheck4").focus();
            }
        }
    }
}