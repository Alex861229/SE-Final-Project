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
            <img src="{{ asset('css/images/logo.jpg') }}" width="200px" height="200px">
        </div>    
        <div id="name_edit" style="text-align:center; "> 
            <li class="uname" value="Alex" style="list-style-type: none; ">Alex</li>
            <li class="edt_bt" style="list-style-type: none; "><button type="button" class="editf" data-toggle="modal" data-target="#editfModal" >編輯</button></li>  
        </div>
    </div>
</div>
<div id="wrapper1">
        <div class="title2" style="padding: 3px; margin: 3px">
            <h2 style="color:#000000;" >歷史留言紀錄</h2>
        </div>
</div>

<div id="wrapper2">
    <div id="portfolio" class="container" style="padding: 5px">
        <table class="comment" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px; " align="center" cellpadding="10" border='1'>
            <tr style="background-color: #BEBEBE">
                <td style="width: 10%">日期</td>
                <td style="width: 20%;">景點</td>
                <td width="70%">
                    評論                      
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    HTML 網頁設計不可或缺的元素就是表格（Table），通常表格用來做版面的排版，而表格的用法包含了幾個重要的標籤，分別是 table、tr 與 td 這幾個重點，組合起來才是個完整的表格，以下做個簡單的表格範例。
                    <br>
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
           <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方
                    <button type="button" class="edit_button">編輯</button>
                    <button type="button" class="delete_button">刪除</button>                       
                </td>
            </tr>     
        </table>
        <div align="center" id="page" style="font-weight: bold; padding: 20px">
             <div class="page-icon">
    <span class="page-disabled"><i></i>上一頁</span>
    <span class="page-current">1</span>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">7</a>
    ……
    <a href="#">199</a>
    <a href="#">200</a>
    <a class="page-next" href="#">下一頁<i></i></a>
</div>
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
<div class="modal fade" id="editfModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="editfModalLabel" aria-hidden="true">
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
