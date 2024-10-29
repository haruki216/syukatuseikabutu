
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
   
    </body>
</html>
