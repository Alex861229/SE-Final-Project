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
    <h2 style="color: #ffffff; text-align: center;font-size: 56px ">會員留言管理</h2>
</div>

<!-- 顯示所有會員留言 -->
<div id="wrapper1" align = "center">
    <br><a href="{{ url('admin') }}">顯示所有會員資料</a><br>
</div>
<div id="wrapper1">
        <div id="search" style="text-align:center;  padding: 15px;padding-right: 200px;padding-left: 200px "> 
            <form action="{{ url('admin/message/'.$country.'/search') }}" method="get">
                <table align="center" style="padding: 25px">
                    <tr>
                        <td style="padding-bottom: 15px">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="search" id="search" name="search" placeholder="Search Content..." / style="width: 400px; height: 30px; border-radius:15px; pa">
                        </td>
                    </tr>    
            </form>  
        </div>
</div>

<div id="wrapper2">

    <div id="portfolio" class="container">
        <!-- Cheng 留言分頁 -->
    <table class="comment" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px;" align="center" cellpadding="10" border='1'>
        <tr>
        <div class="tab-head" style="font-family: 微軟正黑體; padding-top: 20px;">
          <ul class="nav nav-tabs welcome-tab-ul">
            <li class="{{ Request::is('admin/message/tw') ? 'active' : '' }}"><a href="{{ url('admin/message/tw') }}"><b>台灣</b></a></li>
            <li class="{{ Request::is('admin/message/kr') ? 'active' : '' }}"><a href="{{ url('admin/message/kr') }}"><b>韓國</b></a></li>
          </ul>
        </div>
        </tr>  
                <tr style="background-color: #BEBEBE">
                    <td style="width: 20%">景點</td>
                    <td style="width: 5%;">評分</td>
                    <td width="35%">
                        評論                      
                    </td>
                    <td style="width: 10%;">評論日期</td>
                    <td style="width: 10%">修改日期</td>
                    <td style="width: 10%"></td>
                </tr>
                @foreach ($messages as $message)    
                <tr>
                    <td style="width: 20%">{{ $message -> site -> name }}</td>
                    <td style="width: 5%;">{{ $message -> rating }}</td>
                    <td width="35%">
                        {{ $message -> content }}
                        <br>
                    </td>    
                    <td style="width: 10%;">{{ $message -> created_at }}</td>
                    <td style="width: 10%;">{{ $message -> updated_at }}</td>
                    <td style="width: 10%">
                        <button type="button" class="edit_button" data-toggle="modal" data-target="{{'#addModal'.$message->id}}" id="edit-Info-{{$message->id}}">編輯</button>
                        <div class="modal fade" id="{{'addModal'.$message->id}}" role="dialog" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <!-- 編輯Modal content-->
                                <div class="modal-content">                                                    
                                    <div class="modal-header">
                                        <table>
                                            <tr>
                                                <td style="text-align: center">
                                                    <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px; font-size: 24px" >編輯留言</h5>
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
                                @if ($country == 'tw')
                                    <form method="POST" action="{{ url('message/tw/'.$message->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <table align="center" id="add_table">
                                        <div class = "modal-body-body">   
                                        <br>        
                                            <tr>
                                                <td style="padding-right: 50px " required="required">評論</td>
                                                <td>
                                                    <textarea class="add_word" name='content'>{{ $message->content }}</textarea> 
                                                </td>  
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td style="padding-right: 50px " required="required">評分</td>
                                                <td>
                                                    <input type="radio" name="rating" value="1" {{ $message->rating=="1" ? "checked" : " " }}>1<br>
                                                    <input type="radio" name="rating" value="2" {{ $message->rating=="2" ? "checked" : " " }}>2<br>
                                                    <input type="radio" name="rating" value="3" {{ $message->rating=="3" ? "checked" : " " }}>3<br>
                                                    <input type="radio" name="rating" value="4" {{ $message->rating=="4" ? "checked" : " " }}>4<br>
                                                    <input type="radio" name="rating" value="5" {{ $message->rating=="5" ? "checked" : " " }}>5<br>
                                                </td>
                                            </tr>
                                        </div>    
                                    </table>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" value="送出" class="btn btn-primary" >
                                    </div>
                                    </form>
                                @endif
                                @if ($country == 'kr')
                                    <form method="POST" action="{{ url('message/kr/'.$message->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <table align="center" id="add_table">
                                        <div class = "modal-body-body">   
                                        <br>        
                                            <tr>
                                                <td style="padding-right: 50px " required="required">評論</td>
                                                <td>
                                                    <textarea class="add_word" name='content'>{{ $message->content }}</textarea> 
                                                </td>  
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td style="padding-right: 50px " required="required">評分</td>
                                                <td>
                                                    <input type="radio" name="rating" value="1" {{ $message->rating=="1" ? "checked" : " " }}>1<br>
                                                    <input type="radio" name="rating" value="2" {{ $message->rating=="2" ? "checked" : " " }}>2<br>
                                                    <input type="radio" name="rating" value="3" {{ $message->rating=="3" ? "checked" : " " }}>3<br>
                                                    <input type="radio" name="rating" value="4" {{ $message->rating=="4" ? "checked" : " " }}>4<br>
                                                    <input type="radio" name="rating" value="5" {{ $message->rating=="5" ? "checked" : " " }}>5<br>
                                                </td>
                                            </tr>
                                        </div>    
                                    </table>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" value="送出" class="btn btn-primary" >
                                        </div>
                                    </form>
                                @endif
                            </div>
                            </div>
                        </div>
                        </div>
                    @if ($country == 'tw') 
                    <form action="{{ url('message/tw/'.$message->id) }}" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
                        <button type="submit" id="delete-message-{{ $message->id }}">刪除</button>
                    </form>
                    @endif
                    @if ($country == 'kr')
                    <form action="{{ url('message/kr/'.$message->id)}}" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
                        <button type="submit" id="delete-message-{{ $message->id }}">刪除</button>
                    </form> 
                    @endif                      
                    </td>  
                </tr>
                @endforeach
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
@endsection 

@section('js')
<!-- 放js -->


@stop
