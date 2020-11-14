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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>台韓景點地圖</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="{{asset('css/default.css')}}" rel="stylesheet">
<link href="{{asset('css/fonts.css')}}" rel="stylesheet">


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<div class="row">
<div id="menu" style="position: relative;">
        <ul>
            <li style="float:left;" ><img class="l_img" src="{{ asset('css/images/logo.jpg') }}"  style="  width: 48px; height: 48px; float:left" ></a></li>
            <li style="float:left;  height: 48px; line-height: 48px; color: #ffffff" >台韓景點地圖</a></li>
            <li class="current_page_item"><a href="#" title="">主頁</a></li>
            <li><a href="{{ url('/user') }}" title="">註冊</a></li>
            <li><a href="{{ url('/message') }}" title="">登入</a></li>
        </ul>
</div>
</div>
<body>    
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="#">台韓景點地圖</a></h1>
            <span style="display:block">Design by <a href="https://www.facebook.com/AlexHsu19971229/" rel="nofollow">Alex Hsu</a></span>
            <span>今天想來點...</span>
        </div>    
        <div id="search" style="text-align:center; ">    
            <span class="icon"><i class="fa fa-search"></i></span>
            <input type="search" id="search" placeholder="Search..." / style="width: 800px; height: 40px; border-radius:15px;"> 
        </div>
    </div>
</div>
<div id="wrapper1">
<div id="SIDE" >
    <div id="map" style="padding-right: 80px">
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1nRkq3fdSQjFPzKRfoYwKGYbVRhqQo1cP"  width="100%" height="780px"></iframe> 
    </div>
    <div class="t" style="font-size: 48px; text-align: center; padding-right: 50px">
        搜尋附近
    </div>    
    <div id="tablel" align="center">
        <table>
            <tr>
                <td style="height: 100px; width: 300px">
                    <div id="button1" align="center" style="height: 80%; width: 80%">
                        <button type="button" class="coffee" style="height: 80%; width: 80%; border-radius:15px;">咖啡廳</button>
                    </div>
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button2"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="restaurant" style="height: 80%; width: 80%; border-radius:15px;">餐廳</button> 
                    </div>  
                </td>
                <td style="height: 100px; width: 300px">    
                    <div id="button2"  align="center" style="height: 80%; width: 80%">
                        <button type="button" class="gas" style="height: 80%; width: 80%; border-radius:15px;">加油站</button> 
                    </div>  
                </td>                
            </tr>          
        </table>        
    </div>
</div>
</div>

<div id="wrapper3">
    <div id="portfolio" class="container">
        <div class="title">
            <h2>附近景點</h2>
        </div>
        <table class="comment" style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            <tr>
                <td width="200px">1</td>
                <td width="1400px">中央大學</td>
            </tr>
            <tr>
                <td width="200px">2</td>
                <td width="1400px">台灣大學</td>
            <tr>
                <td width="200px">3</td>
                <td width="1400px">清華大學</td>
            </tr>
            <tr>
                <td width="200px">4</td>
                <td width="1400px">交通大學</td>
            </tr>
            <tr>
                <td width="200px">5</td>
                <td width="1400px">政治大學</td>
            </tr>
            <tr>
                <td width="200px">6</td>
                <td width="1400px">成功大學</td>
            </tr>
            <tr>
                <td width="200px">7</td>
                <td width="1400px">中山大學</td>
            </tr>
            <tr>
                <td width="200px">8</td>
                <td width="1400px">中興大學</td>
            </tr>
            <tr>
                <td width="200px">9</td>
                <td width="1400px">中正大學</td>
            </tr>
            <tr>
                <td width="200px">10</td>
                <td width="1400px">總統府</td>
            </tr>       
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
            <p><a href="https://dataportal.asia/home">亞洲公開資料數據集</a>
        </div>
    </div>
</div>

</body>
</html>
