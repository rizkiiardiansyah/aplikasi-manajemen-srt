  
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
            List Disposisi
            <small>Data Disposisi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Disposisi</li>
          </ol>
        </section>

        <!-- Main content -->
<style>
    p{
        padding-left: 28px;
    }
    </style>
          <?php  


          $id_surat = $_REQUEST['id_surat'];

          $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

          if(mysqli_num_rows($query) > 0){
              $no = 1;
              while($row = mysqli_fetch_array($query)){

              if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                  echo '<script language="javascript">
                          window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                          window.location.href="./admin.php?page=tsm";
                        </script>';
              } else {

                echo '


<!-- Row form Start -->
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">       
            
           
          <!-- general form elements -->
              <div class="box box-success">
             
                <!-- form start -->
                  <div class="box-body">';
                  if(isset($_SESSION['succAdd'])){
                    $succAdd = $_SESSION['succAdd'];
      echo '<div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-check"></i>  
      '.$succAdd.'
      </div> ';
                    unset($_SESSION['succAdd']);
                }
                if(isset($_SESSION['succEdit'])){
                    $succEdit = $_SESSION['succEdit'];
                    echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i>  
                    '.$succEdit.'
                  </div>';
                    unset($_SESSION['succEdit']);
                }
                if(isset($_SESSION['succDel'])){
                    $succDel = $_SESSION['succDel'];
                    echo '
                    <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i>  
                    '.$succDel.'
                  </div>
                  
                  ';
                    unset($_SESSION['succDel']);
                }  
                  echo'
                  <div align="left">
                  <a class="btn btn-danger" href="surat_masuk.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali</a>
                  <a class="btn btn-success" href="tambah_disp.php?id_surat='.$row['id_surat'].'"><span class="glyphicon glyphicon-plus"></span> Tambah Disposisi</a> 
       
              
                  </div>
                 <br/>

                 ';
                
              
                 echo'                 <div class="alert alert-info alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-inbox"></i>Perihal Surat: </h4><p> '.$row['isi'].'    
               </p></div>';
                 $query2 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat' ORDER BY id_disposisi DESC");
                 echo '
                 <div class="table-responsive">
                 <table id="data2" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                 <tr>
                 <th width="5%">No</th>
                 <th width="10%">Tujuan</th>
                 <th width="19%">Isi Disposisi</th>
             <th width="15%">Sifat</th>
             <th width="11%">Batas Waktu</th>
             <th width="15%">Tindakan </th>
             </tr>
                 </thead>
             
                   <tbody>';  

                    if(mysqli_num_rows($query2)>0){ 
                    
                        $no = 1;
                        while($row = mysqli_fetch_array($query2)){
                
                        echo '                   <tr> 
                        <td>'.$no.'</td>
                               <td>'.$row['tujuan'].'</td>
                               <td>'.$row['isi_disposisi'].'</td>';

                               $y = substr($row['batas_waktu'],0,4);
                               $m = substr($row['batas_waktu'],5,2);
                               $d = substr($row['batas_waktu'],8,2);

                               if($m == "01"){
                                   $nm = "Januari";
                               } elseif($m == "02"){
                                   $nm = "Februari";
                               } elseif($m == "03"){
                                   $nm = "Maret";
                               } elseif($m == "04"){
                                   $nm = "April";
                               } elseif($m == "05"){
                                   $nm = "Mei";
                               } elseif($m == "06"){
                                   $nm = "Juni";
                               } elseif($m == "07"){
                                   $nm = "Juli";
                               } elseif($m == "08"){
                                   $nm = "Agustus";
                               } elseif($m == "09"){
                                   $nm = "September";
                               } elseif($m == "10"){
                                   $nm = "Oktober";
                               } elseif($m == "11"){
                                   $nm = "November";
                               } elseif($m == "12"){
                                   $nm = "Desember";
                               }
                               echo '

                               <td>'.$row['sifat'].'</td>
                               <td>'.$d." ".$nm." ".$y.'</td>
                               <td>
                               <a class="btn btn-primary" href="edit_disp.php?id_surat='.$id_surat.'&sub=hapus&id_disposisi='.$row['id_disposisi'].'"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                               <a class="btn btn-danger" href="hapus_disp.php?id_surat='.$id_surat.'&sub=hapus&id_disposisi='.$row['id_disposisi'].'"><span class="glyphicon glyphicon-trash"></span> Hapus</a> 
          
                               </td>
                       </tr>';
                       $no++; } 
                       } 
                   
           echo '
           </tbody>
           </table>
           </div>
                    ';
                 ?>
                </div><!-- /.box-body -->



              </div><!-- /.box -->
              
               
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