<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>123</title>
    </head>
    <body>
    <!-- 從資料庫撈每筆留言回來 -->
    <div>Title: {{ $message -> title }}</div>
    <div>Content: {{ $message -> content }}</div>
    <div>Rating: {{ $message -> rating }}</div>
    <div>Created_at: {{ $message -> created_at }}</div>
    <div>Updated_at: {{ $message -> updated_at }}</div>
    </body>
</html>
