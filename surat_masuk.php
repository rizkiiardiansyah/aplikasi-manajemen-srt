  
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
            List Surat Masuk
            <small>Data Surat Masuk Keseluruhan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Masuk</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body">

                <?php
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
                      </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>
    <div align="left">
     <a href="tambah_masuk.php" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
    </div>
    <br/>

<?php    $query = mysqli_query($config,"SELECT * FROM tbl_surat_masuk ORDER BY id_surat DESC");?>
<div class="table-responsive">
    <table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
    <th width="5%">No</th>
    <th width="10%">No. Agenda</th>
    <th width="20%">File/Isi Ringkas</th>
<th width="15%">No. Surat/Asal Surat</th>
<th width="10%">Tanggal Surat</th>
<th width="15%">Tindakan </th>
</tr>
    </thead>

      <tbody>  
      <?php if(mysqli_num_rows($query)>0){ ?>
        <?php
            $no = 1;
            while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data["no_agenda"];?></td>
            <td>File:             <?php if(!empty($data['file'])){
                                            echo ' <strong><a href="detail_masuk.php?id_surat='.$data['id_surat'].'">'.$data['file'].'</a></strong>';
                                        } else {
                                            echo '<em>Tidak ada file yang di upload</em>';
                                        } ?>
<hr/><?php echo $data["isi"];?></td>
            
            <td><?php echo $data["no_surat"];?><hr/><?php echo $data["asal_surat"];?></td>
         
          <?php  
          $y = substr($data['tgl_surat'],0,4);
      $m = substr($data['tgl_surat'],5,2);
      $d = substr($data['tgl_surat'],8,2);

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
          echo '<td>'.$d." ".$nm." ".$y.'</td>

            <td>
                <a class="btn btn-primary" href="edit_masuk.php?id_surat='.$data['id_surat'].'"><span class="glyphicon glyphicon-pencil"></span> Edit</a> 
                <a href="disp.php?id_surat='.$data['id_surat'].'" class="btn btn-success"><span class="glyphicon glyphicon-tag"></span> Disposisi</a><br/><br/>
                <a href="cetak_disp.php?id_surat='.$data['id_surat'].'" class="btn btn-warning" target="_blank"><span class="glyphicon glyphicon-print"></span> Print</a> 
             <a class="btn btn-danger" href="hapus_masuk.php?id_surat='.$data['id_surat'].'"><span class="glyphicon glyphicon-trash"></span> Hapus</a> 
                
            </td>
        </tr>
        '?>
  <?php $no++; } ?>
        <?php } ?>
        </tbody>
    </table>
    </div>
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