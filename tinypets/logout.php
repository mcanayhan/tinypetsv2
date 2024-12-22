<?php
session_start();
session_unset();
session_destroy();
header('Location: tinypets.php'); // Ana sayfaya yönlendiriyor
exit();
?>
