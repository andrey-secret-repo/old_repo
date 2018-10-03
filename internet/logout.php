<?php
session_start(); 
session_destroy();
header('Location: /for-auth/index.php');
?>
