<?php
function led($par){
$command = "p 18 {$par}";    
$command = "echo {$command} > /dev/pigpio";   
echo $command;
$connection = ssh2_connect('192.168.0.103', 22);
ssh2_auth_password($connection, 'root', '258000');
$stream = ssh2_exec($connection, $command);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
}
led("0");
?>