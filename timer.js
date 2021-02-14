
var	clsStopwatch = function() {

    var	startAt	= 0;	
    var	lapTime	= 0;

    var	now	= function() {
            return (new Date()).getTime(); 
        }; 


    this.startTimer = function() {
            startAt	= startAt ? startAt : now();
        };

    this.stop = function() {
          
            lapTime	= startAt ? lapTime + now() - startAt : lapTime;
            startAt	= 0; 
        };

    this.resetTimer = function() {
            lapTime = startAt = 0;
        };

    this.time = function() {
            return lapTime + (startAt ? now() - startAt : 0); 
        };
};

var x = new clsStopwatch();
var $time;
var clocktimer;

function pad(num, size) {
    var s = "0000" + num;
    return s.substr(s.length - size);
}

function formatTime(time) {
    var h = m = s = ms = 0;
    var newTime = '';

    h = Math.floor( time / (60 * 60 * 1000) );
    time = time % (60 * 60 * 1000);
    m = Math.floor( time / (60 * 1000) );
    time = time % (60 * 1000);
    s = Math.floor( time / 1000 );
    ms = time % 1000;

    newTime = pad(h, 2) + ':' + pad(m, 2) + ':' + pad(s, 2) + ':' + pad(ms, 3);
    return newTime;
}

function show() {
    $time = document.getElementById('time');
    update();
}

function update() {
    $time.innerHTML = formatTime(x.time());
}

function startTimer() {
    clocktimer = setInterval("update()", 1);
    x.startTimer();
}

function stop() {
    x.stop();
    clearInterval(clocktimer);
}

function resetTimer() {
    stop();
    x.resetTimer();
    update();
}