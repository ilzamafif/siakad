<?php
include_once '../function/core.php';
if (isset($_SESSION['siswa']['email']) && isset($_SESSION['siswa']['pass']) && isset($_SESSION['token'])) {
  redirect(base('siswa/dashboard'));
} else {
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Siswa</title>
  </head>
  <link rel="stylesheet" href="<?= base('assets/css/guru.css'); ?>" media="screen" title="no title">
  <link rel="stylesheet" href="<?= base('assets/css/bootstrap.css'); ?>" media="screen" title="no title">
  <link rel="stylesheet" href="<?= base('assets/css/sweetalert.css'); ?>" media="screen" title="no title">
  <link rel="stylesheet" href="<?= base('assets/css/animate.css'); ?>" media="screen" title="no title">
  <link rel="stylesheet" href="<?= base('assets/dataTables/css/dataTables.bootstrap.css'); ?>" media="screen" title="no title">
  <link rel="shrotcut icon" href="<?= base('images/favicon.png'); ?>">
  <script type="text/javascript" src="<?= base('assets/js/jquery.js'); ?>"></script>
  <script type="text/javascript" src="<?= base('assets/js/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?= base('assets/js/sweetalert.min.js'); ?>"></script>
  <script type="text/javascript" src="<?= base('assets/dataTables/js/jquery.dataTables.min.js'); ?>"></script>
  <script type="text/javascript" src="<?= base('assets/dataTables/js/dataTables.bootstrap.js'); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var lost  = $("#lost");
      var modal = $("#lost-password");
      var error = $(".error");

      lost.click(function(){
        var email = $("#email").val();
        var nama    = $("#nama").val();
        var button  = $("button.confirm");

        if(email == "" || nama == ""){
          //sweetAlert('Oops!', 'Form harus diisi!', 'error');
          error.append("<div class='alert alert-danger'><strong>Oops!...</strong> Form tidak boleh ada yang kosong...</div>");
          $(".alert").fadeOut(3000);
        } else {

          //Make Ajax processing
          $.ajax({
            method  : "POST",
            url     : "lost-pass.php",
            cache   : false,
            data    : {
              email   : email,
              nama_guru : nama
            },
            success : function(result){
              if (result == "1") {
                // swal('Yosh!', 'Permintaan reset password sudah terkirim!', 'success');
                // button.on("click", function(){
                //   window.location='dashboard';
                // });
                error.append("<div class='alert alert-success'><strong>Yosh!...</strong> Permintaan reset password sudah terkirim!</div>");
                $(".alert").fadeOut(3000);
                $("#email").val('');
                $("#nama").val('');
              } else {
                error.append("<div class='alert alert-danger'><strong>Oops!...</strong> Akun tidak ditemukan di dalam sistem...</div>");
                $(".alert").fadeOut(3000);
              }
            }
          });
        }
      });

      //$("#login-box").hide();
    });

    function load(){
      $(".login").addClass('animated flipInX');
    }

    function maxChars(el, max){
      if (el.value.length > el.maxLength) {
        el.value = el.value.slice(0, el.maxLength);
      }
    }
  </script>
  <body onload="load();" style="background-size: cover;">

    <div class="container">
      <div id="login-box" class="login">
        <div class="box-heading">
          Halaman Login Siswa
        </div>
        <div class="box-content">
          <?php
            echo open_form('', 'post', "class='form-group'");
            echo input('email', 'email', "class='form-control' placeholder='Email' autofocus oninput='maxChars(this, 5) min='00000'")."<br>";
            echo input('password', 'password', "class='form-control' placeholder='Password'")."<br>";
            echo input('submit', 'submit', "class='btn btn-primary form-control' value='Login'")."<br>";
            echo close_form();
          ?>
          <p>
            <a href="#" data-toggle="modal" data-target="#lost-password">Saya Lupa Password </a>
          </p>
        </div>
      </div>
    </div>
    <div class="modal fade" id="lost-password" tabindex="-1" role="dialog" aria-labelledby="lost-password">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="lost-password">
              Lupa Password ?
            </h4>
          </div>
          <?php //echo open_form('', 'post', "class='form-group' id='form-lost'"); ?>
          <div class="modal-body">
            <?php
              echo "<div class='error'></div>";
              echo label('id', "Email");
              echo input('email', "email", "class='form-control' id='email'")."<br>";

              echo label('nama', "Atas Nama");
              echo input('nama', "nama", "class='form-control' id='nama'")."<br>";

            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" name="lost" class="btn btn-primary" id="lost">Kirim</button>
          </div>
          <?php //echo close_form(); ?>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
if (isset($_POST['submit'])) {
  $email   = anti_inject($_POST['email']);
  $password   = anti_inject($_POST['password']);

  if (empty(trim($email)) || empty(trim($password))) {
    echo "<script>sweetAlert('Oops!', 'Kolom Email dan Password harus diisi!', 'error');</script>";
    echo notice(0);
  } else {

    $cekSiswa = cekSiswa($email);
    $ceknow   = mysqli_num_rows($cekSiswa);

    if ($ceknow != 0) {
      $data = mysqli_fetch_object($cekSiswa);

      //Checking password match
      $cekpass = password_verify($password, $data->password);

      if ($cekpass === TRUE) {
        $smstr  = select('*', 'tbl_semester', "id=1 LIMIT 1");
        $sms    = mysqli_fetch_object($smstr);
        $token                       = md5(sha1($data->email));
        @$_SESSION['token_siswa']          = $token;
        @$_SESSION['semester']       = $sms->semester;
        @$_SESSION['thn_ajaran']     = $sms->tahun_ajaran;
        @$_SESSION['siswa']['pass']   = $data->password;
        @$_SESSION['siswa']['email']  = $data->email;
        @$_SESSION['siswa']['nama']   = $data->nama;
        @$_SESSION['siswa']['id']     = $data->id;
        @$_SESSION['siswa']['nis']    = $data->nis;

        redirect('dashboard');

      } else {
        echo "<script>sweetAlert('Oops!', 'Email atau Password tidak cocok!', 'error');</script>";
        echo notice(0);
      }

    } else {
        echo "<script>sweetAlert('Oops!', 'Email atau Password salah!', 'error');</script>";
        echo notice(0);
    }
  }

}
}
?>
