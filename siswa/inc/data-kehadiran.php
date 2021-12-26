<?php

?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#list-data").DataTable({
      'pageLength': 5
    });

    $(".row > .col-sm-6:first").append(' <a href="export.php?data=jadwal" class="btn btn-default">Export Ms. Excel</a>');

    $(".dataTables_length, #table-data_info").css({
      'display': 'none'
    });

    $("#table-data_wrapper > .row:last > .col-sm-5").remove();
    $("#table-data_wrapper > .row:last > .col-sm-7").attr({
      'class': 'col-sm-12'
    });

    $(".dataTables_filter").css({
      'float': 'right'
    });
    $("footer").css({
      'bottom': '0px'
    });
  });
</script>
<div class="col-md-12">
  <!-- <hr>
  <h4>Lihat Absensi Bulan</h4>
  <div class="row justify-content-start">
    <div class="col-md-4">
      <?php
      echo open_form('', 'post', "class='form-group'");

      echo select_open('bulan', "class='form-control'");
      echo option('', '', '-- Pilih Bulan --');
      echo option("1", '', 'Januari');
      echo option('2', '', 'Fevruari');
      echo option('3', '', 'Maret');
      echo option('4', '', 'April');
      echo option('5', '', 'Mei');
      echo option('6', '', 'Juni');
      echo option('7', '', 'Juli');
      echo option('8', '', 'Agustus');
      echo option('9', '', 'September');
      echo option('10', '', 'Oktober');
      echo option('11', '', 'November');
      echo option('12', '', 'Desember');

      echo select_close() . "<br>";
      ?>
    </div>
    <div class="col-md-4">
      <?php
      echo input('submit', 'submit', "class='btn btn-primary' value='Lihat'") . " &nbsp; ";
      echo input('button', 'button', "class='btn btn-default' id='back' value='Kembali'");
      ?>
    </div>
  </div> -->
  <script type="text/javascript">
    $("#back").click(function() {
      window.location = '<?= base("siswa/"); ?>';
    });
  </script>
  <?php

  if (isset($_POST['submit'])) {
    $bulan  = anti_inject($_POST['bulan']);
    $nis = @$_SESSION['siswa']['nis'];
    $data  = "SELECT `tbl_absensi`.`jam_msk`,`tbl_absensi`.`hari`, `tbl_absensi`.`tanggal`, `tbl_absensi`.`jam_plg`, `tbl_siswa`.`nama` FROM `tbl_absensi` ";
    $data .= " JOIN `tbl_siswa` ON `tbl_absensi`.`idg` = `tbl_siswa`.`nis`";
    $data .= " WHERE `idg` = '$nis' AND `tbl_absensi`.`tanggal` BETWEEN '2021-$bulan-1' AND '2021-$bulan-30'";
    $exc = mysqli_query($link, $data);
  } elseif (!isset($_POST['submit']) || $_POST['submit'] == 0) {
    $nis = @$_SESSION['siswa']['nis'];
    $data  = "SELECT `tbl_absensi`.`jam_msk`,`tbl_absensi`.`hari`, `tbl_absensi`.`tanggal`, `tbl_absensi`.`jam_plg`, `tbl_siswa`.`nama` FROM `tbl_absensi` ";
    $data .= " JOIN `tbl_siswa` ON `tbl_absensi`.`idg` = `tbl_siswa`.`nis`";
    $data .= " WHERE `idg` = '$nis' ORDER BY `jam_msk` DESC ";

    $exc = mysqli_query($link, $data);

    error_reporting(0);
  }

  ?>

  <p><?php if ($bulan) {
        echo ("Data Absensi Bulan Ke - " . $bulan);
      } ?></p>

  <table class="table table-bordered" id="list-data">
    <thead>
      <tr>
        <th>No.</th>
        <th>Hari</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
      </tr>
    </thead>
    <tbody>

      <?php while ($g = mysqli_fetch_object($exc)) : ?>

        <tr>
          <td><?= $no++; ?></td>
          <td><?= $g->hari; ?></td>
          <td><?= $g->tanggal; ?></td>
          <td><?= $g->jam_msk; ?></td>
          <td><?= $g->jam_plg; ?></td>
        </tr>

      <?php endwhile; ?>

    </tbody>
  </table>
</div>