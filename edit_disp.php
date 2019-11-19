  
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
            List Surat Masuk
            <small>Data Surat Masuk Keselruhan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Keluar</li>
          </ol>
        </section>
<?php

        if(isset($_REQUEST['submit'])){

            $id_surat = $_REQUEST['id_surat'];
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            list($id_surat) = mysqli_fetch_array($query);

            //validasi form kosong
            if($_REQUEST['tujuan'] == "" || $_REQUEST['isi_disposisi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $id_disposisi = $_REQUEST['id_disposisi'];
                $tujuan = $_REQUEST['tujuan'];
                $isi_disposisi = $_REQUEST['isi_disposisi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $tujuan)){
                    $_SESSION['tujuan'] = 'Form Tujuan Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi_disposisi)){
                        $_SESSION['isi_disposisi'] = 'Form Isi Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Batas Waktu hanya boleh mengandung karakter huruf dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $catatan)){
                                $_SESSION['catatan'] = 'Form catatan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-) garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0 ]*$/", $sifat)){
                                    $_SESSION['catatan'] = 'Form SIFAT hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_disposisi SET tujuan='$tujuan', isi_disposisi='$isi_disposisi', sifat='$sifat', batas_waktu='$batas_waktu', catatan='$catatan', id_surat='$id_surat', id_user='$id_user' WHERE id_disposisi='$id_disposisi'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="disp.php?&id_surat='.$id_surat.'";
                                              </script>';
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
        } else {

            $id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);
            $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query)){?>

                <!-- Row Start -->
           

      
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
                <form role="form" method="POST" action="" enctype="multipart/form-data">
                  
                <div class="col-md-6">
                <input type="hidden" value="<?php echo $row['id_disposisi'] ;?>">
                    <div class="form-group">
                      <?php
                                    if(isset($_SESSION['tujuan'])){
                                        $tujuan = $_SESSION['tujuan'];
                                        echo '<p class="help-block"><code>'.$tujuan.'</code></p>';
                                        unset($_SESSION['tujuan']);
                                    }
                                ?>
                                    <label for="exampleInputEmail1">Tujuan Disposisi</label>
                      
                      <input id="tujuan" type="text" class="form-control validate" name="tujuan" value="<?php echo $row['tujuan'] ;?>" placeholder="Tujuan Disposisi" required>
                    </div>
                   
                    <div class="form-group"> 
                      <?php
                                    if(isset($_SESSION['isi_disposisi'])){
                                        $isi_disposisi = $_SESSION['isi_disposisi'];
                                        echo '<p class="help-block"><code>'.$isi_disposisi.'</code></p>';
                                        unset($_SESSION['isi_disposisi']);
                                    }
                                ?>                      <label for="exampleInputPassword1">Isi Disposisi</label>
                    <textarea id="isi_disposisi" class="form-control validate" name="isi_disposisi"  rows="3" placeholder="Isi Disposisi" required><?php echo $row['isi_disposisi'] ;?></textarea>
                             
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                <?php
                                    if(isset($_SESSION['batas_waktu'])){
                                        $batas_waktu = $_SESSION['batas_waktu'];
                                        echo '<p class="help-block"><code>'.$batas_waktu.'</code></p>';
                                        unset($_SESSION['batas_waktu']);
                                    }
                                ?>               <label for="exampleInputEmail1">Batas Waktu</label>
                      <input id="batas_waktu" type="text" class="form-control validate" name="batas_waktu" value="<?php echo $row['batas_waktu'] ;?>"  placeholder="Batas Waktu" required>
                    </div>
                    <div class="form-group">
                    <?php
                                    if(isset($_SESSION['catatan'])){
                                        $catatan = $_SESSION['catatan'];
                                        echo '<p class="help-block"><code>'.$catatan.'</code></p>';
                                        unset($_SESSION['catatan']);
                                    }
                                ?>
                                              
                                              <label for="exampleInputPassword1">Catatan</label>
                    <textarea id="catatan" class="form-control validate" name="catatan" value="<?php echo $row['catatan'] ;?>"  rows="3" placeholder="Catatan" required><?php echo $row['catatan'] ;?></textarea>
                    </div>
                    
                  <div class="form-group">
               
                      <label for="exampleInputPassword1">Pilih Sifat Disposisi</label>
                      <select class="form-control validate" name="sifat"  id="sifat" required>
                      <option value="<?php echo $row['sifat']; ?>"><?php echo $row['sifat']; ?></option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Rahasia">Rahasia</option>
                                </select>
                                <?php
                                if(isset($_SESSION['sifat'])){
                                    $sifat = $_SESSION['sifat'];
                                    echo '<p class="help-block"><code>'.$sifat.'</code></p>';
                                    unset($_SESSION['sifat']);
                                }
                            ?>
                                 </div>

                                 </div><!-- /.col -->
                                 
                  <div class="box-footer">
                        <a href="disp.php?=disp&id_surat=<?php echo $row['id_surat']; ?>" class="btn btn-danger">Kembali</a>
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
?>
