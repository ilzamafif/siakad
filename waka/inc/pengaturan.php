<?php
$no = 1;

$id = @$_SESSION['waka']['id'];
$waka_id = select("*", "tbl_waka", "id=$id");
$ad  = mysqli_fetch_assoc($waka_id);

$rt = select("*", "tbl_info", "id=1 LIMIT 1");
$run = mysqli_fetch_assoc($rt);

$smster = select('*', "tbl_semester", "id=1 LIMIT 1");
$sms = mysqli_fetch_assoc($smster);

$sqlps = select("*", "profil_sekolah", "id=1 LIMIT 1");
$ps = mysqli_fetch_object($sqlps);
?>

<?php if(!empty(@$id)){ ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#semester").attr({
        'class':'tab-pane active'
      });
      $(".nav-tabs > li:first").attr({
        'class':'active'
      });
    });
  </script>
<?php } ?>

<div class="col-md-12">
  <div class="tablet">
    <ul class="nav nav-tabs" role="tablist">
    <li role="presentation">
      <a href="#profil-sekolah" aria-controls="profil-sekolah" role="tab" data-toggle="tab">Profil Sekolah</a>
    </li>
    <li role="presentation">
      <a href="#semester" aria-controls="semester" role="tab" data-toggle="tab">Ubah Semester</a>
    </li>
      <li role="presentation">
        <a href="#change" aria-controls="change" role="tab" data-toggle="tab">Ubah Password</a>
      </li>
      <li role="presentation">
        <a href="#running" aria-controls="running" role="tab" data-toggle="tab">Running Text</a>
      </li>
    </ul>

    <div class="tab-content">
    <div class="tab-pane" role="tabpanel" id="profil-sekolah">
      <b>Profil Sekolah</b>
      <br>
      <br>
      <table class="table table-hover">
        <tr>
          <td>Nama Sekolah</td>
          <td>:</td>
          <td><?= $ps->nama_sekolah; ?></td>
        </tr>
        <tr>
          <td>NPSN</td>
          <td>:</td>
          <td><?= $ps->npsn; ?></td>
        </tr>
        <tr>
          <td>NIS/NSS/NDS</td>
          <td>:</td>
          <td><?= $ps->nis; ?></td>
        </tr>
        <tr>
          <td>Alamat Sekolah</td>
          <td>:</td>
          <td><?= $ps->alamat; ?></td>
        </tr>
        <tr>
          <td>Kelurahan</td>
          <td>:</td>
          <td><?= $ps->kelurahan; ?></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td>:</td>
          <td><?= $ps->kecamatan; ?></td>
        </tr>
        <tr>
          <td>Kota/Kabupaten</td>
          <td>:</td>
          <td><?= $ps->kota_kab; ?></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td>:</td>
          <td><?= $ps->provinsi; ?></td>
        </tr>
        <tr>
          <td>Website</td>
          <td>:</td>
          <td><a href="<?= $ps->website; ?>" target="_blank" class="btn-link"><?= $ps->website; ?></a></td>
        </tr>
        <tr>
          <td>E-mail</td>
          <td>:</td>
          <td><?= $ps->email; ?></td>
        </tr>
      </table>
      <button type="button" class="btn btn-default" data-toggle="modal"  data-target="#edit-sekolah">Edit</button>
    </div>
    <div class="tab-pane" role="tabpanel" id="semester">
      <form class="form-group" action="" method="post">
        <label for="semeseter">Pilih Semester :</label>

        <?php if ($sms['semester'] == "Ganjil") { ?>

        <div class="radio">
          <label>
            <input type="radio" name="semester" value="Ganjil" checked> Ganjil
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="semester" value="Genap"> Genap
          </label>
        </div>

        <?php } else { ?>

          <div class="radio">
            <label>
              <input type="radio" name="semester" value="Ganjil"> Ganjil
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="semester" value="Genap" checked> Genap
            </label>
          </div>

          <?php } ?>

        <br>

        <label for="tahun_ajaran">Tahun Pelajaran</label>
        <input type="text" name="tahun_ajaran" class="form-control" value="<?= $sms['tahun_ajaran']; ?>" placeholder="contoh : 2021/2022">
        <br>

        <input type="submit" name="sub_semester" class="btn btn-primary" value="Simpan">
      </form>
    </div>
      <div class="tab-pane" role="tabpanel" id="change">
        <h4>Ubah Password</h4>
        <hr>
        <form class="form-group" action="" method="post">
          <label for="username">Username</label>
          <input type="text" name="username" value="<?= $ad['username']; ?>" class="form-control" disabled>
          <br>

          <label for="old_pass">Password Lama</label>
          <input type="password" name="old_pass" value="" class="form-control">
          <br>

          <label for="new_pass">Password Baru</label>
          <input type="password" name="new_pass" value="" class="form-control">
          <br>

          <label for="pass_conf">Konfirmasi Password</label>
          <input type="password" name="pass_conf" value="" class="form-control">
          <br>

          <input type="submit" name="submit" value="Simpan" class="btn btn-default">
        </form>
      </div>
      <div class="tab-pane" role="tabpanel" id="running">
        <form class="form-group" action="" method="post">
          <label for="running">Running Text</label>
          <textarea name="isi" class="form-control"><?= $run['isi']; ?></textarea>
          <br>

          <input type="submit" name="simpan_rt" value="Simpan" class="btn btn-default">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-sekolah" tabindex="-1" role="dialog" aria-labelledby="add-adminlabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="edit-sekolah">Edit Sekolah</h4>
      </div> <!-- end of modal header -->
      <div class="modal-body">
        <?php 
         echo open_form('proses-edit-sekolah', 'post', "class='form-group'"); 
        ?>
        <div class="container-fluid">
          <div class="col-md-6">
          <?php
             echo label('nama_sekolah', 'Nama Sekolah');
             echo input('text', 'nama_sekolah', "class='form-control' value='$ps->nama_sekolah'")."<br>";

             echo label('npsn', 'NPSN');
             echo input('number', 'npsn', "class='form-control' value='$ps->npsn'")."</br>";

             echo label('nis', 'NIS/NSS/NDS');
             echo input('number', 'nis', "class='form-control' value='$ps->nis'")."</br>";

             echo label('alamat', 'Alamat');
             echo text('alamat', "class='form-control'", $ps->alamat)."</br>";

             echo label('kelurahan', 'Kelurahan');
             echo input('text', 'kelurahan', "class='form-control' value='$ps->kelurahan'")."</br>";
          ?>            
          </div>
          <div class="col-md-6">
          <?php
             echo label('kecamatan', 'Kecamatan');
             echo input('text', 'kecamatan', "class='form-control' value='$ps->kecamatan'")."</br>";

             echo label('kota', 'Kota/Kabupaten');
             echo input('text', 'kota_kab', "class='form-control' value='$ps->kota_kab'")."</br>";

             echo label('provinsi', 'Provinsi');
             echo input('text', 'provinsi', "class='form-control' value='$ps->provinsi'")."</br>";

             echo label('website', 'Website');
             echo input('text', 'website', "class='form-control' value='$ps->website'")."</br>";

             echo label('email', 'E-mail');
             echo input('email', 'email', "class='form-control' value='$ps->email'")."</br>";
          ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <?= close_form(); ?>
      </div> <!-- end of modal footer -->
    </div> <!-- end of modal -content -->
  </div>
