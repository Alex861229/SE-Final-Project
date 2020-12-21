<section class="container">
    <form action="{{ url('login') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <font face="monospace" size="5">Account</font>
        <input type="account" name="account"><br><br>
        <font face="monospace" size="5">Password</font>
        <input type="password" name="password"><br><br>
        <input type="submit" value="登入" class="btn btn-primary">
    </form> 

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</section>