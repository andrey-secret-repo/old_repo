<link rel="stylesheet" href="style.css">
<?php ini_set("display_errors", 1); ?>
<?php include "Dadabase.php"; ?>
<?php 
$db = new Database();
$id = $_GET['id'];
$db->deleteRow([$id]);
echo "Запись удалена";
?>
<?php $db->Disconnect() ?>
<hr>
<a href="/">На главную</a>