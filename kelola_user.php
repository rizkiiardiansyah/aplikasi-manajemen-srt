  
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
            List User
            <small>Data User</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data User</li>
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
     <a href="tambah_userr.php" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
    </div>
    <br/>

<?php    $query = mysqli_query($config,"SELECT * FROM tbl_user ORDER BY id_user DESC");?>
    <table id="data" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
    <th width="5%">No</th>
                                        <th width="20%">Username</th>
                                        <th width="20%">NIP</th>
                                        <th width="24%">Nama</th>
                                        <th width="15%">Level</th>
                                        <th width="16%">Tindakan</th>
</tr>
    </thead>

      <tr>  

      <?php if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                    echo '<td>'.$no++.'</td>';

                                    if($row['admin'] == 1){
                                        $row['admin'] = 'Super Admin';
                                    } elseif($row['admin'] == 2){
                                        $row['admin'] = 'Administrator';
                                    } else {
                                        $row['admin'] = 'User Biasa';
                                    } echo '<td>'.$row['username'].'</td>
                                    <td>'.$row['nip'].'</td>
                                                    
                                    <td>'.$row['nama'].'</td>
                                            <td>'.$row['admin'].'</td>
                                            <td>';

                                    if($_SESSION['username'] == $row['username']){
                                        echo '<button class="btn bg-navy margin disabled"><i class="fa fa-ban"></i> No Action</button>';
                                    } else {

                                        if($row['id_user'] == 1){
                                            echo '<button class="btn bg-navy margin disabled"><i class="fa fa-ban"></i> No Action</button>';
                                        } else {
                                          echo ' <a class="btn btn-info" href="edit_user.php?&id_user='.$row['id_user'].'">
                                                 <i class="fa fa-pencil"></i> Edit</a>
                                                 <a class="btn btn-danger" href="hapus_user.php?&id_user='.$row['id_user'].'"><i class="fa fa-trash"></i> Delete</a>';
                                        }
                                    } echo '</td>
                                    </tr>';
                                    $no++;
                                    

                                  }
                                  }
                                ?>
        </tbody>
    </table>
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