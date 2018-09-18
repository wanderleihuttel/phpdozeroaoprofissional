<?php

session_start();
unset($_SESSION['cLogin']);
header("Location: login.php");