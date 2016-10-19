<?php
$logfile= 'logs/shshlog.html';
$IP = $_SERVER['REMOTE_ADDR'];
$USERAGENT = $_SERVER['HTTP_USER_AGENT']; 
$logdetails=  date("F j, Y, g:i a") . '<br />' . 'IP: ' . $_SERVER['REMOTE_ADDR'] . '<br />' . 'User Agent: ' . $_SERVER['HTTP_USER_AGENT'];
$rc = fopen($logfile, "a"); 
fwrite($rc, $logdetails);
fwrite($rc, "<br /><br />");
fclose($rc); 
?>