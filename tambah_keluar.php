  
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
            List Surat keluar
            <small>Data Surat keluar </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Keluar</li>
          </ol>
        </section>

        <!-- Main content -->

     <?php   if(isset($_REQUEST['submit'])){

//validasi form kosong
if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == ""
    || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
    $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
    echo '<script language="javascript">window.history.back();</script>';
} else {

    $no_agenda = $_REQUEST['no_agenda'];
    $no_surat = $_REQUEST['no_surat'];
    $tujuan = $_REQUEST['tujuan'];
    $isi = $_REQUEST['isi'];
    $tgl_surat = $_REQUEST['tgl_surat'];
    $keterangan = $_REQUEST['keterangan'];
    $id_user = $_SESSION['id_user'];

    //validasi input data
    if(!preg_match("/^[0-9]*$/", $no_agenda)){
        $_SESSION['no_agendak'] = 'Form Nomor Agenda harus diisi angka!';
        echo '<script language="javascript">window.history.back();</script>';
    } else {

        if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
            $_SESSION['no_suratk'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $tujuan)){
                $_SESSION['tujuan_surat'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                    $_SESSION['isik'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

   
                        if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                            $_SESSION['tgl_suratk'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                $_SESSION['keterangank'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                                $result = mysqli_num_rows($cek);

                                if($result > 0){
                                    $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                    $file = $_FILES['file']['name'];
                                    $x = explode('.', $file);
                                    $eks = strtolower(end($x));
                                    $ukuran = $_FILES['file']['size'];
                                    $target_dir = "upload/surat_keluar/";

                                    //jika form file tidak kosong akan mengekse
                                    if($file != ""){

                                        $rand = rand(1,10000);
                                        $nfile = $rand."-".$file;
                                        if(in_array($eks, $ekstensi) == true){
                                            if($ukuran < 2500000){

                                                move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                                    tgl_catat,file,keterangan,id_user)
                                                    VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                                if($query == true){
                                                    $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                    header("Location: surat_keluar.php");
                                                    die();
                                                } else {
                                                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            } else {
                                                $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            }
                                        } else {
                                            $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        }
                                    } else {
                                        $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                            tgl_catat,file,keterangan,id_user)
                                            VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'','$keterangan','$id_user')");

                                        if($query == true){
                                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                            header("Location: surat_keluar.php");
                                            die();
                                        } else {
                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

} else {?>

<?php
    if(isset($_SESSION['errQ'])){
        $errQ = $_SESSION['errQ'];
        echo '<div id="alert-message" class="row">
        <div class="col-md-12">
        <div class="alert alert-danger">
        '.$errQ.'
        </div>        </div>   
        </div>';
        unset($_SESSION['errQ']);
    }
    if(isset($_SESSION['errEmpty'])){
        $errEmpty = $_SESSION['errEmpty'];
        echo '<div id="alert-message" class="row">
        <div class="col-md-12">
        <div class="alert alert-warning">
        '.$errEmpty.'
        </div>        </div>   
        </div>';
        unset($_SESSION['errEmpty']);
    }
?>

<!-- Row form Start -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">            
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tambah Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="tambah_keluar.php" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                    <?php
                                    if(isset($_SESSION['no_agenda'])){
                                        $no_agenda = $_SESSION['no_agenda'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_agenda.'</div>';
                                        unset($_SESSION['no_agenda']);
                                    }
                                ?>
                      <label for="exampleInputEmail1">Nomor Agenda</label>
                      
                      <input id="no_agenda" type="number" class="form-control validate" name="no_agenda" placeholder="No Agenda" required>
                    </div>
              
                    <div class="form-group"> 
                         <?php
                                    if(isset($_SESSION['tgl_surat'])){
                                        $tgl_surat = $_SESSION['tgl_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_surat.'</div>';
                                        unset($_SESSION['tgl_surat']);
                                    }
                                ?>
                      <label for="exampleInputPassword1">Tanggal Surat</label>
                      <input id="tgl_surat" type="text" class="form-control validate" name="tgl_surat" placeholder="Tanggal Surat" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                    <?php
                                    if(isset($_SESSION['keterangan'])){
                                        $keterangan = $_SESSION['keterangan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$keterangan.'</div>';
                                        unset($_SESSION['keterangan']);
                                    }
                                ?>
                      <label for="exampleInputPassword1">Keterangan</label>
                    <textarea id="keterangan" class="form-control validate" name="keterangan" rows="3" placeholder="Keterangan" required></textarea>
                    </div>
                    
                    </div><!-- /.col -->
                  <div class="col-md-6">
                  <div class="form-group">
                  <?php
                                    if(isset($_SESSION['tujuan'])){
                                        $tujuan = $_SESSION['tujuan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tujuan.'</div>';
                                        unset($_SESSION['tujuan']);
                                    }
                                ?>
                      <label for="exampleInputPassword1">Asal Surat</label>
                      <input id="tujuan" type="text" class="form-control validate" name="tujuan" placeholder="Asal Surat" required>
                    </div>

                    <div class="form-group">
                                  <?php
                                    if(isset($_SESSION['no_surat'])){
                                        $no_surat = $_SESSION['no_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_surat.'</div>';
                                        unset($_SESSION['no_surat']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                      <label for="exampleInputPassword1">Nomor Surat</label>
                      <input id="no_surat" type="number" class="form-control validate" name="no_surat" placeholder="No Surat" required>
                    </div>
                    <div class="form-group"> 
                        <?php
                                    if(isset($_SESSION['isi'])){
                                        $isi = $_SESSION['isi'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isi.'</div>';
                                        unset($_SESSION['isi']);
                                    }
                                ?>
                      <label for="exampleInputPassword1"> Isi Ringkasan</label>
                      <textarea id="isi" class="form-control validate" name="isi" rows="3" placeholder="Isi Ringkasan" required></textarea>
                    
                    </div>
                    <div class="form-group">
                    <?php
                                            if(isset($_SESSION['errSize'])){
                                                $errSize = $_SESSION['errSize'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errSize.'</div>';
                                                unset($_SESSION['errSize']);
                                            }
                                            if(isset($_SESSION['errFormat'])){
                                                $errFormat = $_SESSION['errFormat'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errFormat.'</div>';
                                                unset($_SESSION['errFormat']);
                                            }
                                        ?>
                      <label for="exampleInputFile">File</label>
                      <input type="file" class="file-path validate" id="file" name="file" required>
                      <p class="help-block">*Format file yang diperbolehkan 
                          *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</p>
                    </div>
                    </div><!-- /.col -->
                    <div class="box-footer">
                        <a href="surat_keluar.php" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div><!-- /.box-body -->



                </form>
              </div><!-- /.box -->
<!-- Row form END -->

               
</div>
          </div><!-- /.row -->
        </section><!-- /.content -->
        </div><!-- /.row -->
     <!-- jQuery 2.1.3 -->
    <?php include("admin/footer.php");?>
    <?php include("admin/js.php");?>
    <?php
    }

    }
?>