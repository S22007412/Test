<?php
session_start();
$_SESSION['session_type'] = 'guest';
header('Location: /home/');
exit();
?>
