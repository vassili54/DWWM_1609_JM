<?php 
//logout.php
// Démarre une session PHP
session_start();
session_destroy();
header('Location: index.php');
exit;
?>