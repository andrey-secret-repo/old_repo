<?php
header ("Content-Type:text/xml");
ini_set("display_errors", "1");

$a =
<<<XML
<?xml version="1.0"?>
	<list>
		<user>
			<name>Andrey-1111</name>
			<surname>Andrienko-1111</surname>
			<age>22-1111</age>
			<email>mail@mail.com-1111</email>
		</user>
		<user>
			<name>Andrey-2222</name>
			<surname>Andrienko-2222</surname>
			<age>22-2222</age>
			<email>mail@mail.com-2222</email>
		</user>
		<user>
			<name>Andrey-3333</name>
			<surname>Andrienko-3333</surname>
			<age>22-3333</age>
			<email>mail@mail.com-3333</email>
		</user>
	</list>
XML;
?>

<?php 

$users = new SimpleXMLElement($a);
echo $users;

?>
