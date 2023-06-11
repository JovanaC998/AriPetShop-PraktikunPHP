<?php
header("Location: ../index.php?page=home");
session_start();
session_destroy();
header("Location: ../index.php?page=home");
?>
