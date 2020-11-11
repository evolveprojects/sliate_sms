<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
?>



</script>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Course Manager</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Course Manager</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Courses</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="frm_course" method="post" action="<?php echo base_url('master/save_course') ?>">
                            <div class="card-body">

                                <input type="hidden" id="course_id" name="course_id"> 
                                <div class="form-group" >
                                    <label for="course_code">Course Code</label>
                                    <input type="text" class="form-control" id="course_code" aria-describedby="course_code" placeholder="course code">
                                    <small id="codeHelp" class="form-text text-danger" style="color:red;"></small>
                                </div>
                                <div class="form-group">
                                    <label for="course_name">Course Name</label>
                                    <input type="text" class="form-control" id="course_name" aria-describedby="course_name" placeholder="course name">
                                    <small id="nameHelp" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="total_credit">Total credit</label>
                                    <input type="text" class="form-control" id="total_credit" aria-describedby="total_credit" placeholder="total credit">
                                    <small id="creditHelp" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="selection_type">Selection Type</label>
                                    <select class="form-control" id="selection_type" name="selection_type" placeholder="total credit">
                                        <option vlaue="" selected disabled>Choose..</option>
                                        <option value="zscore">Z-Score</option>
                                        <option value="aptitude_test">Test Mark</option>
                                    </select>
                                    <small id="selection_typeHelp" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="textarea" class="form-control" id="description" aria-describedby="description" placeholder="description"> </textarea>
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>

                            </div>
                            <div class="card-footer" style="text-align:right;">
                                <button type="submit" name="save_btn" id="save_course" class="btn btn-primary"> Save </button>
                                <button type="reset" name="Reset" class="btn btn-default float-left" onclick="reset()">Reset</button>	  
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                    
                    <div class="card" style="height:635px;">
                        <div class="card-header">
                            <h5 class="m-0">Manage Centers</h5>
                        </div>
                        <div class="card-body" style="height: 450px; overflow-y: scroll;">
                            <table id="table_courses" class="table table-striped table-bordered dt-responsive" id="table4" >
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Total credit</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="br_table_body" >

                                    <?php 
                                    
                                    if($all_courses) {
                                        foreach ($all_courses as $value) {
                                            echo 
                                        
                                            "<tr>
                                                <td>". $value['course_code'] ."-". $value['course_name'] ."</td>
                                                <td>". $value['total_creadit'] ."</td>
                                                <td>"
                                    ?>
                                                    <div class='btn-group' role='group' aria-label='Basic example'>
                                                        <button type='button' class='btn btn-sm btn-primary' onclick="edit_course_load('<?php print_r($value['id']) ?>', '<?php print_r($value['course_code']) ?>', '<?php print_r($value['course_name']) ?>', '<?php print_r($value['total_creadit']) ?>', '<?php print_r($value['description']) ?>')">edit</button>
                                                        <button type='button' class='btn btn-sm btn-danger' onclick="change_status('<?php print_r($value['course_id']) ?>', '1', '<?php print_r($value['course_code']) ?>')">x</button>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#total_credit").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#creditHelp").html("Numbers Only").show().delay(4000).fadeOut("slow");
               return false;
    }
   });
});
    

    //save table data
    $("#save_course").click(function(e) {

        e.preventDefault();

        let url = "<?php echo base_url('master/save_course') ?>";

        if($('#course_code').val() == ''){
            $("#codeHelp").html('Enter course code');
        } else {
            $("#creditHelp").html('');
        }
        if($('#course_name').val() == ''){
            $("#nameHelp").html('Enter course name');
        } else {
            $("#nameHelp").html('');
        }
        if($('#total_credit').val() == ''){
            $("#creditHelp").html('Enter course credit');
        } else {
            $("#creditHelp").html('');
        }
        if(!$('#selection_type').val()){
            $("#selection_typeHelp").html('Choose selection type');
        } else {
            $("#selection_typeHelp").html('');
        }

        if (!$('#course_code').val() == '' && !$('#course_name').val() == '' && !$('#total_credit').val() == '' && !$('#selection_type').val() == '') 
        {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    c_id: $('#course_id').val(),
                    c_code: $('#course_code').val(),
                    c_name: $('#course_name').val(),
                    c_credit: $('#total_credit').val(),
                    c_desc: $('#description').val(),
                    c_sel_type:$('#selection_type').val()
                },
                success: function(data) 
                {
                    let options = JSON.parse(data);
                    alert(options['msg']);
                    location.reload();
                }
            });
        }

    });                              



    
    $(document).ready(function() {
        $('#table_courses').DataTable();
    } );

    function reset() {
        $('#course_id').val("");
        $('#course_code').val("");
        $('#course_name').val("");
        $('#total_credit').val("");
        $('#description').val("");
    }


    function edit_course_load(id, code, name, credit, descri) {

        $('#course_id').val(id);
        $('#course_code').val(code);
        $('#course_name').val(name);
        $('#total_credit').val(credit);
        $('#description').val(descri);
    }


    function change_status(course_id, new_status, course_code)
    {
        if (confirm("Confirm delete!?")) {

            $.post("<?php echo base_url('course/change_course_status') ?>", {"course_id": course_id, "new_status": new_status, "course_code": course_code},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    alert('Deleted!');
                    location.reload();
                }
            },
            "json"
            );
        }
        return false;
    }


// $(document).ready(function() {

//     $('#frm_course').validate({
//         rules: {
//             course_code: {
//                 required: true
//                 },
//             course_name: {
//                 required: true
//                 },
//             total_credit: {
//                 required: true
//                 }
//             }
//     });
// });
</script>