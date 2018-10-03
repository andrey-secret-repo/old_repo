<?php 
$a = file_get_contents('test.xml');
$dom = new DOMDocument();
$dom->loadXML($a);

$s = simplexml_import_dom($dom);
// echo "<pre>";
// print_r($s->user[1]);
// echo "<pre>";

$arr = [];
for ($i=0; $i < count($s->user); $i++) { 
	foreach ($s->user[$i] as  $value) {
		$arr[] = $value;
	}
	echo "<pre>";
	var_dump($arr);
	die();
}

// print_r($arr);
// echo "<pre>";
?>