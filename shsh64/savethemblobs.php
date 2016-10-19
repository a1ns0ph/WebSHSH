<?php
echo ('<title>eob WebSHSH result</title>');
echo ('<link rel="stylesheet" type="text/css" href="savestyle.css" />');
if($_POST["ECID"] == "") {
	echo ("Invalid ECID");
	die();
}
echo ('<body>');
echo ('<div>');
echo ('ECID: ' . $_POST["ECID"] . '</br>');
echo ('Device: ' . $_POST["Device"] . '</br>');
exec ('python savethemblobs.py --save-dir /var/www/html/shsh64/shsh/' . $_POST["ECID"] . ' ' . $_POST["ECID"] . ' ' . $_POST["Device"], $output);
$logfile= 'logs/savelog.html';
$logdetails=  date("F j, Y, g:i a") . '<br />' . 'IP: ' . $_SERVER['REMOTE_ADDR'] . '<br />' . 'ECID: ' . $_POST["ECID"] . "</br>" . "Device: " . $_POST["Device"] . "</br>";
$rc = fopen($logfile, "a"); 
fwrite($rc, $logdetails);
fwrite($rc, "<br /><br />");
fclose($rc); 
$dir = "/var/www/html/shsh64/shsh/" . $_POST["ECID"];
echo ('</br> SHSH Available: </br>');
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
    	if ($file == '.' or $file == '..') continue;
    	echo $file . "<br>";
    }
    closedir($dh);
    echo('</div>');
  }
}
echo ('<div>');
echo ('</br>Your SHSH blobs are now saved on my server, to download them click the button below</br></br>');
echo ('	<form action="downloadthemblobs.php" method="post">
			<label for="ECID">ECID: ' . $_POST["ECID"] . '</label>
			<input type="hidden" name="ECID" value="' . $_POST["ECID"] . '"><br>
			<input type="submit" value="Download SHSH files from server">
		</form>
	    </body>');
echo ('</div>');
?>
