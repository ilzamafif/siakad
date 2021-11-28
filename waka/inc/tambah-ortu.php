<?php
include_once '../function/core.php';

$id = anti_inject(@$_GET['id']);
$id = abs((int) $id);
?>

<style media="screen">
  .col-md-6{
    padding-bottom: 30px;
  }
</style>
<div class="col-md-12">
  <h3>Tambah Data Orang Tua Siswa</h3>
  <hr>
  <div class="col-md-6">
    <?php
      echo open_form('', 'post', "class='form-group'");

      echo label('nama_ayah', 'Nama Ayah');
      echo input('text', 'nama_ayah', "class='form-control'")."<br>";

      echo label('nama_ibu', 'Nama Ibu');
      echo input('text', 'nama_ibu', "class='form-control'")."<br>";

      echo label('tempat_lahir_ayah', 'Tempat Lahir Ayah');
      echo input('text', 'tempat_lahir_ayah', "class='form-control'")."<br>";

      echo label('tempat_lahir_ibu', 'Tempat Lahir ibu');
      echo input('text', 'tempat_lahir_ibu', "class='form-control'")."<br>";

      echo label('tanggal_lahir_ayah', 'Tanggal Lahir Ayah');
      echo input('date', 'tanggal_lahir_ayah', "class='form-control'")."<br>";

      echo label('tanggal_lahir_ibu', 'Tanggal Lahir Ibu');
      echo input('date', 'tanggal_lahir_ibu', "class='form-control'")."<br>";

      echo label('alamat_ayah', 'Alamat Ayah');
      echo input('text', 'alamat_ayah', "class='form-control'")."<br>";
      ?>
    </div> 
    <!-- end of class col-md-6 -->
    

    <div class="col-md-6">
      <?php
      echo label('pekerjaan_ibu', 'Pekerjaan Ayah');
      echo input('text', 'pekerjaan_ibu', "class='form-control'")."<br>";

      echo label('pekerjaan_ayah', 'Pekerjaan Ayah');
      echo input('text', 'pekerjaan_ayah', "class='form-control'")."<br>";

      echo label('pendidikan_ayah', 'Pendidikan Terakhir Ayah');
      echo input('text', 'pendidikan_ayah', "class='form-control'")."<br>";

      echo label('pendidikan_ibu', 'Pendidikan Terakhir ibu');
      echo input('text', 'pendidikan_ibu', "class='form-control'")."<br>";

      echo label('telp_ayah', 'No. Telp Ayah');
      echo input('text', 'telp_ayah', "class='form-control'")."<br>";

      echo label('telp_ibu', 'No. Telp Ibu');
      echo input('text', 'telp_ibu', "class='form-control'")."<br>";
      
      echo label('alamat_ibu', 'Alamat ibu');
      echo input('text', 'alamat_ibu', "class='form-control'")."<br>";
      
      echo input('submit', 'submit', "class='btn btn-primary' value='Tambahkan'")." &nbsp; ";
      echo input('button', 'back', "class='btn btn-default' id='back' value='Kembali'");
      
      echo close_form();
      ?>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#back").click(function() {
      window.location='siswa';
    });
  });
</script>

<?php

if (isset($_POST['submit'])) {
  $nama_ayah = anti_inject($_POST['nama_ayah']);
  $nama_ibu = anti_inject($_POST['nama_ibu']);
  $tempat_lahir_ayah = anti_inject($_POST['tempat_lahir_ayah']);
  $tempat_lahir_ibu = anti_inject($_POST['tempat_lahir_ibu']);
  $tanggal_lahir_ayah = anti_inject($_POST['tanggal_lahir_ayah']);
  $tanggal_lahir_ibu = anti_inject($_POST['tanggal_lahir_ibu']);
  $alamat_ayah = anti_inject($_POST['alamat_ayah']);
  $alamat_ibu = anti_inject($_POST['alamat_ibu']);
  $pendidikan_ayah = anti_inject($_POST['pendidikan_ayah']);
  $pendidikan_ibu = anti_inject($_POST['pendidikan_ibu']);
  $telp_ayah = anti_inject($_POST['telp_ayah']);
  $telp_ibu = anti_inject($_POST['telp_ibu']);
  $pekerjaan_ayah = anti_inject($_POST['pekerjaan_ayah']);
  $pekerjaan_ibu = anti_inject($_POST['pekerjaan_ibu']);

  if (empty(trim($nama_ayah)) || 
      empty(trim($nama_ibu)) || 
      empty(trim($tempat_lahir_ayah))|| 
      empty(trim($tempat_lahir_ibu)) || 
      empty(trim($tanggal_lahir_ayah))|| 
      empty(trim($tanggal_lahir_ibu)) || 
      empty(trim($alamat_ayah)) || 
      empty(trim($alamat_ibu)) ||
      empty(trim($pendidikan_ayah)) ||
      empty(trim($pendidikan_ibu)) ||
      empty(trim($telp_ayah)) ||
      empty(trim($telp_ibu)) ||
      empty(trim($pekerjaan_ayah)) ||
      empty(trim($pekerjaan_ibu))) {
    echo "
    <script>
        sweetAlert('Oops!', 'Form tidak boleh ada yang kosong!', 'error');

        $('button.confirm').click(function() {
          window.history.go(-1);
        });
    </script>";
    echo notice(0);
  } else {

    $insert =  insert('tbl_ortu_siswa','id, id_siswa, nama_ayah, nama_ibu, tempat_lahir_ayah, tempat_lahir_ibu, tanggal_lahir_ayah, tanggal_lahir_ibu, alamat_ayah, alamat_ibu, pendidikan_ayah, pendidikan_ibu, telp_ayah, telp_ibu, pekerjaan_ayah, pekerjaan_ibu', "NULL, '$id', '$nama_ayah', '$nama_ibu', '$tempat_lahir_ayah', '$tempat_lahir_ibu', '$tanggal_lahir_ayah', '$tanggal_lahir_ibu', '$alamat_ayah', '$alamat_ibu', '$pendidikan_ayah', '$pendidikan_ibu', '$telp_ayah', '$telp_ibu', '$pekerjaan_ayah', '$pekerjaan_ibu'");

    if ($insert === TRUE) {
        echo "<script>swal('Yosh!', 'Data berhasil disimpan', 'success');</script>";
        echo notice(1);
        echo location(base('admin/siswa'));
    } else {
      echo "
      <script>
          sweetAlert('Oops!', 'Tambah Data siswa baru gagal!', 'error');

          $('button.confirm').click(function() {
            window.history.go(-1);
          });
      </script>";
      echo notice(0);
    }

  }

}

?>
