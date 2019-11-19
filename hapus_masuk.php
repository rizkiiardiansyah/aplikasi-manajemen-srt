  
  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>
 <?php include('admin/head.php');?>
 
 <?php include('admin/sidebar.php');?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   <section class="content-header">
          <h1>
            Hapus Surat Masuk
            <small>Data Surat Masuk</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Masuk</li>
          </ol>
        </section>
<?php

    	$id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="surat_masuk.php";
                      </script>';
            } else {

              echo '
              <!-- Row form Start -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">';            
           if(isset($_SESSION['errQ'])){
              $errQ = $_SESSION['errQ'];
              echo '
              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fa fa-ban"></i>  
              '.$errQ.'
            </div>';
              unset($_SESSION['errQ']);
          }
          echo'
            <!-- general form elements -->
              <div class="box box-danger">
              <div class="box-body">
              <table class="table">
              <thead>
              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> Apakah Anda Yakin akan Menghapus Data ini ?</h4>
              
            </div>
              </div>   
              </div>
              </thead>
              <tbody>
              <tr>
              <td width="13%">No. Agenda</td>
              <td width="1%">:</td>
              <td width="86%">'.$row['no_agenda'].'</td>
          </tr>
          <td width="13%">Indeks Berkas</td>
          <td width="1%">:</td>
          <td width="86%">'.$row['indeks'].'</td>
          </tr>
          <tr>
          <td width="13%">No. Isi</td>
          <td width="1%">:</td>
          <td width="86%">'.$row['isi'].'</td>
          </tr>
          <tr>
              <td width="13%">File</td>
              <td width="1%">:</td>
              <td width="86%">';
              if(!empty($row['file'])){
                  echo ' <a class="blue-text" href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a>';
              } else {
                  echo ' Tidak ada file yang diupload';
              } echo '</td>
          </tr>
          <tr>
              <td width="13%">Asal Surat</td>
              <td width="1%">:</td>
              <td width="86%">'.$row['asal_surat'].'</td>
          </tr>
          <tr>
              <td width="13%">No. Surat</td>
              <td width="1%">:</td>
              <td width="86%">'.$row['no_surat'].'</td>
          </tr>
          <tr>
              <td width="13%">Tanggal Surat</td>
              <td width="1%">:</td>
              <td width="86%">'.$tgl = date('d M Y ', strtotime($row['tgl_surat'])).'</td>
          </tr>
          <tr>
              <td width="13%">Keterangan</td>
              <td width="1%">:</td>
              <td width="86%">'.$row['keterangan'].'</td>
          </tr>
      </tbody>
     </table>
  </div>
  <div class="box-footer">
  <a href="surat_masuk.php" class="btn btn-info">Batal</a>
  <a href="hapus_masuk.php?=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a>

  </div>

  </div><!-- /.box -->
  <!-- Row form END -->
  
                 
  </div>
            </div><!-- /.row -->
          </section><!-- /.content -->
          </div>
          
          <!-- /.row -->
          <!-- Row form END -->';?>
          <?php include("admin/footer.php");?>
          <?php include("admin/js.php");?>
<?php
if(isset($_REQUEST['submit'])){
$id_surat = $_REQUEST['id_surat'];

//jika ada file akan mengekseskusi script dibawah ini
if(!empty($row['file'])){
  unlink("upload/surat_masuk/".$row['file']);
  $query = mysqli_query($config, "DELETE FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
  $query2 = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_surat='$id_surat'");

  if($query == true){
      $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
      header("Location: surat_masuk.php");
      die();
  } else {
      $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
      echo '<script language="javascript">
              window.location.href="hapus_masuk.php?=del&id_surat='.$id_surat.'";
            </script>';
  }
} else {

  //jika tidak ada file akan mengekseskusi script dibawah ini
  $query = mysqli_query($config, "DELETE FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
  $query2 = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_surat='$id_surat'");

  if($query == true){
      $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
      header("Location: surat_masuk.php");
      die();
  } else {
      $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
      echo '<script language="javascript">
              window.location.href="hapus_masuk.php?=del&id_surat='.$id_surat.'";
            </script>';
  }
}
}
}
}
}
}
?>
              