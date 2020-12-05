<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>123</title>
    </head>
    <body>
    <a>台灣景點留言</a>
    <!-- 從資料庫撈每筆留言回來 -->
        @foreach ($TwMessages as $TwMessage)
        <a><div>名稱：{{ $TwMessage->user->name }}<br>景點名稱：{{ $TwMessage->site->name }}<br>留言內容：{{ $TwMessage->content }}<br>留言內容：{{ $TwMessage->rating }}</div></a>
            <!-- 修改留言 -->
            <form action="{{ url('message/tw', ['msg_id' => $TwMessage->id], '/edit') }}" method="GET">
                <button type="submit" id="edit-message-{{ $TwMessage->id }}">Edit</button>
            </form>
                            
            <!-- 刪除留言 -->
            <form action="{{ url('message/tw', ['msg_id' => $TwMessage->id] )}}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" id="delete-message-{{ $TwMessage->id }}">Delete</button>
            </form>
        @endforeach
    
    <a>韓國景點留言</a>
    <!-- 從資料庫撈每筆留言回來 -->
        @foreach ($KrMessages as $KrMessage)
        <a><div>名稱：{{ $KrMessage->user->name }}<br>留言內容：{{ $KrMessage->content }}<br>留言內容：{{ $KrMessage->rating }}</div></a>
            <!-- 修改留言 -->
            <form action="{{ url('message/kr', ['msg_id' => $KrMessage->id], '/edit') }}" method="GET">
            <button type="submit" id="edit-message-{{ $KrMessage->id }}">Edit</button>
            </form>
            
            <!-- 刪除留言 -->
            <form action="{{ url('message/kr', ['msg_id' => $KrMessage->id] )}}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" id="delete-message-{{ $KrMessage->id }}">Delete</button>
            </form>            
        @endforeach
    </body>
</html>
