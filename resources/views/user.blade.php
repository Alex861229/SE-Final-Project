@extends('layouts') 
@section('title', '使用者專區') 

@section('css')
<!-- 放css -->
<style type="text/css">
#header-wrapper
    {

        padding: 2em 0em;
    } 
.uname
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
    <div id="header" class="container">
        <div id="logo">
            <img src="{{ asset($user->avatar) }}" width="200px" height="200px">
        </div>    
        <div id="name_edit" style="text-align:center; ">    
            <li class="uname" value="name" style="list-style-type: none; ">{{ $user->name }}</li> 
            <table align="center">
                <tr >
                    <td>        
                        <li class="edt_bt" style="list-style-type: none; "><button type="button" class="editf" data-toggle="modal" data-target="#editInfo" >編輯資料</button></li>
                    </td>
                    <td>        
                        <li class="edt_bt" style="list-style-type: none; "><button type="button" class="editf" data-toggle="modal" data-target="#updatePassword" >編輯密碼</button></li>
                    </td>
                    <td>    
                        @can('admin')
                        <li class="adm_bt" style="list-style-type: none; "><button type="button" onclick="location.href='{{ url('admin/'.$user->id) }}'" >管理員頁面</button></li>
                        @endcan
                    </td>
                </tr>
            </table>             
        </div>
    </div>
</div>
<div id="wrapper1">
        <div class="title2" style="padding: 3px; margin: 3px">
            <h2 style="color:#000000;" >歷史留言紀錄</h2>
        </div>
</div>
<!-- Cheng 留言分頁 -->
<div class="tab-head" style="font-family: 微軟正黑體; padding-top: 20px;">
  <ul class="nav nav-tabs welcome-tab-ul">
    <li class="{{ Request::is('user/tw') ? 'active' : '' }}"><a href="{{ url('/user/tw') }}"><b>台灣</b></a></li>
    <li class="{{ Request::is('user/kr') ? 'active' : '' }}"><a href="{{ url('/user/kr') }}"><b>韓國</b></a></li>
  </ul>
</div>

<div id="wrapper2">
    <div id="portfolio" class="container" style="padding: 5px">
        <table class="comment" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px; " align="center" cellpadding="10" border='1'>
            <thead>
                <tr style="background-color: #BEBEBE">
                    <td style="width: 20%">標題</td>
                    <td style="width: 10%;">評分</td>
                    <td width="40%">
                        評論                      
                    </td>
                    <td style="width: 10%;">評論日期</td>
                    <td style="width: 10%">修改日期</td>
                    <td style="width: 10%"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)    
                <tr>
                    <td style="width: 10%">{{ $message -> title }}</td>
                    <td style="width: 20%;">{{ $message -> content }}</td>
                    <td width="50%">
                        {{ $message -> rating }}
                        <br>
                    </td>    
                    <td style="width: 10%;">{{ $message -> created_at }}</td>
                    <td style="width: 10%;">{{ $message -> updated_at }}</td>
                    <td style="width: 10%">
                        <button type="button" class="add" data-toggle="modal" data-target="#addModal">編輯</button>
                        <button type="button" class="delete_button">刪除</button>                       
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center" id="page" style="font-weight: bold; padding: 20px">
            {{ $messages->links() }}
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

<div class="modal fade" id="addModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- 編輯Modal content-->
        <div class="modal-content">                                                    
            <div class="modal-header">
                <table>
                    <tr>
                        <td style="text-align: center">
                            <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px; font-size: 24px" >新增留言</h5>
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
                            <tr>
                                <td style="padding-right: 50px " required="required">評論</td>
                                <td>
                                    <textarea class="add_word" name='introduce' id="introduce-edit"></textarea> 
                                </td>  
                            </tr>
                            <tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">評分</td>
                                <td>
                                    <input type="radio" name="class" >1<br>
                                    <input type="radio" name="class" >2<br>
                                    <input type="radio" name="class" >3<br>
                                    <input type="radio" name="class" >4<br>
                                    <input type="radio" name="class" >5<br>
                                </td>
                            </tr>
                        </div>    
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
