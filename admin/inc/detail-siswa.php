<?php
$id = anti_inject(@$_GET['id']);
$id = abs((int) $id);
$siswa = gabung3('tbl_kelas', 'tbl_siswa', 'tbl_ortu_siswa', 'tbl_kelas.nama_kelas = tbl_siswa.rombel', 'tbl_siswa.id = tbl_ortu_siswa.id_siswa', "tbl_siswa.id = '$id'");
$s = mysqli_fetch_assoc($siswa);
?>

<style media="screen">
  .col-md-6{
    padding-bottom: 30px;
  }
</style>
<div class="col-md-4">
  <table class="table">
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td><?= $s['nama']; ?></td>
    </tr>
    <tr>
      <td>NISN</td>
      <td>:</td>
      <td><?= $s['nisn']; ?></td>
    </tr>
    <tr>
      <td>NIS</td>
      <td>:</td>
      <td><?= $s['nis']; ?></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <td><?= $s['kelas']; ?></td>
    </tr>
    <tr>
      <td>Rombel</td>
      <td>:</td>
      <td><?= $s['rombel']; ?></td>
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
      <td>Email</td>
      <td>:</td>
      <td><?= $s['email']; ?></td>
    </tr>
    <tr>
      <td>No. Telp</td>
      <td>:</td>
      <td><?= $s['nomer_telp']; ?></td>
    </tr>
    <tr>
      <td>Tempat, Tanggal Lahir</td>
      <td>:</td>
      <td><?= $s['tempat']; ?>, <?= $s['tanggal_lahir']; ?></td>
    </tr>
  </table>
</div>
<div class="col-md-4">
  <table class="table">
    <tr>
      <td>Nama Ayah</td>
      <td>:</td>
      <td><?= $s['nama_ayah']; ?></td>
    </tr>
    <tr>
      <td>Nama Ibu</td>
      <td>:</td>
      <td><?= $s['nama_ibu']; ?></td>
    </tr>
    <tr>
      <td>Pekerjaan Ayah</td>
      <td>:</td>
      <td><?= $s['pekerjaan_ayah']; ?></td>
    </tr>
    <tr>
      <td>Pekerjaan Ibu</td>
      <td>:</td>
      <td><?= $s['pekerjaan_ibu']; ?></td>
    </tr>
    <tr>
      <td>Tempat lahir Ayah</td>
      <td>:</td>
      <td><?= $s['tempat_lahir_ayah']; ?></td>
    </tr>
    <tr>
      <td>Tempat lahir Ibu</td>
      <td>:</td>
      <td><?= $s['tempat_lahir_ibu']; ?></td>
    </tr>
    <tr>
      <td>Tanggal lahir Ayah</td>
      <td>:</td>
      <td><?= $s['tanggal_lahir_ayah']; ?></td>
    </tr>
    <tr>
      <td>Tanggal lahir Ibu</td>
      <td>:</td>
      <td><?= $s['tanggal_lahir_ibu']; ?></td>
    </tr>
    <tr>
      <td>Alamat Ayah</td>
      <td>:</td>
      <td><?= $s['alamat_ayah']; ?></td>
    </tr>
    <tr>
      <td>Alamat Ibu</td>
      <td>:</td>
      <td><?= $s['alamat_ibu']; ?></td>
    </tr>
    <tr>
      <td>No. Telp Ayah</td>
      <td>:</td>
      <td><?= $s['telp_ayah']; ?></td>
    </tr>
    <tr>
      <td>No. Telp Ibu</td>
      <td>:</td>
      <td><?= $s['telp_ayah']; ?>, <?= $s['tanggal_lahir']; ?></td>
    </tr>
  </table>
  <br>
  <a href="<?= base('admin/tambah-ortu/'. $s['id'].''); ?>" class="btn btn-primary">Tambah Ortu</a>
  <a href="<?= base('admin/edit-siswa/'.$s["id"].''); ?>" class="btn btn-primary">Edit</a>
  <a href="<?= base('admin/siswa');?>" class="btn btn-default">Kembali</a>
</div>
<div class="col-md-4">

  <?php if($s['jk'] == "L"){ ?>
    <img src="<?= base('images/siswa/male.jpg'); ?>" width="300px" class="img img-responsive" alt="" />
  <?php } else {  ?>
  <img src="<?= base('images/siswa/female.jpg'); ?>" width="300px" class="img img-responsive" alt="" />
  <?php } ?>
</div>