<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <title>post</title>
    </head>
    <body>
       <h1 class="title">
           {{$post->title}}
       </h1>
       <div class="content">
           <div class="content_post">
               <h3>本文</h3>
                <img src="{{ Storage::url($post->image)}}" width="100px">
               <p>{{$post->cotent}}</p>
           </div>
       </div>
       
       <div class="footer">
           <a href="/post">戻る</a>
       </div>
    </body>
</html>