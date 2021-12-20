<?php
$ids = anti_inject(@$_GET['id']);
$ids = abs((int) $ids);
$mapel = select("DISTINCT nama_siswa, mapel, ids", "tbl_rekap_siswa", "ids = '$ids'");

$no = 1;

$data = select('*', 'tbl_siswa', "id='$ids'");
$detail = mysqli_fetch_object($data);

?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".row > .col-sm-6:first").append('<a href="<?= base("waka/rekap-absensi-siswa"); ?>" class="btn btn-primary">Kembali</a>');
    $(".row > .col-sm-6:first").append('   <a href="<?= base("waka/export.php?data=absensi-mata-pelajaran&id=$ids"); ?>" class="btn btn-default">Export Ms. Excel</a>');
  });
</script>
<div class="col-md-8">
  <table class="table table-bordered" id="list-data">
    <thead>
      <tr>
        <th rowspan="2" class="ctr">No.</th>
        <th rowspan="2" class="ctr">Mata Pelajaran</th>
        <th colspan="5" class="ctr">Kehadiran</th>
      </tr>
      <tr>
        <th class="ctr">Hadir</th>
        <th class="ctr">Izin</th>
        <th class="ctr">Sakit</th>
        <th class="ctr">Tugas</th>
        <th class="ctr">Lain</th>
      </tr>
    </thead>
    <tbody>

    <?php
      while ($x = mysqli_fetch_object($mapel)):

        //Menghitung jumlah absen
        $c_hdr = hitung_absen("kehadiran", "tbl_rekap_siswa", "mapel='$x->mapel' AND ids = '$x->ids' AND kehadiran = 1");
        $thdr = mysqli_fetch_object($c_hdr);

        $c_izn = hitung_absen("kehadiran", "tbl_rekap_siswa", "mapel='$x->mapel' AND ids = '$x->ids' AND kehadiran = 2");
        $tizn = mysqli_fetch_object($c_izn);

        $c_tgs = hitung_absen("kehadiran", "tbl_rekap_siswa", "mapel='$x->mapel' AND ids = '$x->ids' AND kehadiran = 3");
        $ttgs = mysqli_fetch_object($c_tgs);

        $c_skt = hitung_absen("kehadiran", "tbl_rekap_siswa", "mapel='$x->mapel' AND ids = '$x->ids' AND kehadiran = 4");
        $tskt = mysqli_fetch_object($c_skt);

        $c_ln = hitung_absen("kehadiran", "tbl_rekap_siswa", "mapel='$x->mapel' AND ids = '$x->ids' AND kehadiran = 5");
        $tln = mysqli_fetch_object($c_ln);

    ?>

      <tr>
        <td class="ctr"><?= $no++; ?></td>
        <td class="ctr"><?= $x->mapel; ?></td>
        <td class="ctr"><?= $thdr->jumlah; ?></td>
        <td class="ctr"><?= $tizn->jumlah; ?></td>
        <td class="ctr"><?= $tskt->jumlah; ?></td>
        <td class="ctr"><?= $ttgs->jumlah; ?></td>
        <td class="ctr"><?= $tln->jumlah; ?></td>
      </tr>

    <?php endwhile; ?>

    </tbody>
  </table>
</div>
<div class="col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Detal Guru
    </div>
    <div class="panel-body">
      <table class="table">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><?= $detail->nama; ?></td>
        </tr>
        <tr>
          <td>NIS</td>
          <td>:</td>
          <td><?= $detail->nis; ?></td>
        </tr>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><?= $detail->nisn; ?></td>
        </tr>
      </table>
    </div> <!-- end of class panel-body -->
  </div> <!-- end of class panel -->
</div>
