<?php

function login($username){
	$sql = "SELECT * FROM admin WHERE username = '$username' ";

	return get($sql);
}

function loginSiswa($username){
	$sql = "SELECT * FROM tbl_siswa WHERE username = '$username' ";

	return get($sql);
}

?>