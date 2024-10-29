<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
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
        /* 投稿一覧全体のコンテナ */
        .posts {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* 自動で列を調整 */
            gap: 20px; /* 各投稿間のスペース */
            padding: 20px;
        }

        /* 各投稿のスタイル */
        .post {
            background-color: white;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* カード風の影 */
            padding: 20px;
            transition: transform 0.3s ease; /* ホバー時のエフェクト */
        }

        /* 投稿ホバー時のエフェクト */
        .post:hover {
            transform: scale(1.05); /* 拡大 */
        }

        /* 投稿画像のスタイル */
        .example1 {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        /* タイトルのスタイル */
        .title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
        }

        /* 投稿内容のリンク部分 */
        .body a {
            color: #555;
            text-decoration: none;
        }

        .body a:hover {
            text-decoration: underline;
        }

        /* 投稿者名 */
        smal {
            display: block;
            margin-top: 15px;
            font-size: 0.8em;
            color: #999;
        }

        /* 検索フォームと投稿作成リンクのスタイル */
        .search, .create {
            margin-bottom: 20px;
        }

        .create a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .create a:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>
     <nav>
            <ul class="gnav-navi-1">
                <li><a href="/">記録</a></li>
                <li><a href="/timer">タイマー</a></li>
                <li><a href="/calories">体重記録</a></li>
                <li><a href="/post">チャット</a></li>
                 <li><a href="/gemini">AI</a></li>
            </ul>
        </nav>
    
    <div class="search">
        <form action="/post/posts/search" method="GET">
            @csrf
            <input type="text" name="keyword" size="60">
            <input type="submit" value="検索" size="60">
        </form>
    </div>

    <div class="create">
        <a href='/post/posts/create'>create</a>
    </div>

    <div class="posts">
        @foreach ($posts as $post) 
            <div class="post">
                 <img src="{{ Storage::url($post->image)}}" class="example1">

                <h2 class="title">{{ $post->title }}</h2>
                <p class="body">
                    <a href="/post/posts/{{$post->id}}">{{ $post->content }}</a>
                </p>
                <smal>投稿者: {{ $post->user->name }}</smal>
                <form action="/post/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                </form>
            </div>
        @endforeach
    </div>

    <script>
        function deletePost(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>
</html>