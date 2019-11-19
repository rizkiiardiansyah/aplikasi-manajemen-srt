   <!-- jQuery UI 1.11.2 -->
   <script src="admin/dist/jquery-3.3.1.js"></script>
    <!-- Bootstrap 3.3.2 JS -->

    <script src="datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>  
    <script src="admin/dist/jquery-ui.min.js" type="text/javascript"></script>
    <script src="admin/bootstrap/bootstrap-validate-2.2.0/dist/bootstrap-validate.js" type="text/javascript"></script>
   

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <!-- Morris.js charts -->
        <script src="admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="admin/dist/raphael-min.js"></script>
    <script src="admin/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='admin/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="admin/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="admin/dist/js/demo.js" type="text/javascript"></script>
    <script src="admin/datetimepicker/jquery.datetimepicker.js"></script>
        <script>
    $(document).ready(function() {
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
       $('#tgl_surat,#batas_waktu').datetimepicker({
         lang:'en',
         timepicker:false,
         format:'Y-m-d',
         closeOnDateSelect:true
       });
    $('#data,#data2').DataTable({
		"stateSave" : false,
		"bAutoWidth": true,
		"oLanguage": {
			"sSearch": "<i class='fa fa-search fa-fw'></i> Pencarian : ",
			"sLengthMenu": "_MENU_ &nbsp;&nbsp;Data Per Halaman",
			"sInfo": "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
			"sInfoFiltered": "(difilter dari _MAX_ total data)", 
			"sZeroRecords": "Pencarian tidak ditemukan", 
			"sEmptyTable": "Data kosong", 
			"sLoadingRecords": "Harap Tunggu...", 
			"oPaginate": {
				"sPrevious": "&laquo;Prev",
				"sNext": "Next&raquo;"
			}
		},
		"aaSorting": [[ 0, "asc" ]],
		"columnDefs": [ 
			{
				"targets": 'no-sort',
				"orderable": false,
			}
				],
		"sPaginationType": "simple_numbers", 
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 20, 50, 100, 150], [5, 10, 20, 50, 100, 150]]
});
} );
</script>
  </body>
</html>