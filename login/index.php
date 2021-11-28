<?php
include_once '../function/core.php';

if (isset($_SESSION['login']['user']) && isset($_SESSION['login']['pass'])) {
  redirect('dashboard');
}

$sqltp = select("*", "tbl_semester LIMIT 1");
$tp = mysqli_fetch_object($sqltp);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <link rel="stylesheet" href="<?= base('assets/css/admin.css'); ?>" media="screen" title="no title">
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
    $(document).ready(function() {
      $(".panel-login").addClass('animated bounceInDown');
    });
  </script>
  <body>

    <div class="container">
      <div class="col-md-4 col-md-offset-4 login" id="box-login" style="padding-bottom:none !important;">
        <div class="panel panel-default panel-login" style="padding-bottom:0px !important;border:none !important;box-shadow:1px 2px 9px #333;border-radius: 5px !important;">
          <div class="panel-heading" style="border-top-right-radius: 5px;border-top-left-radius: 5px;border-bottom: 5px solid rgba(52, 129, 219, 0.83);">
            Login 
          </div> <!-- end of class panel heading -->
          <div class="panel-body">
            <form class="form-group" action="" method="post">
              <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" autofocus>
              <br>

              <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
              <br>

              <select class="form-control" name="level">
                <option value="">-- Select Level --</option>
                <option value="1">Guru</option>
                <option value="2">Siswa</option>
                <option value="3">Waka</option>
              </select>
              <br>
              <input type="submit" name="submit" class="btn btn-primary form-control" value="Log In">
            </form>
          </div> <!-- end of panel body -->
        </div> <!-- end of class panel -->
        <div class="footer" style="border:none;background: none !important;color:#fff;">
          Copyright &copy; <?= date('Y'); ?> :: SMK Gobaksodor Interactive
        </div>
      </div> <!-- end of class col md 4 -->
    </div> <!-- end of clas container -->

  </body>
</html>

<?php
if (isset($_POST['submit'])) {
  $username   = anti_inject($_POST['username']);
  $password   = anti_inject($_POST['password']);
  $level      = anti_inject($_POST['level']);

  if (empty(trim($username)) || empty(trim($password))) {
    echo "<script>sweetAlert('Oops!', 'Kolom Username dan Password harus diisi!', 'error');</script>";
    echo notice(0);
  } else {
    if (empty($level)) {
      echo "<script>sweetAlert('Oops!', 'Pilih level terlebih dahulu!', 'error');</script>";
      echo notice(0);
    } else {
      
     if($level = 1){
      $cekuname = cekuname($username);
      $ceknow   = mysqli_num_rows($cekuname);
     }

    }
  }

}

?>