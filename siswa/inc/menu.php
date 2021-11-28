<?php
$page = @$_GET['page'];
$clsnm = substr($k->nama_kelas, 0,2);
$cekwali = $cekyo;
?>
<script type='text/javascript'>
  $(function(){
    $("#list-of-data").hide();
    $("#list-nilai").hide();
    $(".xyz").click(function(){
      $("#list-of-data").slideToggle('slow');
      $("#list-nilai").slideUp(1000);
    });
    $(".click-nilai").click(function(){
      $("#list-nilai").slideToggle("slow");
      $("#list-of-data").slideUp(1000);
    });
  });
</script>
<ul class="nav nav-pills nav-stacked">
  <li role="presentation" class="active">
    <a href="<?= base('siswa/dashboard'); ?>"><span class="glyphicon glyphicon-dashboard"></span>&nbsp; Dashboard</a>
  </li>
  <li role="presentation" id="parent-data">
    <a href="#" class="xyz"><span class="glyphicon glyphicon-calendar"></span>&nbsp; Master Data &nbsp;<span class="caret"></span></a>
    <ul class="nav nav-pills nav-stacked" id="list-of-data">
      <li role="presentation" class="data-jadwal">
        <a href="<?= base('siswa/data-jadwal');?>"><span class="glyphicon glyphicon-calendar"></span>&nbsp; Data Jadwal</a>
      </li>
      <?php if ($cekwali != 0) { ?>
      <li role="presentation" class="data-siswa">
        <a href="<?= base('siswa/data-siswa');?>"><span class="glyphicon glyphicon-user"></span>&nbsp; Data Siswa</a>
      </li>
      <?php } else { ?>
      <li role="presentation" class="data-kelas">
        <a href="<?= base('siswa/data-kelas');?>"><span class="glyphicon glyphicon-home"></span>&nbsp; Data Kelas</a>
       </li>
       <?php } ?>
      <li role="presentation" class="data-kehadiran">
         <a href="<?= base('siswa/data-kehadiran');?>"><span class="glyphicon glyphicon-signal"></span>&nbsp; Data Kehadiran</a>
      </li>
    </ul>
  </li>
  <li role="presentation" id="nilai">
    <a href="#" class="click-nilai"><span class="glyphicon glyphicon-file"></span>&nbsp; Nilai &nbsp; <span class="caret"></span></a>
    <ul class="nav nav-pills nav-stacked" id="list-nilai">
      <?php if($file == "index.php") { ?>

      <li class="active"><a href="<?= base('harian/absen-masuk'); ?>">Absen Masuk</a></li>
      <li><a href="<?= base('harian/absen-pulang'); ?>">Absen Pulang</a></li>

      <?php } else if($file == "pulang.php") { ?>

      <li><a href="<?= base('harian/absen-masuk'); ?>">Absen Masuk</a></li>
      <li  class="active"><a href="<?= base('harian/absen-pulang'); ?>">Absen Pulang</a></li>

      <?php } ?>
    </ul>
  </li>
  <li role="presentation" style="height: 600px;background: #eee;">&nbsp;</li>
</ul>