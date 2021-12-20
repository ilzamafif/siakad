<?php
$no = 1;
$sqlg = select('*', "tbl_siswa");

?>

<div class="col-md-8">
  <table class="table table-bordered table-striped" id="list-data">
    <thead>
      <tr>
        <th class="ctr">No.</th>
        <th class="ctr">Nama Siswa</th>
        <th class="ctr">NIS</th>
        <th class="ctr">Opsi</th>
      </tr>
    </thead>
    <tbody>

    <?php while ($g = mysqli_fetch_object($sqlg)) : ?>

      <tr>
        <td class="ctr"><?= $no++; ?></td>
        <td><?= $g->nama; ?></td>
        <td class="ctr">
          <?php
            if(empty($g->nis)){
              echo "Belum ada NIS";
            } else {
              echo $g->nis;
            }
           ?>
        </td>
        <td class="ctr">
          <a href="rekap-harian-siswa/<?= $g->nis; ?>" class="btn btn-default">Lihat</a>
        </td>
      </tr>

    <?php endwhile;  ?>

    </tbody>
  </table>
</div>
<div class="col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Petunjuk
    </div>
    <div class="panel-body">
      <ul class="list-group">
        <li class="list-group-item">1. Pilih Nama siswa yang akan dilihat absensi hariannya</li>
        <li class="list-group-item">2. Klik tombol <b>Lihat</b></li>
        <li class="list-group-item">3. Setelah itu akan di <i>redirect</i> ke halaman data absen harian sesuai nama siswa yang dipilih </li>
        <li class="list-group-item">4. Selesai </li>
      </ul>
    </div>
  </div>
</div>
