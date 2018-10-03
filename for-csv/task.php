<?php 
//Удалите из папки 'test' все файлы размером более 1мб.
$dir = scandir('test');
foreach($dir as $value) {
	if(is_file('test/'.$value) && (filesize('test/'.$value)/1024/1024) > 1) {
		unlink('test/'.$value);
	}
}

//Имеется папка с файлами, узнайте размер этой папки.
$dir = scandir('test');
$size = 0;
foreach($dir as $value) {
	if(is_file('test/'.$value)) {
		$size += round(filesize('test/'.$value)/1024/1024);
	}
}
echo $size.' мб';

//Имеется папка с подпапками, узнайте размеры всех подпапок папки и выведите их на экран
$size = 0;
function getDirsSize($dir_name){
	global $size;
	$dir = scandir($dir_name);
	unset($dir[0], $dir[1]);
	foreach($dir as $value) {
		$str = $dir_name;
		if(is_file($dir_name.'/'.$value)) {
			$size += round(filesize($dir_name.'/'.$value)/1024/1024);
		}
		if(is_dir($dir_name.'/'.$value)) {
			$str .= '/'.$value;
			$arr[$value] = getDirsSize($str);
		}
	}
	return $size;
}
echo getDirsSize('test');
?>