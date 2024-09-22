<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <title>post</title>
    </head>
    <body>
         <form action="/posts"  method="POST" enctype="multipart/form-data" >
            @csrf
       <h1 class="title">
          <h2>title</h2>
          <input type='text' name="content[title]" placeholder="タイトル">
       </h1>
       <div class="content">
             <h3>本文</h3>
             <textarea name="content" placeholder="今日も1日お疲れさまでした。"></textarea>
               
           </div>
           <input id="post-image" type="file" name="image">
           
           <input type="submit" value="store"/>
       </form>
       
       <div class="footer">
           <a href="/post">戻る</a>
       </div>
    </body>
</html>