<?php
## Database configuration
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
// $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnName = 'invid';
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (invoice like '%".$searchValue."%' or 
        tgl_inv like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from inv WHERE transaction_type='SELL' AND status='OK' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from inv WHERE 1 AND transaction_type='SELL' AND status='OK' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$invQuery = "select * from inv WHERE 1  AND transaction_type='SELL'  AND status='OK' ".$searchQuery."  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$invRecords = mysqli_query($conn, $invQuery);
$data = array();
$no = 1;
// echo $invQuery;

while ($rowd = mysqli_fetch_assoc($invRecords)) {
    $no = $rowd['invid'];
    $oninv = $rowd['invoice'];
    
    $result1 = mysqli_query($conn,"SELECT SUM(qty) AS count FROM laporan WHERE  invoice='$oninv' ");
    // $cekrow = mysqli_num_rows($result1);
    $row1 = mysqli_fetch_assoc($result1);
    $count = $row1['count'];
    $result2 = mysqli_query($conn,"SELECT SUM(subtotal) AS count1 FROM laporan WHERE  invoice='$oninv'");
    // $cekrow1 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_assoc($result2);
    $count1 = $row2['count1'];

   

   $data[] = array( 
      "no"=>$no,
      "invoice"=>$oninv,
      "qty"=>$count,
      "subtotal"=>$count1,
      "pembayaran"=>$rowd['pembayaran'],
      "kembalian"=>$rowd['kembalian'],
      "tanggal"=>$rowd['tgl_inv'],
      "tombol"=>$oninv
      
   );   
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data,
  "row" => $invQuery
);

echo json_encode($response);

?>