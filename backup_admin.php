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
            Backup Database
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Backup Database</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body">                

<?php
 // download file hasil backup
                if(isset($_REQUEST['nama_file'])){

                    $back_dir = "./";
                	$file = $back_dir.$_REQUEST['nama_file'];

                    $x = explode('.', $file);
                    $eks = strtolower(end($x));

                    if($eks == 'sql'){

                    	if(file_exists($file)){
                    		header('Content-Description: File Transfer');
                    		header('Content-Type: application/octet-stream');
                    		header('Content-Disposition: attachment; filename='.($file));
                    		header('Content-Transfer-Encoding: binary');
                    		header('Expires: 0');
                    		header('Cache-Control: private');
                    		header('Pragma: private');
                    		header('Content-Length: ' . filesize($file));
                    		ob_clean();
                    		flush();
                    		readfile($file);
                    		exit;
                    	} else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! File sudah tidak ada");
                                    window.location.href="./admin.php?page=sett&sub=back";
                                  </script>';
                        }
                    } else {
                        if($_SESSION['id_user'] == 1){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Format file yang boleh didownload hanya *.SQL");
                                    window.location.href="./logout.php";
                                  </script>';
                        }
                    }
                }

                // proses backup  database dilakukan oleh Fungsi
                function backup($host,$user,$pass,$name,$nama_file,$tables){

                    //untuk koneksi database
                    $return = "";
                    $link = mysqli_connect($host,$user,$pass,$name);

                    //backup semua tabel database
                    if($tables == '*'){
                        $tables = array();
                        $result = mysqli_query($link, 'SHOW TABLES');
                        while($row = mysqli_fetch_row($result)){
                            $tables[] = $row[0];
                        }
                    } else {

                        //backup tabel tertentu
                        $tables = is_array($tables) ? $tables : explode(',',$tables);
                    }

                    //looping table
                    foreach($tables as $table){
                        $result = mysqli_query($link, 'SELECT * FROM '.$table);
                        $num_fields = mysqli_num_fields($result);

                        $return.= 'DROP TABLE '.$table.';';
                        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
                        $return.= "\n\n".$row2[1].";\n\n";

                        //looping field table
                        for($i = 0; $i < $num_fields; $i++){
                            while($row = mysqli_fetch_row($result)){
                                $return.= 'INSERT INTO '.$table.' VALUES(';

                                for($j=0; $j<$num_fields; $j++){
                                    $row[$j] = addslashes($row[$j]);
                                    $row[$j] = preg_replace("/\n/","\\n",$row[$j]);

                                    if(isset($row[$j])){
                                        $return.= '"'.$row[$j].'"' ;
                                    } else {
                                        $return.= '""';
                                    }
                                    if ($j<($num_fields-1)){
                                        $return.= ',';
                                    }
                                }
                                $return.= ");\n";
                            }
                        }
                        $return.="\n\n\n";
                    }

                    //otomatis menyimpan hasil backup database dalam root folder aplikasi
                    $nama_file;
                    $handle = fopen($nama_file,'w+');
                    fwrite($handle,$return);
                    fclose($handle);
                }

                //nama database hasil backup
                $database = 'Backup';
                $file = $database.'_'.date("d_M_Y").'_'.time().'.sql';

                //backup database
                if(isset($_REQUEST['backup'])){

                    //konfigurasi database dan backup semua tabel
                    backup("localhost","root","","ams_native",$file,"*");

                    //backup hanya tabel tertentu
                    //backup("localhost","user_database","pass_database","nama_database",$file,"tabel1,tabel2,tabel3");

                  echo '
                  <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fa fa-success"></i>  
                  SUKSES! Database berhasil dibackup
                </div>
                <p>Silakan klik tombol <strong>"Download"</strong> dibawah ini untuk mendownload file backup database.</p>
                <form method="post" enctype="multipart/form-data">

                <a href="backup_admin.php?&nama_file='.$file.'" class="btn btn-primary btn-lg"><span class="fa fa-cloud-download"></span> Download</a>

                </form>                  
                ';
                } else {

                    echo '

                    <h2>Backup Database</h2>
                    <p>Lakukan backup database secara berkala untuk membuat cadangan database yang bisa direstore kapan saja ketika dibutuhkan. 
                    Silakan klik tombol "Backup" untuk memulai proses backup data. 
                    Setelah proses backup selesai, silakan download file backup database tersebut dan simpan di lokasi yang aman.*</p>
                    <p> * Sangat tidak disarankan menyimpan file backup database dalam my documents / Local Disk C.</p>
                    <form method="post" enctype="multipart/form-data" >
                   <button type="submit"class="btn btn-primary btn-lg"  name="backup"><span class="fa fa-cloud-upload"> Backup</span></button>
                   </form>
                ';
                }
            
?>                 </div><!-- /.box-body -->
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