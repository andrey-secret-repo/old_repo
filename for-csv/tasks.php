<?php 
//Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'.
$file = fopen('test.txt', 'w+');
fwrite($file, 'Привет, мир!');
fclose($file);
//Считайте данные из файла 'test.txt' и выведите их на экран.
echo file_get_contents('test.txt');
//Переименуйте файл 'test.txt' в 'mir.txt'.
rename('test.txt', 'mir.text');
//Создайте копию файла 'mir.txt' и назовите ее 'world.txt'.
copy('mir.txt', 'world.txt');
//Определите размер файла 'world.txt'. Выведите его на экран. Выведите его в байтах, мегабайтах, гигабайтах.
echo filesize('world.txt'); //байт
echo filesize('world.txt')/1024/1024; //мегабайт
echo filesize('world.txt')/1024/1024/1024; //гигабайт
//Удалите файл 'world.txt'.
unlink('world.txt');
//Проверьте существование файлов 'world.txt' и 'mir.txt'.
if (file_exists('world.txt')) {
	echo "Файл существует";
} else {
	echo "Файл не существует";
}


//Создайте папку 'test'
mkdir('test');
//Переименуйте папку 'test' на 'www'.
rename('test', 'www');
//Удалите папку 'www'.
rmdir('test','www');
//Дан массив со строками. Создайте в папке 'test' папки, названиями которых служат элементы этого массива
mkdir('test');
$arr = ['folder','folder1','folder2'];
foreach($arr as $value) {
	mkdir('test/'.$value);
}


//Выведите на экран название всех файлов и подпапок из папки 'test'.
var_dump(scandir('test'));
//Выведите на экран название всех файлов, но не подпапок из папки 'test'.
$arr = [];
$dir = scandir('test');
foreach($dir as $value) {
	if(is_file('test/'.$value)){
		$arr[] = $value;
	}
}
var_dump($arr);
//В папке 'test' есть файлы и подпапки. Выведите на экран содержимое всех файлов, которые лежат непосредственно в папке 'test'.
$arr = [];
$dir = scandir('test');
foreach($dir as $value){
	if(is_file('test/'.$value)){
		$arr[] = $value;
	}
}
var_dump($arr);
//Выведите на экран название всех файлов с расширением txt из папки 'test'.
$arr = [];
$dir = scandir('test');
foreach($dir as $value) {
	if(is_file('test/'.$value) && preg_match('#.txt$#',$value)){
		$arr[] = $value;
	}
}
var_dump($arr);
//Найдите все файлы из папки 'test' и вставьте в начало каждого файла полный путь к нему (текст файла должен остаться в нем и начинаться с новой строки после пути).
$arr = [];
$dir = scandir('test');
foreach($dir as $value) {
	if(is_file('test/'.$value)) {
		$text = file_get_contents('test/'.$value); 
		$text = 'test/'.$value.PHP_EOL.$text; 
		file_put_contents('test/'.$value, $text); 
	}
}
//Выведите на экран имена всех папок из папки 'test' и их подпапок (может быть любой уровень вложенности).
$arr = [];
function show_dir($dir_name){
	$dir = scandir($dir_name);
	unset( $dir[0], $dir[1] );
	foreach($dir as $val){
		$str = $dir_name;
		if(is_dir($dir_name.'/'.$val)) {
			$str .= '/'.$val;
			$arr[$val] = show_dir($str);
			echo $str;
		}
	}
}
show_dir('test');
//Выведите на экран содержимое всех файлов из папки 'test' и ее подпапок (может быть любой уровень вложенности).
$arr = [];
function show_dir($dir_name) {
	$dir = scandir($dir_name);
	unset($dir[0], $dir[1]);
	foreach($dir as $val) {
		$str = $dir_name;
		if(is_file($dir_name.'/'.$val)) {
			$arr[$val] = file_get_contents($dir_name.'/'.$val);
		}
		if(is_dir($dir_name.'/'.$val)) {
			$str .= '/'.$val;
			$arr[$val] = show_dir($str);
		}
	}
	return $arr;
}
var_dump(show_dir('test'));
//Найдите все файлы из папки 'test' и ее подпапок любого уровня вложенности и вставьте в начало каждого файла полный путь к нему (текст файла должен остаться в нем и начинаться с новой строки после пути).
function insertFullPath($file){ 
	$dir = scandir($file); 
	unset($dir[0], $dir[1]);
	foreach($dir as $key) { 
		if (is_dir($file.'/'.$key)) { 
			insertFullPath($file.'/'.$key); 
		} else { 
			$textf = file_get_contents($file.'/'.$key); 
			$textf = $file.'/'.$key.PHP_EOL.$textf; 
			file_put_contents($file.'/'.$key, $textf); 
		} 
	} 
} 
insertFullPath('test');

?>