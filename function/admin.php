<?php

function cekuname($username)
{
  $sql = "SELECT * FROM tbl_admin WHERE username = '$username' ";

  return get($sql);
}

function cekusname($username)
{
  $sql = "SELECT * FROM tbl_waka WHERE username = '$username' ";

  return get($sql);
}

function cek_idcard($id_card)
{
  $sql = "SELECT * FROM tbl_guru WHERE id_card = '$id_card' ";

  return get($sql);
}

function cekSiswa($email)
{
  $sql = "SELECT * FROM tbl_siswa WHERE email = '$email' ";

  return get($sql);
}
?>
