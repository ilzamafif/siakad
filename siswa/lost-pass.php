<?php
include_once '../function/core.php';

$email    = anti_inject($_POST['email']);
$nama  = anti_inject($_POST['nama']);

$sql = select("*", 'tbl_siswa', "email = '$email' OR nama LIKE '%$nama%'");
$cek = mysqli_num_rows($sql);
$data = mysqli_fetch_object($sql);

if ($cek > 0) {

  $req  = "Hallo Admin! Saya mengalami lupa password untuk akun saya";
  $req .= "Mohon reset-kan password akun saya. Terima Kasih! :)";

  $sqlin = insert('tbl_pesan',"id, id_guru, judul, isi", "NULL, '$data->nama', 'Lupa Password', '$req'" );
  die('1');
} else {
  die('0');
}

?>
