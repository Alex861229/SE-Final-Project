<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
<!-- BS JavaScript -->
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<body>
	
	<div class="content">

	    Welcome to Laravel <br><br>

	    @canany(['admin', 'member'])
		
			@can('admin')

		    <!-- 系統管理者 --> 
		    Hi Admin! <br><br>
		    
		    @endcan

		    <a href="{{ url('showInfo/'.$user->id) }}"> 顯示個人資料 </a><br><br>

		    <button data-toggle="modal" data-target="#editInfo">修改資料</button></li><br><br>

            <button data-toggle="modal" data-target="#updatePassword">修改密碼</button></li><br><br>

            @can('member')
            
            <a href="{{ url('message') }}"> 進入留言頁 </a><br><br>

            @endcan

            <a href="{{ url('logout') }}"> 登出 </a>		
		
        @else
            <!-- 訪客 -->
		    <a href="{{ url('login') }}"> 登入 </a> <br><br>

			<a href="{{ url('register') }}"> 註冊 </a>
		@endcanany

	</div>

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

</body>

@canany(['admin', 'member'])
<!-- 修改個人資料 -->
<div class="modal fade" id="editInfo" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- 修改密碼 -->
<div class="modal fade" id="updatePassword" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td>
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">修改密碼</h5>
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
            <form id="activity-form-edit" action="{{ url('updatePassword/'.$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="method" value="PUT">
                <table align="center" id="add_table">
                    <div class = "modal-body-body">   
                        <tr>
                            <td style="padding-right: 50px " >輸入舊密碼</td>
                            <td>
                                <input type="password" name="old_password">
                            </td>  
                        </tr>
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
@endcanany
