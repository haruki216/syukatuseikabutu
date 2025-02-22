<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <style>
    
    ul.gnav-navi-1{
    background:skyblue;
    /*padding: 0;*/
    text-align: center;
    /*   position: fixed;*/
    /*   width: 100%;*/
    /*   top:0;*/
       z-index:500;
        height:100px;
        
        }
        ul.gnav-navi-1 li{
        display: inline-block;
        
        }
        
        
        ul.gnav-navi-1 li a{
        display: block;
        padding: 1em;
        color: black;
        text-decoration: none;
        }
        ul.gnav-navi-1 a::first-line{
        font-size: 20px;
        font-weight: bold;
        }
        .watch{
             height: 10rem;
          text-align: center;
        }
               
        h1 {margin: 30px 10px;}
        h2 {margin: 30px 10px;}
        form {display: flex; align-items: flex-end; margin: 0 0 20px 10px}
        textarea {margin-right: 10px; padding: 5px 10px; width: 200px; height: 100px;}
        button {padding: 5px 10px;height: 30px;}
        p {margin: 5px 0 0 10px;}
    </style>
</head>
<body>
    
         <nav>
        <ul class="gnav-navi-1">
        <li><a href="/">記録</a></li>
        <li><a href="/timer">タイマー</a></li>
        <li><a href="/calories">体重記録</a></li>
        
        <li><a href="/gemini">AI</a></li>
        </ul>
    </nav>
    
    <!--<h1>{{config('app.name')}}</h1>-->
    
    <form action="{{route('entry')}}" method="post">
        @csrf
        <textarea name="toGeminiText" autofocus>@isset($result['task']){{$result['task']}}@endisset </textarea>
        <button type="submit">send</button>
    </form>
   
   
    <hr>

    @isset($result)
    <p>{!!$result['content']!!}</p>
    @endisset
    
    
    
<!--   <form method="POST" action="{{ route('push') }}" enctype="multipart/form-data">-->
<!--    @csrf-->
<!--    <input type="file" name="image">-->
<!--    <textarea name="text"></textarea>-->
<!--    <button type="submit">送信</button>-->
<!--</form>-->
<!--     @isset($result1)-->
<!--    <p>{!!$result1['content']!!}</p>-->
<!--    @endisset-->
    
    
</body>
</html>