<body>
	
	<div class="content">

	    Welcome to Laravel <br><br>

		@can('admin')
		    <!-- 系統管理者 --> 
		    Hi Admin! <br>
		    <a href="{{ url('logout') }}"> 登出 </a>
		@elsecan('user')
		    <!-- 會員 -->
		    <a href="{{ url('logout') }}"> 登出 </a>
		@else
		    <!-- 訪客 -->
		    <a href="{{ url('login') }}"> 登入 </a> <br><br>

			<a href="{{ url('register') }}"> 註冊 </a>
		@endcan

	</div>

</body>

