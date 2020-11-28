
<section class="container">
    <form action="{{ url('register') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <font face="monospace" size="5">Name</font>
        <input type="name" name="name"><br><br>
        <font face="monospace" size="5">Avatar</font>
        <input type="file" name="avatar"><br><br>
        <font face="monospace" size="5">Email</font>
        <input type="email" name="email"><br><br>
        <font face="monospace" size="5">Account</font>
        <input type="account" name="account"><br><br>
        <font face="monospace" size="5">Password</font>
        <input type="password" name="password"><br><br>
        <font face="monospace" size="5">Confirm Password</font>
        <input type="password" name="password_confirmation"><br><br>
        <input type="submit" value="註冊" class="btn btn-primary">
    </form> 

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>上傳失敗！</strong>檔案出現以下問題：
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</section>