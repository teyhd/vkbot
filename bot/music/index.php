<?php
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/music/";
$i = 0;
$handle = opendir ($path);
while($file = readdir($handle))
{
    if ($file != '.' && $file != '..')
    {
        $func[$i] = $file;
        $i++;
    }
};
 
sort ($func);
for ($q = 0; $q<sizeof($func); $q++)
{
        // echo  $func[$q];
        $tet = $func[$q];
        $pieces = explode(".", $tet);     
};

$text = "Message";
$q = $_REQUEST["q"];

$pieces = explode("?", $q);
if ($pieces[0] === "sentmsg") 
{
if ($pieces[1] !== "") 
	{
	 $text = $pieces[1];
    ?><audio src="http://ser.teyhd.ru/vkbot/bot/music/<?php echo $text?>" autoplay></audio><?php
    echo $text;
	} 
} 

