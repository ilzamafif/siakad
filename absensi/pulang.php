<?php
require_once '../function/core.php';
require_once '../templates/header.php';


?>
<style media="screen">
	body{
		background-image: url('../images/pattern.png');
	}
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
	.panel,	#sidebar{
		border:none !important;
		box-shadow: 1px 1px 3px #333 !important;
		background-color: #efefef !important;
	}
	thead{
		background: #0BF !important;
	}

	.panel > .panel-heading, .navbar-default{
		background: #0BF !important;
	}
	.navbar-default{
		border-color: #428bca !important;
		color: #fff;
	}

	.navbar-header a{
		color: #fff !important;
	}

	.nav > li > a{
		color: #fff !important;
	}

	.nav > .active > a{
		color:#000 !important;
	}

	#sidebar{
		min-height:540px;
		padding:10px;
		border:1px solid #428bca;
		background: #f5f5f5;
	}


</style>
<div class="container"  style="padding-top:70px !important;">
	<div class="row">
		<div class="col-md-4" id="sidebar">
			<?php include_once 'data-pulang.php'; ?>
		</div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Absen Pulang Siswa
				</div>
				<div class="panel-body" style="max-height:550px;">
					<form class="form form-group-lg" action="" method="post">
						<div class="col-sm-10">
							<input type="number" oninput="maxChars(this, 5)" maxlength="5" class="form-control" id="inp-nis"  min="00000" max="99999" name="nis" placeholder="Masukkan NIS Anda disini" autofocus>
						</div>
						<div class="col-sm-2">
							<input type="submit" class="btn btn-lg btn-default" name="submit" value="Cek" style="padding-left:35px;padding-right:35px;">
						</div>
					</form>
					<div class="col-md-12">

<?php
if (isset($_POST['submit'])) {
	global $link;
	$nis = anti_inject($_POST['nis']);

	if (empty(trim($nis))) {
		echo "<script>sweetAlert('Oops!', 'NIS harus diisi!', 'error');</script>";
		echo "<audio autoplay><source src='".base('music/error2.wav')."'></audio>";
	} else {
		$sql = "SELECT * FROM tbl_siswa WHERE nis = '$nis' ";
		$exc = mysqli_query($link, $sql);
		$cek = mysqli_num_rows($exc);
		$hari = date('w');
		$hariini = hari($hari);
		$tglskrg = date('Y-m-d');

		if ($cek != 0) {

			$data = mysqli_fetch_array($exc);
			
			$idg	= $data['nis'];

			$sqlnow = "SELECT * FROM tbl_absensi WHERE idg = '$idg' AND tanggal = '$tglskrg' ";
			$excnow = mysqli_query($link, $sqlnow);
			$ceknow = mysqli_num_rows($excnow);

			if ($ceknow == 0 ) {
				echo "<script>sweetAlert('Oops!', 'Anda belum mengisi absen masuk! Absensi tidak bisa dilakukan!', 'error');</script>";
				echo "<audio autoplay><source src='".base('music/error2.wav')."'></audio>";
			} else {

				$jam_plg = date('H:i:s');
				$hariini = addslashes($hariini);
				$sqlupd = "UPDATE tbl_absensi SET jam_plg = '$jam_plg' WHERE idg = '$idg' AND tanggal = '$tanggal'";

				$excupd = mysqli_query($link, $sqlupd);

				if ($excupd === TRUE) {

					$sqlshow = "SELECT * FROM tbl_absensi JOIN tbl_siswa ON tbl_absensi.idg = tbl_siswa.nis WHERE tanggal = '$tglskrg' AND idg = '$idg'";
					$excshow = mysqli_query($link, $sqlshow);
					$show = mysqli_fetch_array($excshow); ?>

					<script type="text/javascript">
						$(function(){
							$("#detail").fadeOut(6000);

							$("#sidebar").load("data-pulang.php");
						});
					</script>

					<br> <br>
					<div id="detail">
						<div class="col-md-6">
							<table class="table">
								<tr>
									<th colspan="3">Hi <?php echo $show['nama']; ?>!, Terima Kasih telah hadir hari ini <span class="glyphicon glyphicon-smile-o"></span></th>
								</tr>
								<tr>
									<td>Nama Guru</td>
									<td>:</td>
									<td><?php echo $show['nama']; ?></td>
								</tr>
								<tr>
									<td>NIS</td>
									<td>:</td>
									<td><?php echo $show['nis']; ?></td>
								</tr>
								<tr>
									<th colspan="4">Masuk pada</th>
								</tr>
								<tr>
									<td>Hari</td>
									<td>:</td>
									<td><?php echo $show['hari']; ?></td>
								</tr>
								<tr>
									<td>Tanggal</td>
									<td>:</td>
									<td><?php echo $show['tanggal']; ?></td>
								</tr>
								<tr>
									<td>Jam</td>
									<td>:</td>
									<td><?php echo $show['jam_msk']; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<img src="../images/guru/<?= $show['id_card']; ?>.jpg" width="265px" alt="" />
						</div>
					</div> <!-- end of id detail -->

<?php			} else {
					echo "<script>sweetAlert('Oops!', 'Gagal mengisi absen pulang!', 'error');</script>";
					echo "<audio autoplay><source src='".base('music/error2.wav')."'></audio>";
				}

			}

		} else {
			echo "<script>sweetAlert('Oops!', 'Nomor NIS tidak terdaftar di database!', 'error');</script>";
			echo "<audio autoplay><source src='".base('music/error2.wav')."'></audio>";
		}
	}
}
?>
						</div>
					</div> <!-- end of class panel-body -->
				</div> <!-- end of class panel -->
			</div> <!-- end of class col-md-8 -->
		</div> <!-- end of class row -->
</div> <!-- end of class container -->
<?php
require_once '../templates/footer.php';
?>
