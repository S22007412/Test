<?php
session_start();
$_SESSION['session_type'] = 'student';
header('Location: ../pages/admin/main/intro/index.html');
exit();
?>
