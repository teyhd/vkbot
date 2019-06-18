<!doctype html>
<html lang="ru">
 <head>
  <meta name="google" value="notranslate">
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="description" content="SMIND - smart mind"/>
  <meta name="generator" content="2017.1.0.379"/>
<title>SMind</title>
<link href="css/smind.css" rel="stylesheet" type="text/css">
</head>

<body>
<script type="text/javascript" src="js/prob.js"></script>
<div id="shad">  </div>
<div>    </div>
<div>    </div>
<div>    </div>
<div>    </div>
<div>    </div>
<div>    </div>
<div id="KillDay">
  <div id="DayBar"></div>
  <div id="Hourday" class="HPD">HP</div>
</div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div class="time" id="clock">
  <span class="hour">hh</span>:<span class="min">mm</span>:<span class="sec">ss</span>
	</div>
<div>    </div>	
<div>    </div>
<div id="myProgress">
  <div id="myBar">10%</div>
  <div id="secs" class="HP">HP</div>
</div>
<div>    </div>
<div id="killmin">
  <div id="Bar">10</div>
   <div id="mins" class="HP">HP</div>
</div>
<div>   </div>
<div>   </div>
<iframe src="https://calendar.google.com/calendar/embed?title=%D0%A0%D0%B0%D1%81%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5&amp;height=635&amp;wkst=2&amp;hl=ru&amp;bgcolor=%2333ffff&amp;src=spiderman200101%40gmail.com&amp;color=%2329527A&amp;src=%23contacts%40group.v.calendar.google.com&amp;color=%231B887A&amp;src=ru.russian%23holiday%40group.v.calendar.google.com&amp;color=%23711616&amp;ctz=Europe%2FSamara" class="calendar" style="border:solid 1px #777" width="489" height="635" frameborder="0" scrolling="no"></iframe>
<div>   </div>
   <form name="myForm">
    <select class="but1" id="select" name="Light" OnChange="light(5);">
        <option value="0" selected="selected">Выкл</option>
        <option value="1">Светло</option>
        <option value="2">Темно</option>
        <option value="3">Темень</option>
        <option value="4">Усни!</option>
    </select>
    </form>
<div>   </div>
<div>   </div>
<div>   </div>
<div>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
</div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div id="dates" class="date">21марта</div>
<!--<div class="weather">
<a target="_blank" href="https://nochi.com/weather/ulyanovsk-36692"><img src="https://w.bookcdn.com/weather/picture/32_36692_1_20_3658db_250_2a48ba_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=589&anc_id=60474"  alt="booked.net"/></a></div>-->
<div> <?php
function weather(){	
$url = "https://api.darksky.net/forecast/4ed56a164e980c832e5739dd929dc06c/54.3711173,48.5828901?exclude=minutely,flags,hourly,daily,alerts?temperature?summary?auto";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);

$json = json_decode($json);
$arr = $json->currently;
$temp = $arr->temperature;
$temp = round(($temp - 32) *  5/9); 	
echo "<div class='tweat'> $temp&deg </div>";
}

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
 weather();
} else{
	echo $hint === "" ? "no suggestion" : $hint;
}

	
?>  </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>    </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div>   </div>
<div id="week" class="weeks">ПН</div>
</body>
</html>
