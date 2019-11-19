  
  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

?>
 <?php include('admin/head.php');?>
 <?php include('admin/sidebar.php');?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   <section class="content-header">
          <h1>
            List Surat Masuk
            <small>Data Surat Masuk Keseluruhan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Keluar</li>
          </ol>
        </section>

        <!-- Main content -->

          <?php  
    if(isset($_REQUEST['submit'])){

        //validasi form kosong
        if ($_REQUEST['institusi'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['alamat'] == "" || $_REQUEST['kepsek'] == "" || $_REQUEST['nip'] == ""
            || $_REQUEST['website'] == "" || $_REQUEST['email'] == ""){
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            header("Location: man_instansi.php?page=sett");
            die();
        } else {

            $id_instansi = "1";
            $institusi = $_REQUEST['institusi'];
            $nama = $_REQUEST['nama'];
            $alamat = $_REQUEST['alamat'];
            $kepsek = $_REQUEST['kepsek'];
            $nip = $_REQUEST['nip'];
            $website = $_REQUEST['website'];
            $email = $_REQUEST['email'];
            $id_user = $_SESSION['id_user'];

            //validasi input data
            if(!preg_match("/^[a-zA-Z0-9. -]*$/", $institusi)){
                $_SESSION['institusi'] = 'Form Institusi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan minus(-)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

            if(!preg_match("/^[a-zA-Z0-9. -]*$/", $nama)){
                $_SESSION['namains'] = 'Form Nama Instansi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan minus(-)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                    if(!preg_match("/^[a-zA-Z0-9.,:\/<> -\"]*$/", $status)){
                        $_SESSION['status'] = 'Form Status hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), titik dua(:), petik dua(""), garis miring(/) dan minus(-)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $alamat)){
                            $_SESSION['alamat'] = 'Form Alamat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z., ]*$/", $kepsek)){
                                $_SESSION['kepsek'] = 'Form Nama Kepala Sekolah hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)<br/><br/>';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[0-9 -]*$/", $nip)){
                                    $_SESSION['nipkepsek'] = 'Form NIP Kepala Sekolah hanya boleh mengandung karakter angka, spasi, dan minus(-)<br/><br/>';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    //validasi url website
                                    if(!filter_var($website, FILTER_VALIDATE_URL)){
                                        $_SESSION['website'] = 'Format URL Website tidak valid';
                                        header("Location: man_instansi.php?page=sett");
                                        die();
                                    } else {

                                        //validasi email
                                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                            $_SESSION['email'] = 'Format Email tidak valid';
                                            header("Location: man_instansi.php?page=sett");
                                            die();
                                        } else {

                                            $ekstensi = array('png','jpg');
                                            $logo = $_FILES['logo']['name'];
                                            $x = explode('.', $logo);
                                            $eks = strtolower(end($x));
                                            $ukuran = $_FILES['logo']['size'];
                                            $target_dir = "upload/";

                                            //jika form logo tidak kosong akan mengeksekusi script dibawah ini
                                            if(!empty($logo)){

                                                $nlogo = $logo;
                                                //validasi gambar
                                                if(in_array($eks, $ekstensi) == true){
                                                    if($ukuran < 2000000){

                                                        $query = mysqli_query($config, "SELECT logo FROM tbl_instansi");
                                                        list($logo) = mysqli_fetch_array($query);

                                                        unlink($target_dir.$logo);

                                                        move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir.$nlogo);

                                                        $query = mysqli_query($config, "UPDATE tbl_instansi SET institusi='$institusi', nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email',logo='$nlogo',id_user='$id_user' WHERE id_instansi='$id_instansi'");

                                                        if($query == true){
                                                            $_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
                                                            header("Location: man_instansi.php?page=sett");
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {
                                                        $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!<br/><br/>';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                } else {
                                                    $_SESSION['errSize'] = 'Format file gambar yang diperbolehkan hanya *.JPG dan *.PNG!<br/><br/>';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            } else {

                                                //jika form logo kosong akan mengeksekusi script dibawah ini
                                                $query = mysqli_query($config, "UPDATE tbl_instansi SET institusi='$institusi',nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email',id_user='$id_user' WHERE id_instansi='$id_instansi'");

                                                if($query == true){
                                                    $_SESSION['succEdit'] = 'SUKSES! Data instansi berhasil diupdate';
                                                    header("Location: man_instansi.php?page=sett");
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
        }
    } else {

        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
        if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){?>
  
                        
 

<!-- Row form Start -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">       
            <?php
                            if(isset($_SESSION['errEmpty'])){
                                $errEmpty = $_SESSION['errEmpty'];
                                echo '
                                <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i>  
                        '.$errEmpty.'
                      </div>
                                ';
                                unset($_SESSION['errEmpty']);
                            }
                            if(isset($_SESSION['succEdit'])){
                                $succEdit = $_SESSION['succEdit'];
                                echo '
                                <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i>  
                                '.$succEdit.'
                              </div>';
                                unset($_SESSION['succEdit']);
                            }
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
                            ?>     
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Manajemen Instansi</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">

                                  
                      <label for="exampleInputEmail1">Institusi</label>
                      <input type="hidden" value="<?php echo $id_instansi; ?>" name="id_instansi">
                      <input id="institusi" type="text" class="validate form-control" name="institusi" value="<?php echo $row['institusi']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['institusi'])){
                                                    $namains = $_SESSION['institusi'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$institusi.'</div>';
                                                    unset($_SESSION['institusi']);
                                                }
                                            ?> 
                
                    </div>
                    <div class="form-group">

                      <label for="exampleInputEmail1">Nama Institusi</label>
                      <input type="hidden" value="<?php echo $id_instansi; ?>" name="id_instansi">
                      <input id="nama" type="text" class="validate form-control" name="nama" value="<?php echo $row['nama']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['namains'])){
                                                    $namains = $_SESSION['namains'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namains.'</div>';
                                                    unset($_SESSION['namains']);
                                                }
                                            ?>
                                      
                                    </div>
                                    <div class="form-group">
                      <label for="exampleInputPassword1">NIP Pimpinan</label>
                      <input id="nip" type="text" class="validate form-control" name="nip" value="<?php echo $row['nip']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['nipkepsek'])){
                                                    $nipkepsek = $_SESSION['nipkepsek'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nipkepsek.'</div>';
                                                    unset($_SESSION['nipkepsek']);
                                                }
                                            ?>
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputPassword1">Pimpinan</label>
                      <input id="kepsek" type="text" class="validate form-control" name="kepsek" value="<?php echo $row['kepsek']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['kepsek'])){
                                                    $kepsek = $_SESSION['kepsek'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kepsek.'</div>';
                                                    unset($_SESSION['kepsek']);
                                                }
                                            ?>
                    </div>
               
                    
                    </div><!-- /.col -->
                  <div class="col-md-6">
               
                  <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <textarea id="alamat" class="form-control validate" name="alamat" required><?php echo $row['alamat'];?></textarea>
                      <?php
                                                if(isset($_SESSION['alamat'])){
                                                    $alamat = $_SESSION['alamat'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$alamat.'</div>';
                                                    unset($_SESSION['alamat']);
                                                }
                                            ?>    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input id="email" type="email" class="validate form-control" name="email" value="<?php echo $row['email']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['email'])){
                                                    $email = $_SESSION['email'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$email.'</div>';
                                                    unset($_SESSION['email']);
                                                }
                                            ?>
                               
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Website</label>
                    <input id="website" type="url" class="validate form-control" name="website" value="<?php echo $row['website']; ?>" required>
                                            <?php
                                                if(isset($_SESSION['website'])){
                                                    $website = $_SESSION['website'];
                                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$website.'</div>';
                                                    unset($_SESSION['website']);
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <div class="card" style="width: 18rem;">    
                    <img class="file card-img-top" src="upload/<?php echo $row['logo']; ?>"/>
                                    </div>
                                    </div>
                                    </div>
                                        <div class="form-group">
                      <label for="exampleInputFile">Logo</label>
                      <input type="file" id="logo" name="logo">

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
                      <p class="help-block">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</p>
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
}
}

?>