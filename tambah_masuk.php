  
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
 <style>
 .validate1{
     border: 2px dashed red;
 }
 input-valid{
     border: 2px solid black;
 }
 </style>
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   <section class="content-header">
          <h1>
            List Surat Masuk
            <small>Data Surat Masuk Keselruhan</small>
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
        $_SESSION['no_agenda'] = 'Form Nomor Agenda harus diisi angka!';
        echo '<script language="javascript">window.history.back();</script>';
    } else {

        if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
            $_SESSION['no_surat'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $asal_surat)){
                $_SESSION['asal_surat'] = 'Form Asal Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                    $_SESSION['isi'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

    
                        if(!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)){
                            $_SESSION['indeks'] = 'Form Indeks hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                $_SESSION['tgl_surat'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                    $_SESSION['keterangan'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $cek = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE no_surat='$no_surat'");
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
                                        $target_dir = "upload/surat_masuk/";

                                        //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                        if($file != ""){

                                            $rand = rand(1,10000);
                                            $nfile = $rand."-".$file;

                                            //validasi file
                                            if(in_array($eks, $ekstensi) == true){
                                                if($ukuran < 2500000){

                                                    move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                    $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_surat,asal_surat,isi,kode,indeks,tgl_surat,
                                                        tgl_diterima,file,keterangan,id_user)
                                                            VALUES('$no_agenda','$no_surat','$asal_surat','$isi','$nkode','$indeks','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                                    if($query == true){
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: surat_masuk.php");
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

                                            //jika form file kosong akan mengeksekusi script dibawah ini
                                            $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_surat,asal_surat,isi,kode,indeks,tgl_surat, tgl_diterima,file,keterangan,id_user)
                                                VALUES('$no_agenda','$no_surat','$asal_surat','$isi','$nkode','$indeks','$tgl_surat',NOW(),'','$keterangan','$id_user')");

                                            if($query == true){
                                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
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
    }

} else {
 

    ?>



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
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tambah Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="tambah_masuk.php" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="col-md-6">
     

                    <div class="form-group">
                   
                      <label for="exampleInputEmail1">Nomor Agenda</label>
                      
                      <input id="no_agenda inputError" type="number" class="form-control validate" name="no_agenda" placeholder="No Agenda" required>
                      <?php
                                    if(isset($_SESSION['no_agenda'])){
                                        $no_agenda = $_SESSION['no_agenda'];
                                        echo '<p class="help-block"><code>'.$no_agenda.'</code></p>';
                                        unset($_SESSION['no_agenda']);
                                    }
                                ?>
                    </div>
                    <div class="form-group">
                    
                      <label for="exampleInputEmail1">Indeks Berkas</label>
                      <input id="indeks inputError" type="text" class="form-control validate" name="indeks" placeholder="Indeks Berkas" required>
                      <?php
                                    if(isset($_SESSION['indeks'])){
                                        $indeks = $_SESSION['indeks'];
                                        echo '<p class="help-block"><code>'.$indeks.'</code></p>';
                                        unset($_SESSION['indeks']);
                                    }
                                ?>
                    </div>
                    <div class="form-group"> 
                       <label for="exampleInputPassword1">Tanggal Surat</label>
                      <input id="tgl_surat" type="text" class="form-control validate" name="tgl_surat" placeholder="Tanggal Surat" autocomplete="off" required>
                      <?php
                                    if(isset($_SESSION['tgl_surat'])){
                                        $tgl_surat = $_SESSION['tgl_surat'];
                                        echo '<p class="help-block"><code>'.$tgl_surat.'</code></p>';
                                        unset($_SESSION['tgl_surat']);
                                    }
                                ?>
                      
                    </div>
                    <div class="form-group">
                     <label for="exampleInputPassword1">Keterangan</label>
                    <textarea id="keterangan inputError" class="form-control validate" name="keterangan" rows="3" placeholder="Keterangan" required></textarea>
                    <?php
                                    if(isset($_SESSION['keterangan'])){
                                        $keterangan = $_SESSION['keterangan'];
                                        echo '<p class="help-block"><code>'.$keterangan.'</code></p>';
                                        unset($_SESSION['keterangan']);
                                    }
                                ?>
                     
                    </div>
                    
                    </div><!-- /.col -->
                  <div class="col-md-6">
                  <div class="form-group">
                  <label for="exampleInputPassword1">Asal Surat</label>
                      <input id="asal_surat inputError" type="text" class="form-control validate" name="asal_surat" placeholder="Asal Surat" required>
                      <?php
                                    if(isset($_SESSION['asal_surat'])){
                                        $asal_surat = $_SESSION['asal_surat'];
                                        echo '<p class="help-block"><code>'.$asal_surat.'</code></p>';
                                        unset($_SESSION['asal_surat']);
                                    }
                                ?>
                     
                    </div>

                    <div class="form-group">
                          
                      <label for="exampleInputPassword1">Nomor Surat</label>
                      <input id="no_surat inputError" type="number" class="form-control" name="no_surat" placeholder="No Surat" required>
                      <?php
                                    if(isset($_SESSION['no_surat'])){
                                        $no_surat = $_SESSION['no_surat'];
                                        echo '<p class="help-block"><code>'.$no_surat.'</code></p>';
                                        unset($_SESSION['no_surat']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<p class="help-block"><code>'.$errDup.'</code></p>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputPassword1"> Isi Ringkasan</label>
                      <textarea id="isi inputError" class="form-control validate" name="isi" rows="3" placeholder="Isi Ringkasan" required></textarea>
                      <?php
                                    if(isset($_SESSION['isi'])){
                                        $isi = $_SESSION['isi'];
                                        echo '<p class="help-block"><code>'.$isi.'</code></p>';
                                        unset($_SESSION['isi']);
                                    }
                                ?>
                     
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File</label>
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
                   
                      <input type="file" class="file-path" id="file inputError" name="file">
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <?php
    }

    }
?>