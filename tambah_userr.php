  
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
            Tambah User
            <small>Pengguna Sistem</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data User</li>
          </ol>
        </section>

        <!-- Main content -->

          <?php  
           if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['username'] == "" || $_REQUEST['password'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['nip'] == "" || $_REQUEST['admin'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi!';
                header("Location: tambah_user.php");
                die();
            } else {

                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $nama = $_REQUEST['nama'];
                $nip = $_REQUEST['nip'];
                $admin = $_REQUEST['admin'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                    $_SESSION['uname'] = 'Form Username hanya boleh mengandung karakter huruf, angka dan underscore (_)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z., ]*$/", $nama)){
                        $_SESSION['namauser'] = 'Form Nama hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9. -]*$/", $nip)){
                            $_SESSION['nipuser'] = 'Form NIP hanya boleh mengandung karakter angka, spasi dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[2-3]*$/", $admin)){
                                $_SESSION['tipeuser'] = 'Form Tipe User hanya boleh mengandung karakter angka 2 atau 3';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_user WHERE username='$username'");
                                $result = mysqli_num_rows($cek);

                                if($result > 0){
                                    $_SESSION['errUsername'] = 'Username sudah terpakai, gunakan yang lain!';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(strlen($username) < 5){
                                        $_SESSION['errUser5'] = 'Username minimal 5 karakter!';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(strlen($password) < 5){
                                            $_SESSION['errPassword'] = 'Password minimal 5 karakter!';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            $query = mysqli_query($config, "INSERT INTO tbl_user(username,password,nama,nip,admin) VALUES('$username',MD5('$password'),'$nama','$nip','$admin')");

                                            if($query != false){
                                                $_SESSION['succAdd'] = 'SUKSES! User baru berhasil ditambahkan';
                                                header("Location: kelola_user.php");
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
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tambah Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="col-md-6">
     

                    <div class="form-group">
                   
                      <label for="exampleInputEmail1">Username</label>
                      <input id="username" type="text" class="form-control validate" name="username" placeholder="Username" required>
                      <?php
                                    if(isset($_SESSION['uname'])){
                                        $uname = $_SESSION['uname'];
                                        echo '<p class="help-block"><code>'.$uname.'</code></p>';
                                        unset($_SESSION['uname']);
                                    }
                                    if(isset($_SESSION['errUsername'])){
                                        $errUsername = $_SESSION['errUsername'];
                                        echo '<p class="help-block"><code>'.$errUsername.'</code></p>';
                                        unset($_SESSION['errUsername']);
                                    }
                                    if(isset($_SESSION['errUser5'])){
                                        $errUser5 = $_SESSION['errUser5'];
                                        echo '<p class="help-block"><code>'.$errUser5.'</code></p>';
                                        unset($_SESSION['errUser5']);
                                    }
                                ?>
                    </div>
                    <div class="form-group">
                    
                      <label for="exampleInputEmail1">Nama</label>
                      <input id="nama" type="text" class="form-control validate" name="nama" placeholder="Nama Pengguna" required>
                      <?php
                                    if(isset($_SESSION['namauser'])){
                                        $namauser = $_SESSION['namauser'];
                                        echo '<p class="help-block"><code>'.$namaUser.'</code></p>';
                                        unset($_SESSION['namauser']);
                                    }
                                ?>
                    </div>
                    
                    </div><!-- /.col -->
                  <div class="col-md-6">
                  <div class="form-group"> 
                       <label for="exampleInputPassword1">Password</label>
                       <input id="password" type="password" class="form-control validate" name="password" placeholder="Password" required>
                       <?php
                                    if(isset($_SESSION['errPassword'])){
                                        $errPassword = $_SESSION['errPassword'];
                                        echo '<p class="help-block"><code>'.$errPassword.'</code></p>';
                                        unset($_SESSION['errPassword']);
                                    }
                                ?>
                      
                    </div>
                    <div class="form-group">
                     <label for="exampleInputPassword1">NIP</label>
                     <input id="nip" type="text" class="form-control validate" name="nip" placeholder="NIP" required>
                     <?php
                                    if(isset($_SESSION['nipuser'])){
                                        $nipuser = $_SESSION['nipuser'];
                                        echo '<p class="help-block"><code>'.$nipuser.'</code></p>';
                                        unset($_SESSION['nipuser']);
                                    }
                                ?>
                     
                    </div>

                  <div class="form-group">
                  <label for="exampleInputPassword1">Pilih Type User</label>
                  <select class="form-control validate" name="admin" id="admin" required>
                                    <option value="3">User Biasa</option>
                                    <option value="2">Administrator</option>
                                </select>
                                <?php
                                    if(isset($_SESSION['tipeuser'])){
                                        $tipeuser = $_SESSION['tipeuser'];
                                        echo '<p class="help-block"><code>'.$tipeuser.'</code></p>';
                                        unset($_SESSION['tipeuser']);
                                    }
                                ?>
                     
                    </div>

                    </div><!-- /.col -->
                    <div class="box-footer">
                        <a href="kelola_user.php" class="btn btn-danger">Kembali</a>
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