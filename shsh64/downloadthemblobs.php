<?php
echo ('<title>eob WebSHSH result</title>');
if($_POST["ECID"] == "") {
	echo ("Invalid ECID");
	die();
}
$filename = '/var/www/html/shsh64/shsh/' . $_POST["ECID"];

if (file_exists($filename)) {
    echo "Preparing Zip";
    exec ('rm /var/www/html/shsh64/zip/' . $_POST["ECID"] . '_SHSH.zip');
    exec ("zip -r /var/www/html/shsh64/zip/" . $_POST["ECID"] . "_SHSH.zip" . " " . "shsh/" . $_POST["ECID"], $output);
    $logfile= 'logs/dllog.html';
    $logdetails=  date("F j, Y, g:i a") . '<br />' . 'IP: ' . $_SERVER['REMOTE_ADDR'] . '<br />' . 'ECID: ' . $_POST["ECID"] . "</br>";
    $rc = fopen($logfile, "a"); 
    fwrite($rc, $logdetails);
    fwrite($rc, "<br /><br />");
    fclose($rc); 
    $file = "/var/www/html/shsh64/zip/" . $_POST["ECID"] . "_SHSH.zip";
	if (file_exists($file)) {
    	header('Content-Description: File Transfer');
    	header('Content-Type: application/octet-stream');
    	header('Content-Disposition: attachment; filename="'.basename($file).'"');
    	header('Expires: 0');
    	header('Cache-Control: must-revalidate');
    	header('Pragma: public');
    	header('Content-Length: ' . filesize($file));
    	while (ob_get_level()) {
            ob_end_clean();
        }
        readfile($file);

}
} 
else {
    echo "Invalid ECID";
}
?>
