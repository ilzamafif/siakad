<?php
include_once '../function/core.php';

$tanggal = date('Y-m-d');

$no = 1;
$sql  = "SELECT `tbl_absensi`.`jam_plg`, `tbl_siswa`.`nama` FROM `tbl_absensi` ";
$sql .= " JOIN `tbl_siswa` ON `tbl_absensi`.`idg` = `tbl_siswa`.`nis`";
$sql .= " WHERE `tanggal` = '$tanggal' ORDER BY `jam_plg` DESC ";
$exc = mysqli_query($link, $sql);

?>
<link rel="stylesheet" href="<?= base('assets/css/bootstrap.css'); ?>" media="screen" title="no title">
<link rel="stylesheet" href="<?= base('assets/css/sweetalert.css'); ?>" media="screen" title="no title">
<link rel="stylesheet" href="<?= base('assets/dataTables/css/dataTables.bootstrap.css'); ?>" media="screen" title="no title">
<script type="text/javascript" src="<?= base('assets/dataTables/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base('assets/dataTables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#table-data").DataTable();

		$(".dataTables_length, #table-data_info").css({'display':'none'});

		$("#table-data_wrapper > .row:last > .col-sm-5").remove();
		$("#table-data_wrapper > .row:last > .col-sm-7").attr({
			'class':'col-sm-12'
		});

		$("#table-data_filter").css({
			'color':'#fff'
		})

		$(".dataTables_filter").css({'float':'right'});
		$("footer").css({'bottom':'0px'});
		$("#table-data_filter > label").css({'color':'#000'});
	});
</script>

<table class="table table-bordered" id="table-data" style="background:#fff;">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Siswa</th>
      <th>Jam Pulang</th>
    </tr>
  </thead>
  <tbody>

    <?php while ($g = mysqli_fetch_array($exc)) {

			if ($g['jam_plg'] == NULL) {
				echo "";
			}else {
		?>

    <tr>
      <td><?= $no++; ?></td>
      <td><?= $g['nama']; ?></td>
      <td><?= $g['jam_plg']; ?></td>
    </tr>

    <?php }
		}
		?>

  </tbody>
</table>
