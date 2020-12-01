<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
<!-- BS JavaScript -->
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@can('member')
<table class="table content-table" align="center">
    <thead>
        <tr>
            <th scope="col">頭貼</th>
            <th scope="col">姓名</th>
            <th scope="col">帳號</th>
            <th scope="col">信箱</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <img width="30%" src="{{ asset($users->avatar) }}">
            </td>
            <td>
                <span style="color:#4F4F4F;" >{{ $users->name }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $users->account }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $users->email }}</span>
            </td>
        </tr>
    </tbody>
</table>
@endcan

@can('admin')
<table class="table content-table" align="center">
    <thead>
        <tr>
            <th scope="col">姓名</th>
            <th scope="col">帳號</th>
            <th scope="col">信箱</th>
            <th scope="col">修改個人資料</th>
            <th scope="col">重製密碼</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <span style="color:#4F4F4F;" >{{ $user->name }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $user->account }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $user->email }}</span>
            </td>

            <td>
                <form action="{{ url('updateInfo/'.$user->id) }}" method="GET">
                    <button type="button" class="edit_button" data-toggle="modal" data-target="{{'#updateInfo/'.$user->id}}" id="edit-Info-{{$user->id}}">修改個人資料</button> 
                </form>
                <!-- <button data-toggle="modal" data-target="#editInfo">修改個人資料</button> -->
            </td>

            <td>
                <button data-toggle="modal" data-target="#resetPassword">重製密碼</button>
            </td>

            <td>
                <form action="{{ url($user->id.'/deleteAccount') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onClick="return confirm('確定要刪除嗎？');">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endcan

@can('admin')
<!-- 修改個人資料 -->
<div class="modal fade" id="{{'updateInfo/'.$user->id}}" role="dialog" tabindex="-1" role="dialog" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td>
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">修改資料</h5>
                        </td>
                        <td style="width: 500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close1">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        <div class="modal-body">
            <form id="activity-form-edit" action="{{ url('updateInfo/'.$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="method" value="PUT">
                <table align="center" id="add_table">
                    <div class = "modal-body-body">   
                        <tr>
                            <td style="padding-right: 50px " >使用者名稱</td>
                            <td>
                                <input class="add_bar" name='name'>
                            </td>  
                        </tr>
                        <tr>
                            <td style="padding-right: 50px " >信箱</td>
                            <td>
                                <input class="add_bar" name='email'>
                            </td>  
                        </tr>
                        <tr>
                            <td style="padding-right: 50px " >上傳個人照片</td>
                            <td>
                                <input type="file" name="avatar">
                            </td>  
                        </tr>
                    </div>    
                </table>     
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="送出" class="btn btn-primary" >
                </div>                           
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
        </div>
    </div>
</div>
</div>

<!-- 重製密碼 -->
<div class="modal fade" id="resetPassword" role="dialog" tabindex="-1" role="dialog" aria-labelledby="resetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td>
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">重製密碼</h5>
                        </td>
                        <td style="width: 500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close1">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        <div class="modal-body">
            <form id="activity-form-edit" action="{{ url('/resetPassword/'.$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="method" value="PUT">
                <table align="center" id="add_table">
                    <div class = "modal-body-body">   
                        <tr>
                            <td style="padding-right: 50px " >新密碼</td>
                            <td>
                                <input type="password" name="new_password">
                            </td>  
                        </tr>
                        <tr>
                            <td style="padding-right: 50px " >確認新密碼</td>
                            <td>
                                <input type="password" name="check_new_password">
                            </td>  
                        </tr>
                    </div>    
                </table>     
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="送出" class="btn btn-primary" >
                </div>                           
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
        </div>
    </div>
</div>
</div>
@endcan