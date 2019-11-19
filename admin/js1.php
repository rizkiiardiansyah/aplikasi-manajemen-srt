   <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../admin/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="../admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../admin/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../admin/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../admin/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../admin/dist/js/demo.js" type="text/javascript"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Add User");
  $('#action').val("Add");
  $('#operation').val("Add");
  $('#user_uploaded_image').html('');
 });
 
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[0, 3, 4],
    "orderable":false,
   },
  ],

 });

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var firstName = $('#first_name').val();
  var lastName = $('#last_name').val();
  var extension = $('#user_image').val().split('.').pop().toLowerCase();
  if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#user_image').val('');
    return false;
   }
  } 
  if(firstName != '' && lastName != '')
  {
   $.ajax({
    url:"insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#first_name').val(data.first_name);
    $('#last_name').val(data.last_name);
    $('.modal-title').text("Edit User");
    $('#user_id').val(user_id);
    $('#user_uploaded_image').html(data.user_image);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
 });
 
 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
     alert(data);
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   return false; 
  }
 });
 
 
});
</script>

  </body>
</html>