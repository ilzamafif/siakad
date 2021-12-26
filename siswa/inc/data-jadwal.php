<?php
include_once '../function/core.php';
$hari = date('N');
$no = 1;

//Queries
$id = @$_SESSION['siswa']['id'];
$siswa = gabung('tbl_kelas', 'tbl_siswa', 'tbl_kelas.nama_kelas = tbl_siswa.rombel', "tbl_siswa.id = '$id'");
$x = mysqli_fetch_object($siswa);
$kelas = $x->nama_kelas;

$sqlidkls = select("id", "tbl_kelas", "nama_kelas = '$kelas'");
$idkls = mysqli_fetch_object($sqlidkls);
$id_kelas = $idkls->id;

$jadwal = select('*', 'tbl_jadwal', "kelas = '$id_kelas'");

?>
<style media="screen">
  table.dataTable {
    width: 110% !important;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $(".row > .col-sm-6:first").append(
      '<a href="tambah-jadwal" class="btn btn-primary">Tambah Jadwal Baru</a>'
    );

    $(".row > .col-sm-6:first").append(' <a href="export.php?data=jadwal" class="btn btn-default">Export Ms. Excel</a>');
  });
</script>
<div class="col-md-12">
  <h3>Data Jadwal</h3>
  <hr>
  <div class="scroll">
    <table class="table table-striped table-bordered" id="list-data" border="1px">
      <thead>
        <tr>
          <th class="ctr">No.</th>
          <th class="ctr">Hari</th>
          <th>Mapel</th>
          <th>Guru</th>
          <th>Jam Mulai</th>
          <th>Jam Selesai</th>
        </tr>
      </thead>
      <tbody>

        <?php
        if (mysqli_num_rows($jadwal) != 0) :

          while ($j = mysqli_fetch_assoc($jadwal)) :

            //Query Hari
            $sqlhari  = select('nama_hari', 'tbl_hari', "id=" . $j["hari"]);
            $h        = mysqli_fetch_assoc($sqlhari);

            //Query Guru
            $sqlguru  = select('*', 'tbl_guru', "id = " . $j["guru"]);
            $g        = mysqli_fetch_assoc($sqlguru);

            //Query Mapel
            $sqlmapel  = select('nama_mapel', 'tbl_mapel', "id = " . $j["mapel"]);
            $m        = mysqli_fetch_assoc($sqlmapel);

        ?>

            <tr>
              <td><?= $no++; ?></td>
              <td><?= $h['nama_hari']; ?></td>
              <td><?= $m['nama_mapel']; ?></td>
              <td><?= $g['nama_guru']; ?></td>
              <td><?= $j['jam_mulai']; ?></td>
              <td><?= $j['jam_selesai']; ?></td>


            </tr>

          <?php endwhile; ?>

        <?php endif; ?>

      </tbody>
    </table>
  </div>
</div>