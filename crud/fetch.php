<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_surat_masuk ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE no_agenda LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR isi LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR asal_surat LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tgl_surat LIKE "%'.$_POST["search"]["value"].'%" ';

}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id_surat DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $file = '';
 if($row["file"] != '')
 {
  $file = '<img src="../upload/surat_masuk/'.$row["file"].'" class="img-thumbnail" width="50" height="35" />';
 }
 else
 {
  $file = '';
 }

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
 
 $tanggal= [$d,$nm,$y];
  $sub_array = array();
 $sub_array[] = $file;
 $sub_array[] = $row["no_agenda"];
 $sub_array[] = $row["isi"];
 $sub_array[] = $row["asal_surat"];
 $sub_array[] = $tanggal;
 $sub_array[] = ['<button type="button" name="update" id="'.$row["id_surat"].'" class="btn btn-warning btn-xs update">Update</button>', '<button type="button" name="delete" id="'.$row["id_surat"].'" class="btn btn-danger btn-xs delete">Delete</button>'];
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>