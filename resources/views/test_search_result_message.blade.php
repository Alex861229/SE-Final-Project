<body>
    <h1>景點</h1>

    <table class="table content-table" align="center">
        <thead>
            <tr>
                <th scope="col">景點名稱</th>
                <th scope="col">地址</th>
                <th scope="col">描述</th>
                <th scope="col">停車資訊</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span style="color:#4F4F4F;" >{{ $site->name }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $site->address }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $site->description }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $site->parkinginfo }}</span>
                </td>
            </tr>
        </tbody>
    </table>

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
            @foreach ($messages as $message)
            <tr>
                <td>
                    <span style="color:#4F4F4F;" >{{ $message->user->name }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $message->content }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $message->rating }}</span>
                </td>

                <td>
                    <span style="color:#4F4F4F;" >{{ $message->created_at }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table><br><br><br><br><br><br><br><br><br><br>

    @can('member')
    <h1>新增留言</h1>
    <div>
        <!-- 送出留言 -->
        <form action="{{ url('search/{country}/{site_id}/message') }}" method="POST">
            {{ csrf_field() }} <!--用來識別是認證用戶發出的request，避免惡意(CSRF) attacks. Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user.-->
            留言標題：<input type="text" name="title"><br><br>
            留言內容：<input type="text" name="content"><br><br>
            留言評分：<input type="text" name="rating"><br><br>
            <button type="submit">留言</button>
        </form>
    </div>
    @endcan
</body>
