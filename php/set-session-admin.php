<?php
session_start();
$_SESSION['session_type'] = 'admin';
header('Location: ../pages/admin/main/intro/index.html');
exit();
?>
