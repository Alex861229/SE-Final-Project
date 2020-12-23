<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Veridical 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131203

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<div class="bootstrap-iso">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>台韓景點地圖</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="{{asset('css/default.css')}}" rel="stylesheet">
<link href="{{asset('css/fonts.css')}}" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
<style>
    #map{
        width: 100%;
        height: 440px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtM3X8domwSOC9JQBfy1NoP02mUy6RnHQ&libraries=places"
  type="text/javascript"></script>
<!-- Test -->
<script src=//code.jquery.com/jquery-3.5.1.slim.min.js integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin=anonymous></script>
<!-- Test End -->

<!-- BS JavaScript -->
 <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css" />

    <!-- Bootstrap -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Have fun using Bootstrap JS -->

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>

<div class="row" style="margin-left: 5px; margin-right: 5px">
<div id="menu" style="position: relative; text-align: right; margin: 3px;padding: 0;">
        <ul style="display: block;list-style-type: disc;">
            <li style="float:left;" ><img class="l_img" src="{{ asset('css/images/logo.jpg') }}"  style="  width: 48px; height: 48px; float:left; margin-top: 5px" ></a></li>
            <li style="float:left;  height: 48px; line-height: 48px; color: #ffffff" >台韓景點地圖</a></li>
            <li class="current_page_item"><a href="#" title="">主頁</a></li>
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
<body style="font-family: 'Source Sans Pro', sans-serif;font-size: 12pt;font-weight: 400;
    background-color: #333333;">    
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="#">台韓景點地圖</a></h1>
            <span style="display:block">Design by <a href="https://www.facebook.com/AlexHsu19971229/" rel="nofollow">Alex Hsu</a></span>
            <span>今天想來點...</span>
        </div>    
        <div id="search" style="text-align:center; color: #ffffff">    
            <span class="icon"><i class="fa fa-search"></i></span>
            <form action="{{ url('search/result') }}" method="get" >
                <input type="radio" style="border-radius:10px" name="country" value="tw" checked>台灣
                <input type="radio" style="border-radius:10px" name="country" value="kr">韓國
                <input type="text" class="form-controller" style="color: #000000" id="search" name="search"></input>
            </form> 
        </div>
    </div>
</div>
<div id="wrapper1">
<div id="SIDE" >
    <div class="map" id="app">
        
        <p>顯示搜尋結果地圖</p>
        <!-- 顯示搜尋結果地圖 -->
        <div id="map">
            <script>
               var activeMarkerPos = {};
               var currentInfoWindow;
               var placetype = 'cafe';
               var map = new google.maps.Map(document.getElementById('map'),{
                    center:{
                        lat: 23.58,
                        lng: 120.58
                    },
                    zoom:7
                });
                @foreach ($sites as $site)
                var LatLng = { lat: {{$site->latitude}}, lng:{{$site->longitude}} };
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
                @endforeach

                function implementNearbySearch(myObj){
                    if(activeMarkerPos.lat != null && activeMarkerPos.lng != null){
                        placetype = myObj.className;
                        getNearbyPlaces(activeMarkerPos,placetype);
                    }
                    else {
                        alert("請選擇一個地點!");
                    }
               }

                function getNearbyPlaces(position,keyword) {
                    let request = {
                        location: position,
                        radius :500,
                        keyword: keyword,
                    };

                    service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, nearbyCallback);
                }

                function nearbyCallback(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        createMarkers(results);
                    }
                    else{
                        alert("附近沒有" + placetype);
                    }
                }

                function createMarkers(places) {
                    places.forEach(place => {
                        let marker = new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            title: place.name,
                            icon: { 
                                        url: 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png'                             
                                  }, 
                        });

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
                }

                function showDetails(placeResult, marker, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        let placeInfowindow = new google.maps.InfoWindow();
                        let rating = "None";
                        if (placeResult.rating) rating = placeResult.rating;
                        placeInfowindow.setContent('<div><strong>' + placeResult.name +
                          '</strong><br>' + 'Rating: ' + rating + '</div>');
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

        
    </div>
      
    <div class="t" style="font-size: 48px; text-align: center; padding-right: 50px">
        搜尋附近
    </div>    
    <div id="tablel" align="center">
        <table>
            <tr>
                <td style="height: 100px; width: 300px">
                    <div id="button1" align="center" style="height: 80%; width: 80%">
                        <button type="button" class="cafe" onclick="implementNearbySearch(this)" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">咖啡廳</button>
                    </div>
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button2"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="restaurant" onclick="implementNearbySearch(this)" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">餐廳</button> 
                    </div>  
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button2"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="gas_station" onclick="implementNearbySearch(this)" style="height: 80%; width: 80%; border-radius:15px; font-size: 24px">加油站</button> 
                    </div>  
                </td>                
            </tr>          
        </table>        
    </div>
</div>
</div>

<div id="dl" align="center" style="background-color: #ffffff; padding-top: 10px">
    <button type="button" class="register" style="height: 80%; width: 20%; border-radius:15px; font-size: 24px" onclick="location.href = '{{ route('download', ['country' => 'tw'])}}'">台灣資料下載</a></h1><br>
    <button type="button" class="register" style="height: 80%; width: 20%; border-radius:15px; font-size: 24px" onclick="location.href = '{{ route('download', ['country' => 'kr'])}}'">韓國資料下載</a></h1><br>
</div>

<div id="wrapper3">
    <div id="portfolio" class="container">
        <div class="title">
            <h2 style="font-size: 48px; text-align: center; padding-right: 50px">附近景點</h2>
        </div>
        <table class="comment" style="border:3px #cccccc solid; text-align:center; width: 100%; border-radius: 5px; font-size: 18px " align="center" cellpadding="10" border='1'>
            <tr style="background-color: #BEBEBE;">
                <td width="200px" style="padding: 5px">編號</td>
                <td width="1400px" style="padding: 5px">景點</td>
            </tr>
            @foreach ($sites as $site)
            <tr>
                <td width="200px" style="padding: 5px"><a href = '{{ url('search/'.$country.'/'.$site->id.'/message') }}'>{{$site->name}}</a></td>
                <td width="1400px" style="padding: 5px">{{$site->address}}</td>
            </tr>
            @endforeach
        </table>
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

</body>
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
            @if (count($errors) > 0)
                <div class="alert alert-danger" id="errordiv">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
            <form action="{{ url('register') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <font face="monospace" size="5">Name</font>
                <input type="name" name="name"><br><br>
                <font face="monospace" size="5">Avatar</font>
                <input type="file" name="avatar"><br><br>
                <font face="monospace" size="5">Email</font>
                <input type="email" name="email"><br><br>
                <font face="monospace" size="5">Account</font>
                <input type="account" name="account"><br><br>
                <font face="monospace" size="5">Password</font>
                <input type="password" name="password"><br><br>
                <font face="monospace" size="5">Confirm Password</font>
                <input type="password" name="password_confirmation"><br><br>
                <input type="submit" value="註冊" class="btn btn-primary"s>
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
</html>
