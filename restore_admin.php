  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if($_SESSION['admin'] != 1){
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
            Restore Database
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Restore Database</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body">                
     <?php
     
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
                if(isset($_SESSION['errFormat'])){
                    $errFormat = $_SESSION['errFormat'];
                    echo '
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i>  
                        '.$errFormat.'
                      </div>';
                    unset($_SESSION['errFormat']);
                }
                if(isset($_SESSION['errUpload'])){
                    $errUpload = $_SESSION['errUpload'];
                    echo '
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i>  
                        '.$errUpload.'
                      </div>';
                    unset($_SESSION['errUpload']);
                }
                if(isset($_SESSION['succRestore'])){
                    $succRestore = $_SESSION['succRestore'];
                    echo '
                    <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i>  
                    '.$succRestore.'
                  </div>
                    ';
                    unset($_SESSION['succRestore']);
                }

                // proses restore database dilakukan oleh fungsi
                function restore($file){
                	global $rest_dir;

                    //konfigurasi database
                	$koneksi=mysqli_connect("localhost","root","","ams_native");

                	$nama_file	= $file['name'];
                	$ukrn_file	= $file['size'];
                	$tmp_file	= $file['tmp_name'];

                	if($nama_file == "" || $_REQUEST['password'] == ""){
                        $_SESSION['errEmpty'] = 'ERROR! Semua Form wajib diisi';
                        header("Location: ./admin.php?page=sett&sub=rest");
                        die();
                    } else {

                        $password = $_REQUEST['password'];
                        $id_user = $_SESSION['id_user'];

                        $query = mysqli_query($koneksi, "SELECT password FROM tbl_user WHERE id_user='$id_user' AND password=MD5('$password')");
                        if(mysqli_num_rows($query) > 0){

                    		$alamatfile	= $rest_dir.$nama_file;
                    		$templine	= array();

                            $ekstensi = array('sql');
                            $nama_file	= $file['name'];
                            $x = explode('.', $nama_file);
                            $eks = strtolower(end($x));

                            //validasi tipe file
                            if(in_array($eks, $ekstensi) == true){

                        		if(move_uploaded_file($tmp_file , $alamatfile)){

                        			$templine	= '';
                        			$lines		= file($alamatfile);

                        			foreach ($lines as $line){
                        				if(substr($line, 0, 2) == '--' || $line == '')
                        					continue;

                        				$templine .= $line;

                        				if(substr(trim($line), -1, 1) == ';'){
                        					mysqli_query($koneksi, $templine);
                        					$templine = '';
                        				}
                        			}
                                    $_SESSION['succRestore'] = 'SUKSES! Database berhasil direstore';
                                    header("Location: restore_admin.php?page=sett&sub=rest");
                                    die();
                        		} else {
                                    $_SESSION['errUpload'] = 'ERROR! Proses upload database gagal';
                                    header("Location: restore_admin.php?page=ref&act=imp");
                                    die();
                    		    }
                            } else {
                                $_SESSION['errFormat'] = 'ERROR! Format file yang diperbolehkan hanya *.SQL';
                                header("Location: restore_admin.php?page=sett&sub=rest");
                                die();
                            }
                        } else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! Password salah. Anda mungkin tidak memiliki akses ke halaman ini");
                                    window.location.href="./logout.php";
                                  </script>';
                        }
                	}
                }

                //restore database
                if(isset($_POST['restore'])){

                    restore($_FILES['file']);

                } else {
                    echo '              
                    <form method="post" action="" enctype="multipart/form-data">
                        
                        <div class="form-group">
                        <label>File input</label>
                        <input type="file" name="file" accept=".sql" required>
                        <input class="file-path validate form-control" placeholder="Upload file backup database sql" type="text">
                     
                        </div><!-- /.col -->
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        
                        <input id="password_lama" type="password" class="validate form-control" name="password" placeholder="Password" required>
       
                      </div>
                  
                          <button type="submit" name="restore" class="btn btn-primary">Restore</button>
                 
                          </form>    
                          
       ';
                }
            ?>

              </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
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