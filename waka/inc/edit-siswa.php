<?php
$id = anti_inject(@$_GET['id']);
$id = abs((int) $id);
$sqlrom = select('*', 'tbl_kelas');
$sis = select('*', 'tbl_siswa', "id = '$id'");
$s = mysqli_fetch_object($sis);
?>

<style media="screen">
  .col-md-6{
    padding-bottom: 30px;
  }
</style>
<div class="col-md-12">
  <h3>Edit Data Siswa</h3>
  <hr>
  <div class="col-md-6">
    <?php
      echo open_form('', 'post', "class='form-group' enctype='multipart/form-data'");
      echo label('nama', 'Nama Siswa');
      echo input('text', 'nama', "class='form-control' value='$s->nama'")."<br>";

      echo label('nisn', 'Nomor Induk Siswa Nasional');
      echo input('number', 'nisn', "class='form-control' value='$s->nisn'")."<br>";

      echo label('nis', 'Nomor Induk Siswa');
      echo input('number', 'nis', "class='form-control' value='$s->nis'")."<br>";
      
      echo label('email', 'Email');
      echo input('text', 'email', "class='form-control' value='$s->email'")."<br>";
      
      echo label('nomer_telp', 'Nomer Telepon');
      echo input('number', 'nomer_telp', "class='form-control' value='$s->nomer_telp'")."<br>";

      echo label('alamat_lengkap', 'Alamat Lengkap');
      echo input('text', 'alamat_lengkap', "class='form-control' value='$s->alamat_lengkap'")."<br>";

      echo label('kelas', 'Kelas');
      ?>
      <select class="form-control" name="kelas">
        <option value="">-- Pilih Kelas --</option>

        <?php if($s->kelas == "10") { ?>
          <option value="10" selected>X</option>
          <option value="11">XI</option>
          <option value="12">XII</option>
        <?php } else if($s->kelas == "11") {  ?>
          <option value="10">X</option>
          <option value="11" selected>XI</option>
          <option value="12">XII</option>
        <?php } else { ?>
          <option value="10">X</option>
          <option value="11">XI</option>
          <option value="12" selected>XII</option>
        <?php } ?>

      </select>
    </div> <!-- end of class col-md-6 -->
    <div class="col-md-6">
      <?php
      echo label('rombel', 'Anggota Rombel');
      echo "
        <select name='rombel' class='form-control'>
          <option value=''>-- Pilih Rombongan Belajar --</option>";
          while ($rom = mysqli_fetch_object($sqlrom)) :

            if ($rom->nama_kelas == $s->rombel) {
                echo "<option value='$rom->nama_kelas' selected>$rom->nama_kelas</option>";
            } else {
                echo "<option value='$rom->nama_kelas'>$rom->nama_kelas</option>";
            }
          endwhile;
      echo "</select> <br>";

      echo label('jk', 'Jenis Kelamin');
      echo "
        <select name='jk' class='form-control'>
          <option value=''>-- Pilih Jenis Kelamin --</option>";
          if ($s->jk == "L") {
            echo "
              <option value='L' selected>Laki-Laki</option>
              <option value='P'>Perempuan</option>";
          } else {
            echo "
              <option value='L'>Laki-Laki</option>
              <option value='P' selected>Perempuan</option>";
          }
      echo "</select> <br>";

      echo label('tempat', 'Tempat Lahir');
      echo input('text', 'tempat', "class='form-control' value='$s->tempat'")."<br>";
      
      echo label('tanggal_lahir', 'Tanggal Lahir');
      echo input('date', 'tanggal_lahir', "class='form-control' value='$s->tanggal_lahir'")."<br>";

      echo label('foto', 'Foto');
      echo input('file', 'foto', "class='form-control'")." <br> <br>";

      echo input('submit', 'submit', "class='btn btn-primary' value='Simpan'")." &nbsp; ";
      echo input('button', 'back', "class='btn btn-default' id='back' value='Kembali'");

      echo close_form();
      ?>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#back").click(function() {
      window.location='<?= base("waka/siswa");?>';
    });
  });
</script>

<?php

if (isset($_POST['submit'])) {
  $nama   = addslashes($_POST['nama']);
  $nisn   = anti_inject($_POST['nisn']);
  $nis    = anti_inject($_POST['nis']);
  $kelas  = anti_inject($_POST['kelas']);
  $rombel = anti_inject($_POST['rombel']);
  $jk     = anti_inject($_POST['jk']);
  $alamat_lengkap = anti_inject($_POST['alamat_lengkap']);
  $email          = anti_inject($_POST['email']);
  $tempat         = anti_inject($_POST['tempat']);
  $nomer_telp     = anti_inject($_POST['nomer_telp']);
  $tanggal_lahir  = anti_inject($_POST['tanggal_lahir']);

  $source = $_FILES['foto']['tmp_name'];
  $target = "../images/siswa/";
  $namaft = $nis;

  if (empty(trim($nama)) || empty(trim($kelas)) || empty(trim($nama)) || empty(trim($rombel)) || 
      empty(trim($jk)) || empty(trim($alamat_lengkap)) || empty(trim($email)) || empty(trim($nomer_telp)) || empty(trim($tempat)) || empty(trim($tanggal_lahir))
      ) {
    echo "
    <script>
        sweetAlert('Oops!', 'Form tidak boleh ada yang kosong!', 'error');

        $('button.confirm').click(function() {
          window.history.go(-1);
        });
    </script>";
    echo notice(0);
  } else {

    move_uploaded_file($source, $target.$namaft);
    $update = update('tbl_siswa', "nama='$nama', nisn='$nisn', nis='$nis', kelas='$kelas', rombel='$rombel', jk='$jk', tempat='$tempat', tanggal_lahir='$tanggal_lahir', alamat_lengkap='$alamat_lengkap', email='$email', nomer_telp='$nomer_telp'", "id = '$id'");
    
    if ($update === TRUE) {
      echo "<script>swal('Yosh!', 'Data berhasil disimpan', 'success');</script>";
      echo notice(1);
      echo location(base('waka/siswa'));
    } else {
      echo "<script>sweetAlert('Oops!', 'Data siswa gagal disimpan!', 'error');</script>";
      echo location('window.history.go(-1)');
      echo notice(0);
    }

  }

}

?>