</div>

<?php

if (isset($_POST['simpan_rt'])) {
  $isi = anti_inject($_POST['isi']);

  if (empty(trim($isi))) {
    echo "<script>sweetAlert('Oops!', 'Form running text tidak boleh kosong!', 'error');</script>";
    echo notice(0);
  } else {
    if (update("tbl_info", "isi = '$isi'", "id = '1'")) {
      echo "<script>swal('Yosh!', 'Running Text berhasil di ganti!', 'success');</script>";
      echo notice(1);
      echo location('pengaturan');
    } else {
      echo "<script>sweetAlert('Oops!', 'Running Text gagal diperbarui!', 'error');</script>";
      echo notice(0);
      echo location('pengaturan');
    }
  }
}

if (isset($_POST['submit'])) {
  $old_pass = anti_inject($_POST['old_pass']);
  $new_pass = anti_inject($_POST['new_pass']);
  $pass_conf = anti_inject($_POST['pass_conf']);

  if (empty(trim($old_pass)) || empty(trim($new_pass)) || empty(trim($pass_conf))) {
    echo "<script>sweetAlert('Oops!', 'Form password tidak boleh ada yang kosong!', 'error');</script>";
    echo notice(0);
  } else {

    $passdb = $ad['password'];

    $verify = password_verify($old_pass, $passdb);

    //Validasi kesamaan password lama dengan password yg diinputkan
    if ($verify === TRUE) {

      //Mebuat hashing password
      $newpass = password_hash($new_pass, PASSWORD_DEFAULT, ['cost'=>12]);

      //Cek kesamaan password baru dengan konfirmasi password
      $confpass = password_verify($pass_conf, $newpass);

      if ($confpass === TRUE) {

        $update = update('tbl_waka', "password = '$newpass'", "id = '$id'");

        if ($update === TRUE) {
          echo "<script>swal('Yosh!', 'Password berhasil diperbarui!', 'success');</script>";
          echo notice(1);
          echo location('pengaturan');
        } else {
          echo "<script>sweetAlert('Oops!', 'Password tidak sama! Gagal diperbarui!', 'error');</script>";
          echo notice(0);
        }

      } else {
        echo "
          <script>
            sweetAlert('Oops!', 'Password tidak sama!', 'error');
            $('button.confirm').click(function() {
              window.history.go(-1);
            });
          </script>";
        echo notice(0);
      }

    } else {
      echo "<script>sweetAlert('Oops!', 'Password lama tidak terdaftar!', 'error');</script>";
      echo notice(0);
    }

  }

}

if (isset($_POST['sub_semester'])) {
  $semester = anti_inject($_POST['semester']);
  $tahun_ajaran = anti_inject($_POST['tahun_ajaran']);

  if (empty(trim($tahun_ajaran))) {
    echo "
      <script>
        sweetAlert('Oops!', 'Tahun ajaran harus diisi!', 'error');
        $('button.confirm').click(function() {
          window.history.go(-1);
        });
      </script>";
    echo notice(0);
  } else {

    $upd_sms = update('tbl_semester', "semester = '$semester', tahun_ajaran = '$tahun_ajaran'", "id='1'");

    if ($upd_sms === TRUE) {
      echo "<script>swal('Yosh!', 'Semester dan Tahun Ajaran berhasil diperbarui!', 'success');</script>";
      echo notice(1);
      echo location('pengaturan');
    } else {
      echo "<script>sweetAlert('Oops!', 'Semester dan Tahun Ajaran Gagal diperbarui!', 'error');</script>";
      echo notice(0);
    }

  }
}
?>
