
<?php include 'sidebar.php'; ?>
<!-- isinya -->
<?php
$i1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(qty)  as totqty FROM laporan WHERE cart_type='SELL'"));
$i2 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(qty*harga_modal) as totdpt FROM laporan WHERE cart_type='SELL'"));
$i3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(subtotal-qty*harga_modal) as totdpt1 FROM laporan WHERE cart_type='SELL'"));
$i4 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(subtotal) as isub FROM laporan WHERE cart_type='SELL'"));
?>
    <h1 class="h3 mb-2">Data Laporan</h1>
        <div class="row">

            <div class="col-6 col-sm-6 col-md-3 col-lg-3 m-pr-1 m-mb-1">
                <div class="box-laporan">
                    <p class="small mb-0">Terjual</p>
                    <h5 class="mb-0"><?php echo ribuan($i1['totqty']); ?></h5>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-3 col-lg-3 m-pl-1 m-mb-1">
                <div class="box-laporan">
                    <p class="small mb-0">Pendapatan</p>
                    <h5 class="mb-0">Rp.<?php echo ribuan($i3['totdpt1']); ?></h5>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-3 col-lg-3 m-pr-1">
                <div class="box-laporan">
                    <p class="small mb-0">Penjualan</p>
                    <h5 class="mb-0">Rp.<?php echo ribuan($i2['totdpt']); ?></h5>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-3 col-lg-3 m-pl-1">
                <div class="box-laporan">
                    <p class="small mb-0">Total</p>
                    <h5 class="mb-0">Rp.<?php echo ribuan($i4['isub']); ?></h5>
                </div>
            </div>

        </div>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="laporanTbl" width="100%">
<thead>
  <tr>
    <th>No</th>
    <th>Invoice</th>
    <th>Qty</th>
    <th>SubTotal</th>
    <th>Pembayaran</th>
    <th>Kembalian</th>
    <th>Tanggal</th>
    <th>Opsi</th>
  </tr>
</thead>
</table>
<?php 
if(isset($_POST['Remove'])){
  $nona = $_POST['nona'];
  $hapus_data_Cart_all = mysqli_query($conn, "DELETE FROM laporan WHERE invoice='$nona'");
    $hapus_data_Cart_all1 = mysqli_query($conn, "DELETE FROM inv WHERE invoice='$nona'");
    if($hapus_data_Cart_all&&$hapus_data_Cart_all1){
      echo '<script>;window.location="laporan.php"</script>';
  } else {
      echo '<script>alert("Gagal Hapus Data keranjang");history.go(-1);</script>';
  }
};
    ?>

<!-- end isinya -->
<?php include 'footer.php'; ?>