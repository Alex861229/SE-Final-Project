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
    @foreach ($messages as $message)
    <a href="{{ url('message/'.$message->id) }}"><div>名稱：{{ $message->user->name }}<br>留言標題：{{ $message->title }}</div></a>
        <!-- 有權限才能修改留言或刪除留言 -->
        @if (Auth::user()->id==$message->user_id)
            <!-- 修改留言 -->
            <form action="{{ url('message/'.$message->id.'/edit') }}" method="GET">
                <button type="submit" id="edit-message-{{ $message->id }}">Edit</button>
            </form>
            <!-- 刪除留言 -->
            <form action="{{ url('message/'.$message->id) }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" id="delete-message-{{ $message->id }}">Delete</button>
            </form>
        @endif
    @endforeach
    <!-- 送出留言 -->
    <form action="{{ url('message') }}" method="POST">
        {{ csrf_field() }} <!--用來識別是認證用戶發出的request，避免惡意(CSRF) attacks. Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user.-->
        留言標題：<input type="text" name="title"><br><br>
        留言內容：<input type="text" name="content"><br><br>
        留言評分：<input type="text" name="rating"><br><br>
        <button type="submit">留言</button>
    </form>
    </body>
</html>
