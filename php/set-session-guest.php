<?php
session_start();
$_SESSION['session_type'] = 'guest';
header('Location: ../pages/main/intro/index.html');
exit();
?>
