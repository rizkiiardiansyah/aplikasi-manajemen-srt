  
  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
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
            Detail Surat Keluar
            <small>Data Surat Keluar</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Keluar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
              
            <div class="col-md-5">
            <div class="box box-info collapsed-box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Tampilkan Detail Surat Keluar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                
<?php            
        $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){
                echo '
                <table class="table">
                <thead>
            
                </thead>
                <tbody>
                <tr>
                <td width="30%">No. Agenda</td>
                <td width="1%">:</td>
                <td width="69%">'.$row['no_agenda'].'</td>
            </tr>

            <tr>
            <td width="13%">Isi Ringkasan</td>
            <td width="1%">:</td>
            <td width="86%">'.$row['isi'].'</td>
            </tr>
            <tr>
                <td width="13%">Asal Surat</td>
                <td width="1%">:</td>
                <td width="86%">'.$row['tujuan'].'</td>
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
       </table>';
       ?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->
              <a class="btn btn-danger" href="surat_keluar.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali</a>

              </div><!-- /.box -->

<?php
if(empty($row['file'])){
                            echo '';
                        } else {

                            $ekstensi = array('jpg','png','jpeg');
                            $ekstensi2 = array('doc','docx');
                            $file = $row['file'];
                            $x = explode('.', $file);
                            $eks = strtolower(end($x));

                            if(in_array($eks, $ekstensi) == true){
                                echo '
                                <div class="col-md-7">     
                                <img class="gbr" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                               
                                </div>
                                ';
                            } else {

                                if(in_array($eks, $ekstensi2) == true){
                                    echo '
                                    <div class="col-md-7">
                                    <div class="box box-info">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Document</h3>
                                      <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                      </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="card" style="width: 18rem;">
                                    <img class="file card-img-top" src="./asset/img/word.png">
                                  
                                  </div>  
                                  <br/>
                                  <p class="card-text">File lampiran surat keluar ini bertipe <strong>document</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.<br/>
                                    <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_keluar/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
                </p>
                </div>
                                   
                                  </div>                
                                  
                                                          
                                    </div>
                             
                                   
                                  
                                    ';
                                } else {
                                    echo '
                                    <div class="col-md-7">
                                    <div class="box box-info">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Document</h3>
                                      <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                      </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="card" style="width: 18rem;">
                                    <img class="file card-img-top" src="./asset/img/pdf.png">
                                   
                                  </div>  
                                  <br/>
                                  <p class="card-text">
                                    File lampiran surat keluar ini bertipe <strong>PDF</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.
                                                            <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_keluar/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
</p>                               
                </div>
                                   
                                  </div>                
                                  
                                                          
                                    </div>';
                                }
                            }
                        } echo '';
        ?>

      
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