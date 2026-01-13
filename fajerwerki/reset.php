<?php
	session_start();
    unset($_SESSION['koszykID']);
    
    header("Location: index.php");
    exit();
?>