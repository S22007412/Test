<?php
session_start();
$_SESSION['session_type'] = 'guest';
header('Location: ../pages/admin/main/interactive-map/index.html');
exit();
?>
