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
        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
                    <div class="col m12">
                        <div class="card red lighten-5">
                            <div class="card-content notif">
                                <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                            </div>
                        </div>
                    </div>
                </div>';
            unset($_SESSION['errQ']);
        }
    	$id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);

    	$query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");


    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=tsm";
                      </script>';
            } else {

    		  echo '
                <!-- Row form Start -->
                <!-- Row form Start -->
                <section class="content">
                          <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">            
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
                            <td width="13%">Tujuan</td>
                            <td width="1%">:</td>
                            <td width="86%">'.$row['tujuan'].'</td>
                        </tr>
                        <tr>
                            <td width="13%">Isi Disposis</td>
                            <td width="1%">:</td>
                            <td width="86%">'.$row['isi_disposisi'].'</td>
                        </tr>
                        <tr>
                            <td width="13%">Sifat</td>
                            <td width="1%">:</td>
                            <td width="86%">'.$row['sifat'].'</td>
                        </tr>
                        <tr>
                            <td width="13%">Batas Waktu</td>
                            <td width="1%">:</td>
                            <td width="86%">'.date('d M Y', strtotime($row['batas_waktu'])).'</td>
                        </tr>
                        <tr>
                            <td width="13%">Catatan</td>
                            <td width="1%">:</td>
                            <td width="86%">'.$row['catatan'].'</td>
                        </tr>
    			            </tbody>
    			   		</table>
                        </div>
                        <div class="box-footer">
                        <a href="disp.php?=disp&id_surat='.$row['id_surat'].'" class="btn btn-info">Batal</a>
                        <a href="hapus_disp.php?id_surat='.$row['id_surat'].'&sub=del&submit=yes&id_disposisi='.$row['id_disposisi'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                      
                        </div>
                        </div><!-- /.box -->
                        <!-- Row form END -->
                        
                                       
                        </div>
                                  </div><!-- /.row -->
                                </section><!-- /.content -->
                                </div>
                                
                                <!-- /.row -->
                                <!-- Row form END -->';
                                include("admin/footer.php");
                                 include("admin/js.php");

            if(isset($_REQUEST['submit'])){
                $id_disposisi = $_REQUEST['id_disposisi'];

                $query = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

                if($query == true){
                    $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus ';
                    echo '<script language="javascript">
                            window.location.href="disp.php?id_surat='.$row['id_surat'].'";
                          </script>';
                } else {
                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                    echo '<script language="javascript">
                            window.location.href="hapus_disp.php?id_surat='.$row['id_surat'].'&sub=del&id_disposisi='.$row['id_disposisi'].'";
                          </script>';
                }
                    }
                }
    	    }
        }
    }

?>
