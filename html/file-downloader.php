<?php

//$file = $_POST['fileName']; 
$file = parse_url($_REQUEST['fileName']); 
$referer = parse_url($_SERVER["HTTP_REFERER"]);

// hardcode list of allowed files to prevent abuse

$allowedFiles = array(
	"/wp-content/uploads/2019/02/Klue-Ebook-Bundle-for-Product-Marketers.pdf",
	"/wp-content/uploads/2019/02/Klue-Ebook-Bundle-for-Product-Marketers.pdf",
	"/wp-content/uploads/2019/02/06-25-2018_Klue-Battlecard-Examples-1.pdf",
	"/wp-content/uploads/2019/02/WinLoss_Interview_Checklist_Klue-1.pdf",
	"/wp-content/uploads/2019/02/K2-Case-Study-May-7.pdf",
	"/wp-content/uploads/2019/02/Dell-EMC-Digital-Case-Study.pdf",
);
// check if query param fileName is in the list of approved downloads
// check if referer is ok

if(in_array($file['path'], $allowedFiles)) {
	
	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename='" . basename($file['path']) . "'"); 
	readfile ($_SERVER['DOCUMENT_ROOT'].$file['path']);
}
else {
	header('HTTP/1.0 403 Forbidden');
	echo 'Forbidden Activity';
	echo $file['path'];
}
exit(); 
?>

 