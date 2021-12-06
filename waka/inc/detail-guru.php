<?php
$id = @$_GET['id'];
$guru = gabung('detail_guru', 'tbl_guru', 'detail_guru.id_guru = tbl_guru.id', "tbl_guru.id = '$id'");
$s = mysqli_fetch_assoc($guru);
?>

<style media="screen">
  .col-md-6{
    padding-bottom: 30px;
  }
</style>
<div class="col-md-6">
  <table class="table">
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td><?= $s['nama_guru']; ?></td>
    </tr>
    <tr>
      <td>NIP</td>
      <td>:</td>
      <td><?= $s['nip']; ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><?= $s['email']; ?></td>
    </tr>
    <tr>
      <td>No. Telp</td>
      <td>:</td>
      <td><?= $s['telp']; ?></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td><?= $s['jk']; ?></td>
    </tr>
    <tr>
      <td>Alamat Lengkap</td>
      <td>:</td>
      <td><?= $s['alamat_lengkap']; ?></td>
    </tr>
    <tr>
      <td>Jenis PTK</td>
      <td>:</td>
      <td><?= $s['jenis_ptk']; ?></td>
    </tr>
    <tr>
      <td>No ID Card</td>
      <td>:</td>
      <td><?= $s['id_card']; ?></td>
    </tr>
    <tr>
      <td>Tempat, Tanggal Lahir</td>
      <td>:</td>
      <td><?= $s['tmp_lahir']; ?>, <?= $s['tgl_lahir']; ?></td>
    </tr>
  </table>
  <br>
  <a href="<?= base('waka/edit-guru/'.$s["id"].''); ?>" class="btn btn-primary">Edit</a>
  <a href="<?= base('waka/guru');?>" class="btn btn-default">Kembali</a>
</div>
<div class="col-md-6">
  <img src="<?= base("/images/guru/".$s['id_card']); ?>.jpg" class="img img-responsive" alt="" width="300px" />

  <!-- <?php if($s['jk'] == "L"){ ?>
    <img src="<?= base('images/guru/male.jpg'); ?>"  class="img img-responsive" alt="" />
  <?php } else {  ?>
  <img src="<?= base('images/guru/female.jpg'); ?>" width="300px" class="img img-responsive" alt="" />
  <?php } ?> -->
</div>
