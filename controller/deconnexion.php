<?php
session_start();
unset($_SESSION);
unset($_COOKIE);
session_destroy();
header('Location:../view/login/login.php');
