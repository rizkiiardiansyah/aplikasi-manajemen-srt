  
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
            Edit Surat Masuk
            <small>Data Surat Masuk</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Masukr</li>
          </ol>
        </section>

        <!-- Main content -->

          <?php  
       if(isset($_REQUEST['submit'])){

        //validasi form kosong
        if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
|| $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            $no_agenda = $_REQUEST['no_agenda'];
            $no_surat = $_REQUEST['no_surat'];
            $asal_surat = $_REQUEST['asal_surat'];
            $isi = $_REQUEST['isi'];
            $indeks = $_REQUEST['indeks'];
            $tgl_surat = $_REQUEST['tgl_surat'];
            $keterangan = $_REQUEST['keterangan'];
            $id_user = $_SESSION['id_user'];

            //validasi input data
            if(!preg_match("/^[0-9]*$/", $no_agenda)){
                $_SESSION['eno_agenda'] = 'Form Nomor Agenda harus diisi angka!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                    $_SESSION['eno_surat'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $asal_surat)){
                        $_SESSION['easal_surat'] = 'Form Asal Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                            $_SESSION['eisi'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {


                                if(!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)){
                                    $_SESSION['eindeks'] = 'Form Indeks hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                        $_SESSION['etgl_surat'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                            $_SESSION['eketerangan'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                            $file = $_FILES['file']['name'];
                                            $x = explode('.', $file);
                                            $eks = strtolower(end($x));
                                            $ukuran = $_FILES['file']['size'];
                                            $target_dir = "upload/surat_masuk/";

                                        //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                        if($file != ""){

                                            $rand = rand(1,10000);
                                            $nfile = $rand."-".$file;

                                            //validasi file
                                            if(in_array($eks, $ekstensi) == true){
                                                if($ukuran < 2300000){

                                                    $id_surat = $_REQUEST['id_surat'];
                                                    $query = mysqli_query($config, "SELECT file FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
                                                    list($file) = mysqli_fetch_array($query);

                                                    //jika file tidak kosong akan mengeksekusi script dibawah ini
                                                    if(!empty($file)){
                                                        unlink($target_dir.$file);

                                                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                        $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                        if($query == true){
                                                            $_SESSION['succEdit'] = 'SUKSES! Data berhasil diedit';
                                                            header("Location: ./admin.php?page=tsm");
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {

                                                        //jika file kosong akan mengeksekusi script dibawah ini
                                                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                        $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                        if($query == true){
                                                            $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                            header("Location: ./admin.php?page=tsm");
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
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

                                            //jika form file kosong akan mengeksekusi script dibawah ini
                                            $id_surat = $_REQUEST['id_surat'];

                                            $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                            if($query == true){
                                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                header("Location: surat_masuk.php");
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
} else {
    $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
    $query = mysqli_query($config, "SELECT id_surat, no_agenda, no_surat, asal_surat, isi, kode, indeks, tgl_surat, file, keterangan, id_user FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
    list($id_surat, $no_agenda, $no_surat, $asal_surat, $isi, $kode, $indeks, $tgl_surat, $file, $keterangan, $id_user) = mysqli_fetch_array($query);

    if($_SESSION['id_user'] != $id_user AND $_SESSION['id_user'] != 1){
        echo '<script language="javascript">
                window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                window.location.href="surat_masuk.php";
              </script>';
    } else {?>
  


<!-- Row form Start -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">            
            <?php
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
    if(isset($_SESSION['errEmpty'])){
        $errEmpty = $_SESSION['errEmpty'];
        echo '
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-ban"></i>  
        '.$errEmpty.'
      </div>';
        unset($_SESSION['errEmpty']);
    }
?>       
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="edit_masuk.php" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                    <input type="hidden" name="id_surat" value="<?php echo $id_surat ;?>">
                
                                  
                      <label for="exampleInputEmail1">Nomor Agenda</label>
                      <input id="no_agenda" type="number" class="form-control validate" value="<?php echo $no_agenda ;?>" name="no_agenda" required>
                                <?php
                                    if(isset($_SESSION['eno_agenda'])){
                                        $eno_agenda = $_SESSION['eno_agenda'];
                                        echo '<p class="help-block"><code>'.$eno_agenda.'</code></p>';
                                                                                unset($_SESSION['eno_agenda']);
                                    }
                                ?>      
                
                    </div>
                    <div class="form-group">

                      <label for="exampleInputEmail1">Indeks Berkas</label>
                      <input id="indeks" type="text" class="form-control validate" name="indeks" value="<?php echo $indeks ;?>" required>
                                <?php
                                    if(isset($_SESSION['eindeks'])){
                                        $eindeks = $_SESSION['eindeks'];
                                        echo '<p class="help-block"><code>'.$eindeks.'</code></p>';
                                        unset($_SESSION['eindeks']);
                                    }
                                ?>
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputPassword1">Tanggal Surat</label>
                      <input id="tgl_surat" type="text" name="tgl_surat" class="form-control datepicker\" value="<?php echo $tgl_surat ;?>" required>
                                <?php
                                    if(isset($_SESSION['etgl_surat'])){
                                        $etgl_surat = $_SESSION['etgl_surat'];
                                        echo '<p class="help-block"><code>'.$etgl_surat.'</code></p>';
                                        unset($_SESSION['etgl_surat']);
                                    }
                                ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Keterangan</label>
                      <textarea id="keterangan" class="form-control validate" name="keterangan" required><?php echo $keterangan ;?></textarea>
                         
                                <?php
                                    if(isset($_SESSION['eketerangan'])){
                                        $eketerangan = $_SESSION['eketerangan'];
                                        echo '<p class="help-block"><code>'.$eketerangan.'</code></p>';
                                        unset($_SESSION['eketerangan']);
                                    }
                                ?>
                    </div>
                    
                    </div><!-- /.col -->
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputPassword1">Asal Surat</label>
                      <input id="asal_surat" type="text" class="form-control validate" name="asal_surat" value="<?php echo $asal_surat ;?>" required>
                                <?php
                                    if(isset($_SESSION['easal_surat'])){
                                        $easal_surat = $_SESSION['easal_surat'];
                                        echo '<p class="help-block"><code>'.$easal_surat.'</code></p>';
                                        unset($_SESSION['easal_surat']);
                                    }
                                ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Nomor Surat</label>
                      <input id="no_surat" type="text" class="form-control validate" name="no_surat" value="<?php echo $no_surat ;?>" required>
                                <?php
                                    if(isset($_SESSION['eno_surat'])){
                                        $eno_surat = $_SESSION['eno_surat'];
                                        echo '<p class="help-block"><code>'.$eno_surat.'</code></p>';
                                        unset($_SESSION['eno_surat']);
                                    }
                                ?>
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputPassword1"> Isi Ringkasan</label>
                      <textarea id="isi" class="form-control validate" name="isi" required><?php echo $isi ;?></textarea>
                                <?php
                                    if(isset($_SESSION['eisi'])){
                                        $eisi = $_SESSION['eisi'];
                                        echo '<p class="help-block"><code>'.$eisi.'</code></p>';
                                        unset($_SESSION['eisi']);
                                    }
                                ?>  
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File</label>
                      <input type="file" id="file" name="file">
                      <input class="form-control validate" type="text" value="<?php echo $file ;?>" placeholder="Upload file/scan gambar surat masuk">
                                        <?php
                                            if(isset($_SESSION['errSize'])){
                                                $errSize = $_SESSION['errSize'];
                                                echo '<p class="help-block"><code>'.$errSize.'</code></p>';
                                                unset($_SESSION['errSize']);
                                            }
                                            if(isset($_SESSION['errFormat'])){
                                                $errFormat = $_SESSION['errFormat'];
                                                echo '<p class="help-block"><code>'.$errFormat.'</code></p>';
                                                unset($_SESSION['errFormat']);
                                            }
                                        ?>
                      <p class="help-block">*Format file yang diperbolehkan 
                          *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</p>
                    </div>
                    </div><!-- /.col -->
                    <div class="box-footer">
                        <a href="surat_masuk.php" class="btn btn-danger">Kembali</a>
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
}
?>