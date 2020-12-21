<body>

    <h1>留言</h1>

    <table class="table content-table" align="left">
        <thead>
            <tr>
                <th scope="col">留言者</th>
                <th scope="col">內容</th>
                <th scope="col">評分</th>
                <th scope="col">時間</th>
            </tr>
        </thead>

        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->site_id }}</td>
                <td>{{ $message->content }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
        
        {{ $messages->links() }}
        
    </table><br>
</body>

