<?php
include_once '../function/core.php';

//logout();
unset($_SESSION['waka']['user']);
unset($_SESSION['waka']['pass']);
unset($_SESSION['semester']);
redirect('login');
?>
