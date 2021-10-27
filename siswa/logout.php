<?php
include_once "../function/core.php";
//logout();
//
unset($_SESSION['token']);
unset($_SESSION['semester']);
unset($_SESSION['thn_ajaran']);
unset($_SESSION['siswa']['pass']);
unset($_SESSION['siswa']['email']);
unset($_SESSION['siswa']['nama']);
unset($_SESSION['siswa']['id']);
unset($_SESSION['siswa']['nis']);
unset($_SESSION['siswa']['nisn']);
unset($_SESSION['siswa']['user']);
unset($_SESSION['siswa']['pass']);
redirect('login');
?>
