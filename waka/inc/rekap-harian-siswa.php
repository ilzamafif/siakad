<?php
$id = @$_GET['id'];
$data = gabung('tbl_absensi','tbl_siswa', 'tbl_absensi.idg = tbl_siswa.nis', "tbl_siswa.nis='$id'");
$sqlg = select('*', "tbl_siswa", "nis='$id'");
$detail = mysqli_fetch_object($sqlg);
$no =1;
?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".row > .col-sm-6:first").append('<a href="<?= base("waka/absensi-harian-siswa"); ?>" class="btn btn-primary">Kembali</a> ');
    $(".row > .col-sm-6:first").append('   <a href="<?= base("waka/export.php?data=rekap-harian-siswa&id=$id");?>" class="btn btn-default">Export Ms. Excel</a>');
  });
</script>
<div class="col-md-12">
  <h3>Rekap Data Absen Harian</h3>
  <hr>
  <div class="row">
    <div class="col-md-8">
      <table class="table table-bordered table-striped" id="list-data">
        <thead>
          <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
          </tr>
        </thead>
        <tbody>

        <?php while ($hr = mysqli_fetch_object($data)) : ?>

          <tr>
            <td><?= $no++; ?></td>
            <td><?= $hr->hari; ?></td>
            <td><?= $hr->tanggal; ?></td>
            <td><?= $hr->jam_msk; ?></td>
            <td><?= $hr->jam_plg; ?></td>
          </tr>

        <?php endwhile; ?>

        </tbody>
      </table>
    </div> <!-- end of class col md 8 -->
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Detail Siswa
        </div>
        <div class="panel-body">
          <table class="table">
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?= $detail->nama ? $detail->nama : 'tidak ada'; ?></td>
            </tr>
            <tr>
              <td>NIS</td>
              <td>:</td>
              <td><?= $detail->nis; ?></td>
            </tr>
            <tr>
              <td>No. NISN</td>
              <td>:</td>
              <td><?= $detail->nisn; ?></td>
            </tr>
          </table>
        </div> <!-- end of class panel-body -->
      </div> <!-- end of class panel -->
    </div> <!-- end of class col-md-4 -->
  </div> <!-- end of class row -->
</div> <!-- end of class col md 12 -->
