<?php 
// header ("Content-Type:text/xml");
include 'Database.php';

// $file2 = fopen('text.xml', 'r+');
// $text = fread($file2, filesize('text.xml'));
// fclose($file2);

// $file = fopen('text2.xml', 'a+');
// fwrite($file, '<<<XML'.PHP_EOL);
// fwrite($file, $text);
// fwrite($file, 'XML;');
// fclose($file);
// echo $text;
// $arr = [
// 	[
// 		'name'=>'Andrey-1111',
// 		'surname'=>'Andrienko-1111',
// 		'age'=>'22-1111',
// 		'email'=>'mail@mail.com-1111',
// 	],
// 	[
// 		'name'=>'Andrey-2222',
// 		'surname'=>'Andrienko-2222',
// 		'age'=>'22-2222',
// 		'email'=>'mail@mail.com-2222',
// 	],
// 	[
// 		'name'=>'Andrey-3333',
// 		'surname'=>'Andrienko-3333',
// 		'age'=>'22-3333',
// 		'email'=>'mail@mail.com-3333',
// 	]
// ];

// $a = new SimpleXMLElement('<list/>');

// foreach ($arr as $value) {
// 	$user = $a->addChild('user');
// 	foreach ($value as $key => $value) {
// 		$user->$key = $value;
// 	}
// }
// $file = fopen('text.xml', 'a+');
// $str = $a->asXML();
// fwrite($file, $str);
// fclose($file);

// $text = file_get_contents('test/'.$value); 
// $text = 'test/'.$value.PHP_EOL.$text; 
// file_put_contents('test/'.$value, $text);



$all = $user->getAllRows();
foreach ($variable as $key => $value):
	
$a = new SimpleXMLElement('<users/>');
foreach ($all as $value) {
	$user = $a->addChild('user');
	foreach ($value as $key => $value) {
		$user->$key = $value;
	}
}
$str = $a->asXML('newfile.xml');

 ?>