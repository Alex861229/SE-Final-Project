@extends('layouts') 
@section('title', '管理員專區') 

@section('css')
<!-- 放css -->
<style type="text/css">
#header-wrapper
    {

        padding: 2em 0em;
    } 
#name
    {
        font-size: 48px;
        color: #ffffff;
    } 
.title2
    {
       font-size: 48px; 
       text-align:center;
    }
    /*設置共有的的樣式佈局，主要是進行代碼優化，提高運行效率*/
    .page-icon a,.page-disabled,.page-next{
        border:1px solid #ccc;
        border-radius:3px;
        padding:4px 10px 5px;
        font-size:14PX;/*修復行內元素之間空隙間隔*/
        margin-right:10px;
    }
    
    /*對 a 標籤進行樣式佈局 */
    .page-icon a{
        text-decoration:none;/*取消鏈接的下劃線*/
        color:#005aa0;
    }
    
    .page-current{
        color:#ff6600;
        padding:4px 10px 5px;
        font-size:14PX;/*修復行內元素之間空隙間隔*/
    }
    
    .page-disabled{
        color:#ccc;
    }
    
    .page-next i,.page-disabled i{
        cursor:pointer;/*設置鼠標經過時的顯示狀態，這裏設置的是顯示狀態爲小手狀態*/
        display:inline-block;/*設置顯示的方式爲行內塊元素*/
        width:5px;
        height:9px;
        background-image:url(http://img.mukewang.com/547fdbc60001bab900880700.gif);/*獲取圖標的背景鏈接*/
    }
    .page-disabled i{
        background-position:-80px -608px;
        margin-right:3px;
    }

    .page-next i{
        background-position:-62px -608px;
        margin-left:3px;
    }
    .comment td{
        padding: 5px;
    }
</style>


@stop
@section('content')
<!-- 主畫面 -->
<div id="header-wrapper">
    <h2 style="color: #ffffff; text-align: center;font-size: 56px ">會員帳號管理</h2>
</div>

<!-- 顯示所有會員留言 -->
<div id="wrapper1" align = "center">
    <br><a href="{{ url('admin/message') }}">顯示所有會員留言</a><br>
</div>
<!-- END -->

<div id="wrapper1">
        <div id="search" style="text-align:center;  padding: 15px "> 
            <form action="{{ url('admin/search/account') }}" method="get">
                <span class="icon"><i class="fa fa-search"></i></span>
                <input type="search" id="search" name="search" placeholder="Search account..." / style="width: 400px; height: 30px; border-radius:15px;"> 
            </form>  
        </div>
</div>

<div id="wrapper2">
    <div id="portfolio" class="container">
        <table class="comment" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px; " align="center" cellpadding="10" border='1'>
            <tr style="background-color: #BEBEBE">
                <td style="width: 20%;">帳號名稱</td>
                <td style="width: 20%;">使用者名稱</td>
                <td style="width: 20%;">email</td>
                <td style="width: 13%;">修改個人資料</td>
                <td style="width: 13%;">重製密碼</td>   
                <td style="width: 13%;"></td>                 
                </td>
            </tr>
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
                    <button type="button" class="edit_button" data-toggle="modal" data-target="{{'#updateInfo'.$user->id}}" id="edit-Info-{{$user->id}}">修改個人資料</button>
                    <div id="{{'resetPassword'.$user->id}}"  class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="resetPasswordLabel" aria-hidden="true">
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
                </td>

                <td>
                    <button type="button" class="edit_button" data-toggle="modal" data-target="{{'#resetPassword'.$user->id}}" id="edit-Info-{{$user->id}}">重製密碼</button>
                    <!-- 修改個人資料 -->
                    <div id="{{'updateInfo'.$user->id}}" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="editInfoLabel" aria-hidden="true">
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
                                                        <input class="add_bar" name='name' value = "{{$user->name}}">
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
        </table>
        <div align="center" id="page" style="font-weight: bold; padding: 20px">
            {{ $users->links() }}
        </div>
    </div>
</div>
<div id="copyright">
    <div id="featured" class="container">
        <div class="box1">
            <h2><span class="icon icon-group"></span>問題回報</h2>
            <p><a href="mailto:-alex1229@g.ncu.edu.tw">如有疑問，請寄信到alex1229@g.ncu.edu.tw,謝謝</p>
        </div>
        <div class="box2">
            <h2><span class="icon icon-briefcase"></span>資料來源</h2>
            <p><a href="https://dataportal.asia/home">亞洲公開資料數據集</a>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td>
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">編輯會員</h5>
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
            <form id="activity-form-edit" enctype="multipart/form-data">
                <table align="center" id="add_table">
                        <div class = "modal-body-body">   
                            <br>        
                            <div style="padding-left: 50px"><h3><b>輸入資訊</b></h3></div>
                            <tr>
                                <td style="padding-right: 50px " required="required">帳號</td>
                                <td>
                                    <input class="add_bar" name='account' required="required">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">密碼</td>
                                <td>
                                    <input class="add_bar" name='password' required="required">
                                </td>  
                            </tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">密碼確認</td>
                                <td>
                                    <input class="add_bar" name='password2' required="required">
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
                                    <input class="add_bar" name='email' required="required">
                                </td>  
                            </tr>
                        </div>    
                </table>
                <table align="center" id="pic_table">
                    <tr>
                        <td>
                            <div class="addpic">上傳個人照片</div>
                                <input type="file" id="progressbarTWInput" name = "picture" accept="image/*" / >
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
@endsection 

@section('js')
<!-- 放js -->


@stop
