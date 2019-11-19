  
  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
      echo'
      <style type="text/css">
      .center{
        text-align: center;
      }
      #cetak1{
          margin-top: -30px;
      }
   


      .hidd {
        display: none
    }
  </style>';

      include("admin/head.php");
 
      include("admin/sidebar.php");?>
      <div class="content-wrapper">
      <section class="content-header">
          <h1>
            Laporan Galeri Surat Masuk
            <small>Data Surat Masuk per periode tanggal</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Surat Keluar</li>
          </ol>
        </section>
        <section class="content">
        <div class="box box-solid">
          <div class="row">
            <div class="col-xs-12">
              <div class="box-header">
                  <h3 class="box-title">Masukan Periode Tanggal</h3>
                </div>
      
<?php 
  if(isset($_REQUEST['submit'])){

$dari_tanggal = $_REQUEST['dari_tanggal'];
$sampai_tanggal = $_REQUEST['sampai_tanggal'];

if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
    header("Location: agenda_masuk.php");
    die();
} else {

    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY tgl_diterima ASC");

    echo '

                <div class="box-body">
                <div class="jarak-form">
                  <div class="row">
              <form method="post" action="">
                  <div class="col-xs-3">
                      <input type="text" id="dari_tanggal" name="dari_tanggal" class="form-control" placeholder="Dari Tanggal" autocomplete="off" required>
                    </div>
                    <div class="col-xs-3">
                      <input type="text" id="sampai_tanggal" name="sampai_tanggal" class="form-control" placeholder="Sampai Tanggal" autocomplete="off" required">
                    </div>
                    <div class="col-xs-5">
                    <button type="submit" name="submit" class="btn btn-primary">Tampilkan</button>
                  </div>
                    </form>    
                    </div>
                  </div>
                  </div>
                  
                          <div class="box-body">

                          <div class="row agenda">
                          <div class="col-md-12">
                      
                      </div>
                      <div class="separator"></div>
                      <div class="center">
                      <h3>GALERI SURAT MASUK</h3>';

                      $y = substr($dari_tanggal,0,4);
                      $m = substr($dari_tanggal,5,2);
                      $d = substr($dari_tanggal,8,2);
                      $y2 = substr($sampai_tanggal,0,4);
                      $m2 = substr($sampai_tanggal,5,2);
                      $d2 = substr($sampai_tanggal,8,2);

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

                      if($m2 == "01"){
                          $nm2 = "Januari";
                      } elseif($m2 == "02"){
                          $nm2 = "Februari";
                      } elseif($m2 == "03"){
                          $nm2 = "Maret";
                      } elseif($m2 == "04"){
                          $nm2 = "April";
                      } elseif($m2 == "05"){
                          $nm2 = "Mei";
                      } elseif($m2 == "06"){
                          $nm2 = "Juni";
                      } elseif($m2 == "07"){
                          $nm2 = "Juli";
                      } elseif($m2 == "08"){
                          $nm2 = "Agustus";
                      } elseif($m2 == "09"){
                          $nm2 = "September";
                      } elseif($m2 == "10"){
                          $nm2 = "Oktober";
                      } elseif($m2 == "11"){
                          $nm2 = "November";
                      } elseif($m2 == "12"){
                          $nm2 = "Desember";
                      }
                      echo '
                     
                      <div class="col-md-12">
                      <p>Galeri Surat Masuk dari tanggal <strong>'.$d." ".$nm." ".$y.'</strong> sampai dengan tanggal <strong>'.$d2." ".$nm2." ".$y2.'</strong></p>
                      </div>

                      </div>
              </div>                

              </div>';

              if(mysqli_num_rows($query) > 0){
                             
              while($row = mysqli_fetch_array($query)){

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
                    <div class="col-md-3">
                
                    <img class="gbr1" data-caption="'.date('d M Y', strtotime($row['tgl_diterima'])).'" src="./upload/surat_masuk/'.$row['file'].'"/>
                 <div class="card-body">
                <center> <a class="btn btn-success" href="detail_masuk.php?id_surat='.$row['id_surat'].'" target="_blank">Tampilkan Ukuran Penuh</a>
                </center></div>       <br/> 
                </div>
                    
                        ';
                    } else {
                
                        if(in_array($eks, $ekstensi2) == true){
                        echo '
                        <div class="col-md-3">
                    
                        <img class="gbr1" data-caption="'.date('d M Y', strtotime($row['tgl_diterima'])).'" src="./asset/img/word.png"/>
                     <div class="card-body">
                     <center><a class="btn btn-success" href="detail_masuk.php?id_surat='.$row['id_surat'].'" target="_blank">Lihat Detail File</a>
                     </center></div>
                     <br/>              
                </div>   ';
                        } else {
                            echo '
                            <div class="col-md-3">
                
                            <img class="gbr1" data-caption="'.date('d M Y', strtotime($row['tgl_diterima'])).'" src="./asset/img/pdf.png"/>
                         <div class="card-body">
                         <center><a class="btn btn-success" href="detail_masuk.php?id_surat='.$row['id_surat'].'" target="_blank">Lihat Detail File</a>
                         </center></div>
                         <br/>  
                      </div>
                    ';
                        }
                    }
                }
                }
             } else {
                echo '
                <div class="col-md-12">
                    
                            <span class="card-title lampiran"><center>Tidak ada data untuk ditampilkan</center></span>
                </div>';
                }
            }
                    }
                    else {
echo '  <div class="box-body">
<div class="jarak-form">
<div class="row">
<form method="post" action="">
<div class="col-xs-3">
    <input type="text" id="dari_tanggal" name="dari_tanggal" class="form-control" placeholder="Dari Tanggal" autocomplete="off" required>
  </div>
  <div class="col-xs-3">
    <input type="text" id="sampai_tanggal" name="sampai_tanggal" class="form-control" placeholder="Sampai Tanggal" autocomplete="off" required">
  </div>
  <div class="col-xs-5">
  <button type="submit" name="submit" class="btn btn-primary">Tampilkan</button>
  
</div>
  </form>    
<br>
<br>
</div>
</div>
</div>';
                        

 
}
include("admin/tutup-data.php");
include("admin/footer.php");
     include("admin/js.php");        
}
?>



   



