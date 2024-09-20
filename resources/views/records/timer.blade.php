<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet"  href="/index.css">
         <!--<script src='timer.js' defer></script>-->
    </head>
    <body>
        <nav>
            <ul class="gnav-navi-1">
            <li><a href="/">記録</a></li>
            <li><a href="/timer">タイマー</a></li>
            <li><a href="calories">体重記録</a></li>
            <li><a href="/post">チャット</a></li>
            </ul>
        </nav>
        

    
   
   
        
    <div class=watch>
        <h1>ストップウォッチ</h1>
        <div id="container">
            <div id="timer">00:00:00.000</div>
            <div id="buttons">
                <input id="start" type="button" value="start">
                <input id="stop" type="button" value="stop">
                <input id="reset" type="button" value="reset">
            </div>
        </div>
    </div>
       <script>
           
    window.onload = function() {
        const time = document.getElementById('timer');
        const startButton = document.getElementById('start');
        const stopButton = document.getElementById('stop');
        const resetButton = document.getElementById('reset');

        let startTime;
        let stopTime = 0;
        let timeoutID;

        function displayTime() {
            const currentTime = new Date(Date.now() - startTime + stopTime);
            const h = String(currentTime.getUTCHours()).padStart(2, '0');
            const m = String(currentTime.getUTCMinutes()).padStart(2, '0');
            const s = String(currentTime.getUTCSeconds()).padStart(2, '0');
            const ms = String(currentTime.getUTCMilliseconds()).padStart(3, '0');

            time.textContent = `${h}:${m}:${s}:${ms}`;
            timeoutID = setTimeout(displayTime, 10);
        }

        startButton.addEventListener('click', () => {
            startButton.disabled = true;
            stopButton.disabled = false;
            resetButton.disabled = true;
            startTime = Date.now();
            displayTime();
        });

        stopButton.addEventListener('click', function() {
            startButton.disabled = false;
            stopButton.disabled = true;
            resetButton.disabled = false;
            clearTimeout(timeoutID);
            stopTime += (Date.now() - startTime);
        });

        resetButton.addEventListener('click', function() {
            startButton.disabled = false;
            stopButton.disabled = true;
            resetButton.disabled = true;
            time.textContent = '00:00:00.000';
            stopTime = 0;
        });
    };
</script>
       </script>
    </body>
    </html>
   