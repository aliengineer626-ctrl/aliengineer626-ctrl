<?php
session_start();

session_unset();
session_destroy();

header("Location:back.php");
exit();
?>