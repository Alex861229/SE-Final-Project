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
<style>
    #map{
        width: 100%;
        height: 440px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtM3X8domwSOC9JQBfy1NoP02mUy6RnHQ&libraries=places"
  type="text/javascript"></script>


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
                    <span style="color:#ffffff;" >{{ $site->address }}</span>                       
                </td>
            </tr>
            <tr>
                <td style="width: 10%">描述</td>
                <td width="70%">
                    <span style="color:#ffffff;" >{{ $site->description }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">停車資訊</td>
                <td width="70%">
                    <span style="color:#ffffff;" >{{ $site->parkinginfo }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">總留言數</td>
                <td width="70%">
                    <span style="color:#ffffff;" >{{ $site->total_comments }}</span>                     
                </td>
            </tr>
            <tr>
                <td style="width: 10%">平均評分</td>
                <td width="70%">
                    <span style="color:#ffffff;" >{{ $site->avg_rating }}</span>                     
                </td>
            </tr>
        </table>    
    </div>
</div>
<div id="map">
    <script>
       var activeMarkerPos = {};
       var currentInfoWindow;
       var markers = [];
       var placetype = 'cafe';
       var map = new google.maps.Map(document.getElementById('map'),{
            center:{
                lat: 23.58,
                lng: 120.58
            },
            zoom:7
        });
             
        var LatLng = { lat: {{$site->latitude}}, lng:{{$site->longitude}} };
        map.setCenter(LatLng);
        map.setZoom(15);
        var marker = new google.maps.Marker({
            map: map,
            position: LatLng,
        });

        var infowindow = new google.maps.InfoWindow({});
        currentInfoWindow = infowindow;
        google.maps.event.addListener(this.marker, 'click', function() { 
            activeMarkerPos = {lat: {{$site->latitude}},lng: {{$site->longitude}}};
            infowindow.setContent('{{$site->name}}');
            infowindow.open(this.map,this);
            }
        );
      
        function implementNearbySearch(myObj){
            activeMarkerPos = { lat: {{$site->latitude}}, lng:{{$site->longitude}} };
            placetype = myObj.className;
            getNearbyPlaces(activeMarkerPos,placetype);
            alert(placetype);
        }

        function getNearbyPlaces(position,keyword) {
            let request = {
                location: position,
                radius : 500,
                type: keyword,
            };

            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, nearbyCallback);
        }

        function nearbyCallback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                createMarkers(results);
            }
            else{
                switch(placetype){
                            case "cafe" :
                                alert("附近沒有咖啡廳");
                                break;

                            case "restaurant" :
                                alert("附近沒有餐廳");
                                break;

                            case "gas_station" :
                                alert("附近沒有加油站");
                                break;
                }
            }
        }

        function createMarkers(places) {
            //新增多點坐標顯示的矩形
            var bounds = new google.maps.LatLngBounds();

            places.forEach(place => {
                let marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map,
                    title: place.name,
                    icon: { 
                                url: 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png'                             
                          }, 
                });

                markers.push(marker);

                //將所有座標加到可視地圖裡                        
                bounds.extend(marker.position);
                        

                google.maps.event.addListener(marker, 'click', () => {
                    let request = {
                        placeId: place.place_id,
                        fields: ['name', 'formatted_address', 'geometry', 'rating',
                          'website', 'photos']
                    };

                service.getDetails(request, (placeResult, status) => {
                    showDetails(placeResult, marker, status)
                    });
                });
            });

            //將參考點也加入bounds
            bounds.extend(new google.maps.LatLng(parseFloat(activeMarkerPos.lat), parseFloat(activeMarkerPos.lng)));
            //繪製到地圖
            map.fitBounds(bounds);               
        }

        function setMapOnAll(map){
            for (var i = 0; i< markers.length; i++) {
                markers[i].setMap(map);
            }
        }       

        function deleteMarkers(){
            setMapOnAll();
            markers = [];
        }

        function showDetails(placeResult, marker, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                let placeInfowindow = new google.maps.InfoWindow();
                let rating = "None";
                if (placeResult.rating) rating = placeResult.rating;
                placeInfowindow.setContent('<div><strong>' + placeResult.name +
                '</strong><br>' + '地址 : ' + placeResult.formatted_address + '<br>Rating : ' + rating + '</div>');
                placeInfowindow.open(marker.map, marker);
                currentInfoWindow.close();
                currentInfoWindow = placeInfowindow;
            } 
            else {
                console.log('showDetails failed: ' + status);
            }
        }                                   
    </script>
</div>
<div class="t" style="font-size: 48px; text-align: center; padding-right: 50px">
        搜尋附近
    </div>    
    <div id="tablel" align="center">
        <table>
            <tr>
                <td style="height: 100px; width: 300px">
                    <div id="button1" align="center" style="height: 80%; width: 80%">
                        <button type="button" class="cafe" onclick="implementNearbySearch(this),deleteMarkers()" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">咖啡廳</button>
                    </div>
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button2"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="restaurant" onclick="implementNearbySearch(this),deleteMarkers()" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">餐廳</button> 
                    </div>  
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button3"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="gas_station" onclick="implementNearbySearch(this),deleteMarkers()" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">加油站</button> 
                    </div>  
                </td>                
            </tr>          
        </table>        
    </div>
<div id="wrapper2">
    <div class="title2" style="padding: 3px; margin: 3px">
            <h2 style="color:#000000">留言評分</h2>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                <td style="width: 60%;word-break: break-all;">{!! $message->content !!}</td>
                <td style="width: 10%;">{{ $message->rating }}</td>
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
            {{ $messages->links() }}
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
            <form action="{{ url('search/'.$country.'/'.$site->id.'/message') }}" method="POST" id="message-form-new">
                {{ csrf_field() }}
                <table align="center" id="add_table">
                        <div class = "modal-body-body">   
                            <br>        
                            <tr>
                                <td style="padding-right: 50px " required="required">評論</td>
                                <td>
                                    <textarea class="add_word" name='content' id="content-new"></textarea> 
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
<script>
$("#message-form-new").submit(function(){
  $("#content-new").val($("#content-new").val().replace(/\r\n|\r|\n/g,"<br />"));
});

</script>

@stop
