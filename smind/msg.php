<?php
$text = "Message";
$q = $_REQUEST["q"];

$pieces = explode("?", $q);
if ($pieces[0] === "sentmsg") 
{
if ($pieces[1] !== "") 
	{
	 $text = $pieces[1];
	  $name1 = fopen("text.txt", "w");   
	  fwrite ($name1, $text);   
	  fclose ($name1);
	} 
} 

if ($pieces[0] === "readmsg") 
{
    $name1 = fopen("text.txt", "r");   
    $text = fread($name1, 4096);
    fclose($name1);    
    echo $text;
} 

?>

