@extends('layouts') 
@section('title', '景點評論') 

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
#logo
    {
        font-size: 48px;
        color: #ffffff;
        padding: 2em 0em;
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
    .intro{
        color: #ffffff;
    }
</style>


@stop
@section('content')
<!-- 主畫面 -->
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            中央大學
        </div>    
        <table class="intro" style="border:3px #cccccc solid; text-align:center; " align="center" cellpadding="10" border='1'>
            <tr>
                <td style="width: 10%">地點</td>
                <td width="70%">
                    HTML 網頁設計不可或缺的元素就是表格（Table），通常表格用來做版面的排版，而表格的用法包含了幾個重要的標籤，分別是 table、tr 與 td 這幾個重點，組合起來才是個完整的表格，以下做個簡單的表格範例。                    
                </td>
            </tr>
           <tr>
                <td style="width: 10%">簡介</td>
                <td width="70%">
                    不錯的地方                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">留言數</td>
                <td width="70%">                      
                </td>
            </tr>
            <tr>
                <td style="width: 10%">外部介紹</td>
                <td width="70%">
                    不錯的地方                     
                </td>
            </tr>
        </table>    
    </div>
</div>
<div id="wrapper1">
        <div class="title2">
            <h2 style="color:#000000">歷史留言紀錄</h2>
        </div>
</div>

<div id="wrapper2">
    <div id="portfolio" class="container">
        <table class="comment" style="border:3px #cccccc solid; text-align:center; " align="center" cellpadding="10" border='1'>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">A</td>
                <td width="70%">
                    HTML 網頁設計不可或缺的元素就是表格（Table），通常表格用來做版面的排版，而表格的用法包含了幾個重要的標籤，分別是 table、tr 與 td 這幾個重點，組合起來才是個完整的表格，以下做個簡單的表格範例。                     
                </td>
            </tr>
           <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">B</td>
                <td width="70%">
                    不錯的地方                   
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                   
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                    
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                   
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                      
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                  
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                      
                </td>
            </tr>
            <tr>
                <td style="width: 10%">2020/11/12</td>
                <td style="width: 20%;">中央大學</td>
                <td width="70%">
                    不錯的地方                      
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
@endsection 

@section('js')
<!-- 放js -->


@stop
