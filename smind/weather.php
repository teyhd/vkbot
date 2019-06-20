<?php
function weather(){	
$url = "https://api.darksky.net/forecast/a251147ccfb4e5c7ecc5f91e54598f8b/54.3711173,48.5828901?exclude=minutely,flags,hourly,daily,alerts?temperature?summary?auto";
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
echo "$temp";
}

$q = $_REQUEST["q"];
$hint = "";
// lookup all hints from array if $q is different from "" 
if ($q !== "") {
 weather();
} else{
	echo $hint === "" ? "no suggestion" : $hint;
}

?>