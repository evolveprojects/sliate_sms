<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<!--<form method="post" enctype='multipart/form-data' action="<?php // echo base_url('App/do_upload') ?>" >
    <input type="file" id="userfile" name="userfile" />

    <input type="submit" value = "upload">
</form>-->


<form method="post" enctype='multipart/form-data' action="<?php echo base_url('App/email') ?>" >
    <input type="text" id="email" name="email" />

    <input type="submit" value = "">
</form>
<br>
<br>
<br>
<br>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready( function () {
//    $('#myTable').DataTable();
} );
</script>

