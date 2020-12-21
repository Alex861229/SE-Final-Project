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
    .comment td{
        padding: 5px;
    }
    .intro td{
        padding: 5px;
        font-size: 18px;
    }    
</style>


@stop
@section('content')
<!-- 主畫面 -->
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            {{ $site->name }}
        </div>    
        <table class="intro" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px; " align="center" cellpadding="10" border='1'>
           <tr>
                <td style="width: 10%">地址</td>
                <td width="70%">
                    <span style="color:#4F4F4F;" >{{ $site->address }}</span>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">描述</td>
                <td width="70%">
                    <span style="color:#4F4F4F;" >{{ $site->description }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">停車資訊</td>
                <td width="70%">
                    <span style="color:#4F4F4F;" >{{ $site->parkinginfo }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">總留言數</td>
                <td width="70%">
                    <span style="color:#4F4F4F;" >{{ $site->total_comments }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">平均評分</td>
                <td width="70%">
                    <span style="color:#4F4F4F;" >{{ $site->avg_rating }}</span>                     
                </td>
            </tr>
        </table>    
    </div>
</div>
<div id="map1">
<div id="SIDE" >
    <div class="map" id="app">
        
        <p>顯示搜尋結果地圖</p>
        <!-- 顯示搜尋結果地圖 -->
        <gmap-map 
        ref="mapRef"
        :center="mapCenter"
        :zoom="10"
        style="width: 100%; height:440px;"
        >
            <gmap-info-window
                :options="infoWindowOptions"
                :position="infoWindowPosition"
                :opened="infoWindowOpened"
                @closeclick="handleInfoWindowClose"
            >
                <div class="info-window">
                    <h2 v-text="activeRestaurent.latitude"></h2>
                    <h2 v-text="activeRestaurent.longitude"></h2>
                    <h2 v-text="activeRestaurent.name"></h2>
                    <p v-text="activeRestaurent.address"></p>
                </div>
            </gmap-info-window>
            <gmap-marker
            v-for="(r, index) in restaurents"
            :key="r.id"
            :position="getPosition(r)"
            :clickable="true"
            :draggable="false"
            @click="handleMarkerClicked(r);handleNearby(r)"
            >                        
            </gmap-marker>                   
        </gmap-map>
        
    </div>
    <!-- Google API -->
        <script src="{{ mix('js/app.js') }}"></script>
    
</div>
</div>


<div id="wrapper2">
    <div class="title2" style="padding: 3px; margin: 3px">
            <h2 style="color:#000000">留言評分</h2>
        </div>
    <div id="portfolio" class="container">
        <table class="comment" style="border:3px #cccccc solid; text-align:center; " align="center" cellpadding="10" border='1'>
            <thead>
            <tr style="background-color: #BEBEBE">
                <td style="width: 10%">留言者</td>
                <td style="width: 60%;">內容</td>
                <td style="width: 10%">評分</td>
                <td style="width: 20%;">時間</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($messages as $message)
            <tr>
                <td style="width: 10%">{{ $message->user->name }}</td>
                <td style="width: 60%;">{{ $message->rating }}</td>
                <td style="width: 10%;">{{ $message->content }}</td>
                <td style="width: 20%;">{{ $message->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        @can('member')
        <div class="m_add" style="padding: 5px">
            <button type="button" class="register" data-toggle="modal" data-target="#addModal" style="background: #ff6816; border-radius: 5px;color: white;">新增留言</button>
        </div> 
        @endcan   
        <div align="center" id="page" style="font-weight: bold; padding: 20px">
            
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
            <form action="{{ url('search/'.$country.'/'.$site->id.'/message') }}" method="POST">
                {{ csrf_field() }}
                <table align="center" id="add_table">
                        <div class = "modal-body-body">   
                            <br>        
                            <tr>
                                <td style="padding-right: 50px " required="required">評論</td>
                                <td>
                                    <textarea class="add_word" name='content'></textarea> 
                                </td>  
                            </tr>
                            <tr>
                            <tr>
                                <td style="padding-right: 50px " required="required">評分</td>
                                <td>
                                    <input type="radio" name="rating" value="1">1<br>
                                    <input type="radio" name="rating" value="2">2<br>
                                    <input type="radio" name="rating" value="3">3<br>
                                    <input type="radio" name="rating" value="4">4<br>
                                    <input type="radio" name="rating" value="5">5<br>
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

<div id="copyright">
    <div id="featured" class="container">
        <div class="box1">
            <h2><span class="icon icon-group"></span>問題回報</h2>
            <p><a href="mailto:-alex1229@g.ncu.edu.tw">如有疑問，請寄信到alex1229@g.ncu.edu.tw,謝謝</p>
        </div>
        <div class="box2">
            <h2><span class="icon icon-briefcase"></span>資料來源</h2>
            <p><a href="https://dataportal.asia/home">亞洲公開資料數據集</a></p>
        </div>
    </div>
</div>
@endsection 

@section('js')
<!-- 放js -->


@stop
