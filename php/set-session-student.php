<?php
session_start();
$_SESSION['session_type'] = 'student';
header('Location: /home/');
exit();
?>
