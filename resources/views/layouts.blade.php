<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<div class="bootstrap-iso">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="{{asset('css/default.css')}}" rel="stylesheet">
<link href="{{asset('css/fonts.css')}}" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>

<!-- Test -->
<script src=//code.jquery.com/jquery-3.5.1.slim.min.js integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin=anonymous></script>
<!-- Test End -->

<!-- BS JavaScript -->
 <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- font-awesome -->
<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css" />
<style type="text/css">

</style>
    @yield('css')
</head>
<body style="font-family: 'Source Sans Pro', sans-serif;font-size: 12pt;font-weight: 400;background-color: #333333;">    
<div id="main-wrapper">
<!-- Page Preloader -->
<div class="row" style="margin-left: 5px; margin-right: 5px">
<div id="menu" style="position: relative; text-align: right; margin: 3px;padding: 0;">
        <ul style="display: block;list-style-type: disc;">
            <li style="float:left;" ><img class="l_img" src="{{ asset('css/images/logo.jpg') }}"  style="  width: 48px; height: 48px; float:left; margin-top: 5px" ></a></li>
            <li style="float:left;  height: 48px; line-height: 48px; color: #ffffff" >台韓景點地圖</a></li>
            <li class="current_page_item"><a href="/" title="">主頁</a></li>
            @canany(['admin', 'member'])
            <li class="mem_bt"><button type="button" class="register" onclick="location.href='{{ url('/user') }}'">個人資料</button></li>
            <li class="logout_bt" style="margin-right: 5px"><button type="button" onclick="location.href='{{ url('logout') }}'"> 登出 </button></li>
            @else
            <li class="reg_bt"><button type="button" class="register" data-toggle="modal" data-target="#myModal">註冊</button></li>
            <li class="login_bt" style="margin-right: 5px"><button type="button" class="login" data-toggle="modal" data-target="#loginModal">登入</button></li>
            @endcanany
        </ul>
</div>
</div>
<div class="modal fade" id="myModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td>
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">註冊帳號</h5>
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
            <form id="activity-form-edit" action="{{ url('register') }}" method="post" enctype="multipart/form-data" name="new">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table align="center" id="add_table">
                        <div class = "modal-body-body">   
                            <br>        
                            <div style="padding-left: 50px"><h3><b>輸入資訊</b></h3></div>
                            <tr>
                                <td style="padding-right: 50px " required="required">帳號</td>
                                <td>
                                    <input type="account" class="add_bar" name='account' required="required">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">密碼</td>
                                <td>
                                    <input type="password" class="add_bar" name='password' required="required">
                                </td>  
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">密碼確認</td>
                                <td>
                                    <input type="password" class="add_bar" name='password_confirmation' required="required">
                                </td>  
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">使用者名稱</td>
                                <td>
                                    <input class="add_bar" name='name' required="required">
                                </td>  
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">信箱</td>
                                <td>
                                    <input type="email" class="add_bar" name='email' required="required">
                                </td>  
                            </tr>
                        </div>    
                </table>
                <table align="center" id="pic_table">
                    <tr>
                        <td>
                            <div class="addpic">上傳個人照片</div>
                                <input type="file" id="progressbarTWInput" name = "avatar" accept="image/*" / >
                        </td>    
                    </tr>
                </table>  
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" value="送出" class="btn btn-primary" >
        </div>                                        
        </form>
    </div>
    </div>
</div>
</div>


<div class="modal fade" id="loginModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td style="text-align: center">
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px; font-size: 24px" >Login</h5>
                        </td>
                        <td style="width: 500px">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close1">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger" id="errordiv">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
        <div class="modal-body">
            <form action="{{ url('login') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table align="center" id="add_table">
                        <div class = "modal-body-body">   
                            <br>        
                            <tr>
                                <td style="padding-right: 50px " required="required">帳號</td>
                                <td>
                                    <input type="account" name="account"> 
                                </td>  
                            </tr>
                            <tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">密碼</td>
                                <td>
                                    <input type="password" name="password">
                                </td>
                            </tr>
                        </div>    
                </table>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" value="登入" class="btn btn-primary" >
        </div>                                        
        </form>
        </div>
        </div>
    </div>
</div>


</div>
</div>
        @yield('content')
<!-- .uc-mobile-menu -->
</div>
<!-- .uc-mobile-menu -->                



<!-- Script -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
