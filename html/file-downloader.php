<?php

//$file = $_POST['fileName']; 
$file = $_REQUEST['fileName']; 
$referer = parse_url($_SERVER["HTTP_REFERER"]);
print_r($referer);
// hardcode list of allowed files to prevent abuse

$allowedFiles = array(
	"http://fmq.a52.mwp.accessdomain.com/wp-content/uploads/2018/06/Klue-Ebook-Bundle-for-Product-Marketers.pdf",
	"http://fmq.a52.mwp.accessdomain.com/wp-content/uploads/2018/02/Klue-Ebook-Bundle-for-Product-Marketers.pdf",
);
// check if query param fileName is in the list of approved downloads
// check if referer is ok
if(in_array($file, $allowedFiles) && $referer['path'] == "competitive-strategy-resources") {
	$pathinfo = parse_url($file);
	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename='" . basename($pathinfo['path']) . "'"); 
	readfile ($_SERVER['DOCUMENT_ROOT'].$pathinfo['path']);
}
else {
	header('HTTP/1.0 403 Forbidden');

	echo 'Forbidden Activity';
}
exit(); 
?>

 