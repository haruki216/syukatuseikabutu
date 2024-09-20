<!DOCTYPE html>
<htnl>
    <head>
      
         <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight Tracker</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <link rel="stylesheet"  href="/calories.css">
    </head>
    <body>
         <nav>
        <ul class="gnav-navi-1">
        <li><a href="/">記録</a></li>
        <li><a href="/timer">タイマー</a></li>
        <li><a href="/calories">体重記録</a></li>
        <li><a href="/post">チャット</a></li>
        </ul>
    </nav>
    <div class='a'>
        <div class='b'>
         <form class="calories_form">
        <dl>
            <dt>体重（kg）：</dt>  
            <dd><input type="number" class="box" id="weight" name="weight"></dd>
            <dt>身長（cm）：</dt>
            <dd><input type="number" class="box" id="height" name="height"></dd>
            <dt>年齢（歳）：</dt>
            <dd><input type="number" class="box" id="age" name="age"></dd>
            <dt>性別：</dt>
            <dd>
                <select name="gender" id="gender">
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>
            </dd>
        </dl>
        <p><input type="button" class="calc-btn" value="計算" onclick="calcBMR()"></p>
        <dt>基礎代謝（kcal）：</dt>
        <dd><input id="energy" class="box" type="text" readonly></dd>
    </form>
    </div>
   
    <div class='c'>
     <form class="calories_consumed_form">
        <dl>
            <dt>Mets：</dt>  
            <dd><input type="number" class="box" id="mets" name="mets"></dd>
            <a href="https://tsurukamekai.jp/user/media/shinjuku_tsurukame/page/blog/index/20200811_007.png">mets表</a>
            <dt>時間（ｈ）：</dt>
            <dd><input type="number" class="box" id="time" name="time"></dd>
            <dt>体重（kg）：</dt>
            <dd><input type="number" class="box" id="weight" name="weight"></dd>
            
        </dl>
        <p><input type="button" class="calc-btn" value="計算" onclick="calc(mets.value,time.value,weight.value);"></p>
        <dt>消費カロリー（kcal）：</dt>
        <dd><input id="calorie" class="box" type="text" readonly=''></dd>
    </form>
    </div>
    
    </div>
    
     <script>
        function calcBMR() {
            const weight = parseFloat(document.getElementById('weight').value);
            const height = parseFloat(document.getElementById('height').value);
            const age = parseFloat(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            const energy = document.getElementById('energy');

            let bmr;
            if (gender == "1") { // 男性
                bmr = Math.round((weight * 13.75) + (height * 5.0) + 66.75 - (age * 6.759));
            } else if (gender == "2") { // 女性
                bmr = Math.round((weight * 9.56) + (height * 1.85) + 665.1 - (age * 4.68));
            }

            energy.value = bmr;
        }
    </script>
    
    <script>
        function calc(mets,time,weight){
            const calorie_value= document.getElementById('calorie').value= Math.round(
            (mets -1)　* time * weight *　1.05);
            
        }
        
        
    </script>
    
    
     <form action="/calories" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">日付:</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="weight">体重 (kg):</label>
                <input type="number" step="0.1" name="weight" id="weight" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Weight</button>
        </form>
        
        
         <canvas id="people_weight_chart" width="500" height="500"></canvas>
         <script>
           window.onload = function () {
        let context = document.querySelector("#people_weight_chart").getContext('2d')
        new Chart(context, {
          type: 'line',
          data: {
            labels:  {!! json_encode($weights->pluck('date')) !!},
            datasets: [{
              label: "体重記録",
              data:  {!! json_encode($weights->pluck('weight')) !!},
               backgroundColor: ['#4169e1']
            }],
          },
          options: {
            responsive: false
          }
        })
      }
            </script>
        
       
            
</body>
</html>

            
           
        
  
      
    </body>
</htnl>