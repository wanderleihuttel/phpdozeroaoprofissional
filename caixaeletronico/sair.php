<?php
session_start();
unset($_SESSION['banco']);
header("Location: login.php");
exit;