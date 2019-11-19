  
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
    @media print{
        body {
            font-size: 12px!important;
            color: #212121;
        }
        .disp {
            text-align: center;
            margin: -.20rem 0;
        }
        .up{
        padding-top:15px;
        margin-top: -50px;
        }
        .kanan{
            position:fixed;
            padding-top: 560px;
            margin-left: 780px;
        }
        .pimpinan{
            padding-top: 150px;

        }
        .hidd {
            display: block
        }
        .logodisp {
            float: left;
            position: relative;
            width: 80px;
            height: 80px;
            margin-top: 15px;
        }
        #nama {
            font-size: 20px!important;
            text-transform: uppercase;
            font-weight: bold;
            margin: -2.5rem 0 -3.7rem 0;
        }
        .up {
            font-size: 17px!important;
            font-weight: normal;
            text-transform: uppercase
        }
        .status {
            font-size: 17px!important;
            font-weight: normal;
            margin-bottom: -.1rem;
        }
        #alamat {
            margin-top: -15px;
            font-size: 13px;
        }

        .separator {
            border-bottom: 2px solid #616161;
            margin: 1rem 0 -.7rem;
        }
    }
      </style>';

      include("admin/head-collapse.php");
 
      include("admin/sidebar.php");
      include("admin/list-data.php");
      
   if(isset($_REQUEST['submit'])){

$dari_tanggal = $_REQUEST['dari_tanggal'];
$sampai_tanggal = $_REQUEST['sampai_tanggal'];

if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
    header("Location: agenda_keluar.php");
    die();
} else {

    $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE tgl_catat BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");

    $query2 = mysqli_query($config, "SELECT nama FROM tbl_instansi");
    list($nama) = mysqli_fetch_array($query2);
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
                          <div class="disp hidd">';
                          $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                          list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                          if(!empty($logo)){
                              echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                          } else {
                              echo '<img class="logodisp" src="./asset/img/logo.png"/>';
                          }
                          if(!empty($institusi)){
                              echo '<h6 class="up">'.$institusi.'</h6>';
                          } else {
                              echo '<h6 class="up">------------------------</h6>';
                          }
                          if(!empty($nama)){
                              echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>';
                          } else {
                              echo '<h5 class="up" id="nama">SMK Al - Husna Loceret Nganjuk</h5><br/>';
                          }
                          if(!empty($status)){
                              echo '<h6 class="status">'.$status.'</h6>';
                          } else {
                              echo '<h6 class="status">--------------------</h6>';
                          }
                          if(!empty($alamat)){
                              echo '<span id="alamat">'.$alamat.'</span>';
                          } else {
                              echo '<span id="alamat">Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471</span>';
                          }
                          echo '
                      </div>
                      </div>
                      <div class="separator"></div>
                      <div class="center">
                      <h3 class="hid">AGENDA SURAT KELUAR</h3>';

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
                      </div>
                      <div class="col-md-3"></div>
                                      <div class="col-md-7">
                                      <p class="warna agenda">Agenda Surat Masuk dari tanggal <strong>'.$d." ".$nm." ".$y.'</strong> sampai dengan tanggal <strong>'.$d2." ".$nm2." ".$y2.'</strong></p>
                                  </div>
                                  <div class="col-md-2" id="cetak1">
                                  <button class="btn btn-warning btn-lg btn-block" type="submit" onClick="window.print()">
                                  <span class="glyphicon glyphicon-print"></span>   CETAK</button>
                              </div>                
                
                              </div>
                              <div id="colres" class="warna cetak">
                
                                  <table class="bordered" id="dataTables" width="100%">
                                      <thead class="blue lighten-4">
                                          <tr>
                                              <th width="3%">No</th>
                                              <th width="21%">Isi Ringkas</th>
                                              <th width="18%">Tujuan</th>
                                              <th width="15%">Nomor Surat</th>
                                              <th width="15%">Tanggal Surat</th>
                                              <th width="10%">Pengelola</th>
                                              <th width="10%">Keterangan</th>
                                          </tr>
                                      </thead>
                
                                      <tbody>
                                          <tr>';
                
                                      if(mysqli_num_rows($query) > 0){
                                          $no = 0;
                                          while($row = mysqli_fetch_array($query)){
                                           echo '
                                                  <td width="3%">'.$row['no_agenda'].'</td>
                                                  <td width="21%">'.$row['isi'].'</td>
                                                  <td width="18%">'.$row['tujuan'].'</td>
                                                  <td width="15%">'.$row['no_surat'].'</td>';
                
                                                  $y = substr($row['tgl_surat'],0,4);
                                                  $m = substr($row['tgl_surat'],5,2);
                                                  $d = substr($row['tgl_surat'],8,2);
                
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
                                                  <td width="8%">'.$d." ".$nm." ".$y.'</td>
                                                  <td width="10%">';
                
                                                  $id_user = $row['id_user'];
                                                  $query3 = mysqli_query($config, "SELECT nama FROM tbl_user WHERE id_user='$id_user'");
                                                  list($nama) = mysqli_fetch_array($query3);{
                                                      $row['id_user'] = ''.$nama.'';
                                                  }
                
                                                  echo ''.$row['id_user'].'</td>
                                                  <td width="10%">'.$row['keterangan'].'';
                                            echo '</td>
                                          </tr>
                                      </tbody>';
                                          }
                                      } else {
                                          echo '<tr><td colspan="9"><center><p class="add">Tidak ada agenda surat</p></center></td></tr>';
                                      } echo '
                                  </table>
                              </div></div>
                            
                              ';
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


  <script src="admin/datetimepicker/jquery.datetimepicker.js"></script>
    
    <script>
   
         $('#dari_tanggal').datetimepicker({
         lang:'en',
         timepicker:false,
         format:'Y-m-d',
         closeOnDateSelect:true
       });
       $('#sampai_tanggal').datetimepicker({
         lang:'en',
         timepicker:false,
         format:'Y-m-d',
         closeOnDateSelect:true
       });
       
         </script>
   