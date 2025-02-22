
<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet"  href="/index.css">
 </head>
 <body>
    <nav>
        <ul class="gnav-navi-1">
        <li><a href="/calender">記録</a></li>
        <li><a href="/timer">タイマー</a></li>
        <li><a href="/calories">体重記録</a></li>
        <li><a href="/post">チャット</a></li>
         <li><a href="/gemini">AI</a></li>
        </ul>
    </nav>

   
@extends('layouts.app1')

@section('content')
   <div class="container">
        <h1>カレンダー</h1>
        <div>
            <a href="{{ route('records.index', ['ym' => $prev]) }}">&lt;</a>
            <span>{{ $html_title }}</span>
            <a href="{{ route('records.index', ['ym' => $next]) }}">&gt;</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeks as $week)
                    <tr>{!! $week !!}</tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


<div class="container">
    <h2>運動データ（{{ $html_title }}）</h2>
    <canvas id="exerciseChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let ctx = document.getElementById('exerciseChart').getContext('2d');
    let exerciseChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });

    function fetchData(month) {
        fetch(`/records/graph-data?month=${month}`)
            .then(response => response.json())
            .then(data => {
                exerciseChart.destroy();
                exerciseChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: data.datasets
                    },
                    options: { scales: { y: { beginAtZero: true } } }
                });
            })
            .catch(error => console.error("データ取得エラー:", error));
    }

    let currentMonth = "{{ $ym }}";
    fetchData(currentMonth);

    document.querySelectorAll("a[href*='records.index']").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            let url = new URL(this.href);
            let newMonth = url.searchParams.get("ym");

            if (newMonth && newMonth !== currentMonth) {
                currentMonth = newMonth;
                fetchData(currentMonth);
            }
        });
    });
});


</script>
   
    </body>
</html>
