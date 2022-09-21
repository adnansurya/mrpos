</div><!-- end container-fluid" -->
  </main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-body text-center">
      <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
        <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
        <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-primary px-4">Keluar</a>
    </div>
  </div>
</div>
<!-- end Modal Exit -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">

      function ribuanJs(angka){
        let numberFormatter = Intl.NumberFormat('id-ID');
        return numberFormatter.format(angka);
      }
        $(document).ready(function() {
            $('#table').DataTable();
            $('#produkTbl').DataTable({
              "columnDefs": [
                    {
                        "targets": 3,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return 'Rp. '+ ribuanJs(data);
                        }
                       
                    },  
                    {
                        "targets": 4,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return 'Rp. '+ ribuanJs(data);
                        }
                       
                    },
                    {
                        "targets": 5,
                        "visible": true                                              
                    }
                ]
            });
            $('#laporanTbl').DataTable({
                order: [[0, 'desc']],
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ajax_laporan.php',
                    // type:'POST',
                    // success: function(result){
                    //   console.log('my message' + JSON.stringify(result));
                    //   // let obj = JSON.parse(result);
                    //   // console.log(JSON.stringify(obj.aaData));                      
                    // }
                },
                'columns': [
                  { data: 'no' },
                  { data: 'invoice' },
                  { data: 'qty' },
                  { data: 'subtotal' },
                  { data: 'pembayaran' },
                  { data: 'kembalian' },
                  { data: 'tanggal' },
                  { data: 'tombol' }
                ],
                "columnDefs": [
                  {
                        "targets": 3,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return 'Rp. '+ ribuanJs(data);
                        }
                       
                    },  
                    {
                        "targets": 4,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return 'Rp. '+ ribuanJs(data);
                        }
                       
                    },
                    {
                        "targets": 5,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return 'Rp. '+ ribuanJs(data);
                        }
                       
                    },
                    {
                        // The `data` parameter refers to the data for the cell (defined by the
                        // `data` option, which defaults to the column being worked with, in
                        // this case `data: 0`.
                        "targets": 1,
                        "render": function ( data, type, row ) {
                            // return data +' ('+ row[3]+')';
                            return `<a href="invoice.php?detail=`+data+`">`+data+`</a>`;
                        }
                       
                    },{
                        "targets": 7,
                        "visible": <?php echo (($username=='adnansurya') ? 'true' : 'false'); ?>,
                        "render": function ( data, type, row ) {                                                      
                            return `<form method="post"> 
                                     <input type="hidden" name="nona" value="`+data+`">
                                     <button type="submit" name="Remove" class="btn btn-danger btn-xs">
                                       <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</button>
                                    </form>`;
                                  
                        }
                       
                    }
                ]
            });
        } );
        $('#cart').dataTable({searching: false, paging: false, info: false});
    </script>
</body>
</html>