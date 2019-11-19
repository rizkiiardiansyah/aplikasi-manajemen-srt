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
 <?php include('../admin/head1.php');?>
 <?php include('../admin/sidebar.php');?>
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
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body">

  
   <div class="table-responsive">
   
    <div align="left">
    
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Tambah Data</button>
    </div>
    <br/>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
      
      <th width="10%">File</th>
      <th width="10%">No Agenda</th>
       <th width="30%">Isi Ringkasan</th>
       <th width="20%">Asal Surat</th>
       <th width="20%">Tanggal Surat</th>
       <th width="10%">Tindakan</th>

      </tr>
     </thead>
    </table>
    
   </div>
  </div>
 </body>
</html>

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add User</h4>
    </div>
    <div class="modal-body">
     <label>Enter First Name</label>
     <input type="text" name="first_name" id="first_name" class="form-control" />
     <br />
     <label>Enter Last Name</label>
     <input type="text" name="last_name" id="last_name" class="form-control" />
     <br />
     <label>Select User Image</label>
     <input type="file" name="user_image" id="user_image" />
     <span id="user_uploaded_image"></span>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>
</div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </div><!-- /.row -->
     <!-- jQuery 2.1.3 -->
    <?php include("../admin/footer.php");?>

    <?php include("../admin/js1.php");?>
    
     <?php
    }
?>