<table class="table content-table" align="center">
    <thead>
        <tr>
            <th scope="col">景點名稱</th>
            <th scope="col">地址</th>
            <th scope="col">描述</th>
            <th scope="col">停車資訊</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sites as $site)
        <tr>
            <td>
                <a href="{{ url('search/'.$country.'/'.$site->id.'/message') }}"><span style="color:#4F4F4F;" >{{ $site->name }}</span></a>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $site->address }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $site->description }}</span>
            </td>

            <td>
                <span style="color:#4F4F4F;" >{{ $site->parkinginfo }}</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
@import "compass/css3";
.content-table {
  font-family: '微軟正黑體';
  /*margin: 25px auto;
  border-collapse: collapse;
  border: 0px;
  border-bottom: 0px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);*/
}
.content-table tbody tr:hover {
  background: #f4f4f4;
  cursor: pointer;
}
.content-table tr:hover td {
  color: #555;
}

.content-table tr.active
{
  background-color: #E6E6FA;
}

.content-table th, .content-table td {
  color: #3a4750;
  border: 0px;
  padding: 12px 35px;
  border-collapse: collapse;
}

.content-table td {
  padding: 12px 20px;
}

.content-table th {
  /*background: #4760bb;*/
  color: #3a4750;
  text-transform: uppercase;
  font-size: 15px;
}
.content-table th.last {
  border-right: none;
} 

.button {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    padding: 4px 20px;
    border: 0px solid #2ca18d;
    border-radius: 8px;
    background: #a31f15;
    background: -webkit-gradient(linear, left top, left bottom, from(#a31f15), to(#ab1b1b));
    background: -moz-linear-gradient(top, #a31f15, #ab1b1b);
    background: linear-gradient(to bottom, #a31f15, #ab1b1b);
    -webkit-box-shadow: #428cf1 0px 0px 3px 0px;
    -moz-box-shadow: #428cf1 0px 0px 3px 0px;
    box-shadow: #428cf1 0px 0px 3px 0px;
    text-shadow: #1c3b65 1px 1px 0px;
    font: normal normal bold 12px arial;
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase
}
.button:hover {
    border: 0px solid #39d1b7;
    background: #c42519;
    background: -webkit-gradient(linear, left top, left bottom, from(#c42519), to(#cd2020));
    background: -moz-linear-gradient(top, #c42519, #cd2020);
    background: linear-gradient(to bottom, #c42519, #cd2020);
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase
}
.button:active {
    background: #62130d;
    background: -webkit-gradient(linear, left top, left bottom, from(#62130d), to(#ab1b1b));
    background: -moz-linear-gradient(top, #62130d, #ab1b1b);
    background: linear-gradient(to bottom, #62130d, #ab1b1b);
    text-transform: uppercase
}
.button:focus {
    text-transform: uppercase
}
</style>
