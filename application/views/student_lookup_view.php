<style>
    .dialog-confirm.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info{
        color: #fff;
        background: #42b8dd;
        border-color: #42b8dd;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Student</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-users"></i>Student</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Lookup
            </div>
            <hr>
            <?php 
            $search_panel1 = '<form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-7">';
                                
                                global $branchdrop;
                                global $selectedbr;

                                if(isset($stu_data))
                                {
                                    $selectedbr = $stu_data['center_id'];
                                }

                                $extraattrs = 'id="course_branch" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value,null,this)"';
                                
                                $form_drop= form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                
                            $search_panel2='</div>
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                <div class="col-md-9">
                                    <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                    <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_batch_list(this.value)">    
                                        <option value="0">---Select Course Code---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_year_list()">
                                        <option value="0">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">

                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_semesters(this.value)">
                                        <option value="0">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>
                    </div>
                </div>
            </form>';
            if($ug_level != 5)
            {
                echo $search_panel1.$form_drop.$search_panel2;
            }
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="staff_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
<!--                                    <th>#</th>-->
                                    <th>Register Number</th>
                                    <th>Student Name</th>
                                    <th>NIC No</th>
                                    <th>Course Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
                                <?php
                                $i = 1;
                                if (!empty($result_array)) {
                                    foreach ($result_array as $va) {
                                        ?>

                                        <tr>
<!--                                            <td align="center"> <?php echo $i ?></td>-->
                                            <td style="width: 200px"> <?php echo $va['reg_no'] ?></td>
                                            <td> <?php echo $va['first_name']; //. " " . $va['last_name'] ?></td>
                                            <td style="width: 140px"> <?php echo $va['nic_no'] ?></td>
                                            <td style="width: 140px"> <?php echo "[".$va['course_code']."] - ".$va['course_name'] ?></td>
                                            <td align="left" style="width: 2px">

                                                <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php echo $va['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> | 
                                                <a data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs" onclick="event.preventDefault();load_stueditview('<?php echo $va['stu_id'];?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> | 

                                           <?php if($ug_level != 5){ ?>           
                                                <?php if ($va["deleted"] == "0") { ?>
                                                    <button data-toggle="tooltip" title="Deactivate" onclick="event.preventDefault();update_stu_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                <?php } else { ?>
                                                    <button data-toggle="tooltip" title="Activate" onclick="event.preventDefault();update_stu_status('<?php print_r($va["stu_id"]) ?>', '0')" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button> |
                                           <?php }} ?>
                                                <?php if ($va["profileimage"] != "" || $va["profileimage"] != null) { ?>
                                                    <a data-toggle="tooltip" title="Download Image" href="<?php echo base_url().'student/download/'.$va['stu_id']; ?>" id="download_image" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                                                <?php } ?>
                                                <?php if ($va["apply_mahapola"] == "1") { ?>
                                                   | <a data-toggle="tooltip" title="Apply Mahapola" class="btn btn-warning btn-xs" onclick="event.preventDefault();createCookie('<?php echo $va['stu_id'];?>')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                                <?php } ?>
                                                <!--<a href="https://dribbble.com/shots/2199042-Profile-Icon.png" download="smile.jpg">Download image</a>-->

                                            </td>
                                        </tr>

                                        <?php
                                        $i++;
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

    <div id="dialog-confirm"></div>

    <script type="text/javascript">

        $.validate({
            form: '#stu_reg'
        });
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function () {
            $('#staff_look').DataTable({
                'ordering': false,
                'lengthMenu': [10, 25, 50, 75, 100],
                "columnDefs": [ {
                        "targets": 4,
                        "orderable": false
                        } ]
            });
            
            //load_year_list();
            if( $('#course_branch').length ) {
                load_course_list($('#course_branch').val());
            }
        });


        function update_stu_status(student_id, new_status)
        {
            var title = "";
            
            if(new_status == '1'){
                $("#dialog-confirm").html("Do you really want to deactivate this student?");
                title = 'Deactivate Student';
            }
            else{
               $("#dialog-confirm").html("Do you really want to activate this student?");
               title = 'Activate Student';
            }
            

            // Define the Dialog and its properties.
            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                title: title,
                height: 140,
                width: 400,
                draggable: false,
                buttons: [
                    {
                        text: "Yes",
                        "class": 'btn btn',
                        click: function() {
                            $(this).dialog('close');
                            
                            var batch_id = $('#l_Bcode').val();
                            $.ajax(
                            {
                                url: "<?php echo base_url('student/change_student_status') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {'student_id': student_id, 'new_status': new_status},
                                success: function (data)
                                {
                                    if (data == 'denied')
                                    {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                    } else
                                    {
                                        if (batch_id == '' || batch_id == 0 || batch_id == null) {
                                            location.reload();
                                        } else {
                                            search_student_details();
                                        }

                                        result_notification(data);
                                    }
                                }
                            });
                        }
                    },
                    {
                        text: "No",
                        "class": 'btn btn-info',
                        click: function() {
                            $(this).dialog('close');
                        }
                    }
                ]
            }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'}); 

        }
        
        function load_stueditview(stu)
        {
            $.post("<?php echo base_url('student/set_studentdatasession')?>",{'id':stu},
            function(data)
            {
               if(data)
               {
                    load_edit_page('edit');
               } 
            },  
            "json"
            );
        }

        function load_edit_page(type)
        {
            window.location = '<?php echo base_url("student/load_stueditview")?>?type='+type;
        }

        function stueditview(stu)
        {

            window.location = '<?php echo base_url("student/stuprof_view") ?>?id=' + (window.btoa(stu));
        }

//        function get_courses(faculty_id, flag, course_id, lookup_flag) {
//            $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
//            $('#l_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
//            if (flag === 1) {
//                $.post("<?php echo base_url('Year/load_course_programs') ?>", {'faculty_id': faculty_id},
//                        function (data)
//                        {
//                            if(data == 'denied')
//                            {
//                                funcres = {status:"denied", message:"You have no right to proceed the action"};
//                                result_notification(funcres);
//                            }
//                            else
//                            {
//                                for (var i = 0; i < data.length; i++) {
//                                    if (course_id == data[i]['course_id']) {
//                                        if (lookup_flag) {
//                                            $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
//                                        }
//                                        $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
//                                        $('#load_Dname').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
//                                    } else {
//                                        if (lookup_flag) {
//                                            $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
//                                        }
//                                        $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
//                                        $('#load_Dname').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
//                                    }
//
//                                }
//                            }
//                        },
//                        "json"
//                        );
//            }
//        }

//        function get_course_code(id, flag, year_no, batch_id, lookup_flag)
//        {
//            $('#load_Dname').val(id);
//            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
//            $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
//            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
//                    function (data)
//                    {
//                        if(data == 'denied')
//                        {
//                            funcres = {status:"denied", message:"You have no right to proceed the action"};
//                            result_notification(funcres);
//                        }
//                        else
//                        {
//                            if (data != null) {
//                                for (var i = 1; i <= data['no_of_year']; i++) {
//                                    if (flag) {
//                                        if (i == year_no) {
//                                            if (lookup_flag) {
//                                                $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
//                                            }
//                                            $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
//                                        } else {
//                                            if (lookup_flag) {
//                                                $('#l_no_year').append($("<option></option>").attr("value", i).text(i));
//                                            }
//                                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
//                                        }
//                                    } else {
//                                        if (lookup_flag) {
//                                            $('#l_no_year').append($("<option></option>").text(i));
//                                        }
//                                        $('#no_year').append($("<option></option>").attr("value", i).text(i));
//                                    }
//                                }
//                            }
//
//                            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
//                                    function (data)
//                                    {
//
//                                        for (j = 0; j < data.length; j++) {
//                                            if (data[j]['id'] == batch_id) {
//                                                if (lookup_flag) {
//                                                    $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
//                                                }
//                                                $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
//                                            } else {
//                                                if (lookup_flag) {
//                                                    $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
//                                                }
//                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
//                                            }
//                                        }
//
//                                    },
//                                    "json"
//                                    );
//                        }
//                    },
//                    "json"
//                    );
//        }

//        function load_semesters(year_no, semester_no, lookup_flag) 
//        {
//            var sel_year = year_no.split('-')[0].trim();
//            var sel_year_id = year_no.split('-')[1].trim();
//            
//            var course_id = $('#course_id').val();
//            
//            $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
//           // if (lookup_flag) {
//           //     var course_id = $('#l_Dcode').val();
//           // } else {
//                
//          //  }
////            if (course_id == '' || course_id == null) {
////                var course_id = $('#course').val();
////            }
//            $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_id': sel_year_id, 'year_no': year_no},
//                    function (data)
//                    {
//                        console.log(data);
//                        if(data == 'denied')
//                        {
//                            funcres = {status:"denied", message:"You have no right to proceed the action"};
//                            result_notification(funcres);
//                        }
//                        else
//                        {
//                            for (var i = 1; i <= data; i++) {
//                                if (semester_no == i) {
//                                    if (lookup_flag) {
//                                        $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
//                                    }
//                                    $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
//                                } else {
//                                    if (lookup_flag) {
//                                        $('#l_no_semester').append($("<option></option>").attr("value", i).text(i));
//                                    }
//                                    $('#no_semester').append($("<option></option>").attr("value", i).text(i));
//                                }
//                            }
//                        }
//                    },
//                    "json"
//                    );
//        }

//function search_details() {
//            var res = [];
//            var center_id = $('#center_id').val();
//            var course_id = $('#course_id').val();
//            var year_no = $('#l_no_year').val();
//            var semester_no = $('#l_no_semester').val();
//            var batch_id = $('#l_Bcode').val();
//            if (batch_id == null || batch_id == '' || batch_id == 0) {
//                res['status'] = 'denied';
//                res['message'] = 'Please Select Relevent Batch Code';
//                result_notification(res);
//            } else {
//                $.post("<?php echo base_url('Student/filter_students_batch_lookup') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id},
//                        function (data)
//                        {
//                            if(data == 'denied')
//                            {
//                                funcres = {status:"denied", message:"You have no right to proceed the action"};
//                                result_notification(funcres);
//                            }
//                            else
//                            {
//                                if (data.length > 0) {
//    //                                $('#tbl_body').find('tr').remove();
//                                    $('#staff_look').DataTable().clear();
//                                    for (j = 0; j < data.length; j++) {
//                                        if (data[j]['stu_deleted'] == 1) {
//                                            content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='update_stu_status(" + data[j]['stu_id'] + ",0);'></span></button>";
//                                        } else {
//                                            content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='update_stu_status(" + data[j]['stu_id'] + ",1);'></span></button>";
//                                        }
//    ////                                    content2 = " |<a class='btn btn-info btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>|";
                                       // $('#tbl_body').append("<tr><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td><td>" + data[j]['nic_no'] + "</td><td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>"  + content + "</td></tr>");
//                                        number_content = "<td align='center'>" + (j + 1) + "</td>";
//                                        action_content = "<td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>|" + content + "</td>";
//                                        $('#staff_look').DataTable().row.add([
//                                            number_content,
//                                            data[j]['reg_no'],
//                                            data[j]['first_name'] + " " + data[j]['last_name'],
//                                            data[j]['nic_no'],
//                                            action_content
//                                        ]).draw(false);
//                                    }
//
//
//                                }
//                            }
//                        },
//                        "json"
//                        );
//
//            }
//        }
//        

    
        
    /*
    * load courses
    */
    function load_course_list(center_id)
    {
        $('#course_id').find('option').remove().end();
        $('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

        function (data)
        {
            for (var i = 0; i < data.length; i++) 
            {

               // if(selectedid == data[i]['id'])
               // {
               //     $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_name']));
               // }
              //  else
              //  {
                    $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
              //  }
            }
        },
        "json"
        );
    }


    /*
    * load years
    */
    function load_year_list()
    {
        var cou_id = $('#course_id').val();

        $.post("<?php echo base_url('Student/load_year_list') ?>",{'selected_course_id': cou_id},

        function (data)
        { 
            var year = data['no_of_year'];
            var id = data['id'];

            $('#l_no_year').find('option').remove().end();
            $('#l_no_year').append('<option value="">---Select Year---</option>').val('');

                for (var i=1; i <= year; i++) 
                {
                    $('#l_no_year').append($("<option></option>").attr("value", i+'-'+id).text(i + " Year"));


                }
        },
        "json"
        );
    }

    /*
    * load batches
    */
    function load_batch_list(selected_course_id)
    {
        $.post("<?php echo base_url('Student/load_batch_list') ?>",{'selected_course_id': selected_course_id},

        function (data)
        {
            $('#l_Bcode').find('option').remove().end();
            $('#l_Bcode').append('<option value="">---Select Batch Code---</option>').val('');

            for (var i = 0; i < data.length; i++) 
            {
                if((data[i]['batch_code'] != "0") || data[i]['batch_code'] != null)
                {
                    //if(selectedid == data[i]['id'])
                  //  {
                  //      $('#course_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['degree_code']+' - '+data[i]['degree_name']));
                 //   }
                  //  else
                 //   {
                        $('#l_Bcode').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
                  //  }
                }
            }
        },
        "json"
        );
    }
    
    
    function load_semesters(year_no) 
        {
            var sel_year = "";
            var sel_year_id = "";
            
            if(year_no != ""){
               sel_year = year_no.split('-')[0].trim();
               sel_year_id = year_no.split('-')[1].trim(); 
           }
            
                // var course_id = $('#course_id').val();

                 //$('#l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');

                 $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

                 function (data)
                 {
                     $('#l_no_semester').find('option').remove().end();
                     $('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                     for (var i=1; i <= data; i++) 
                     {
                         $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                     }
                 },
                 "json"
                 );  
        }
        
        
        function search_student_details()
        {
            var year_no = "";
            var res = [];
            var center_id = $('#course_branch').val();
            var course_id = $('#course_id').val();
            
            if($('#l_no_year').val() != ""){
                year_no = $('#l_no_year').val().split('-')[0].trim();
            }
            
           // var year_no = $('#l_no_year').val();
            var semester_no = $('#l_no_semester').val();
            var batch_id = $('#l_Bcode').val();
            
            $('#staff_look').DataTable().destroy();
            $('#staff_look').DataTable({
                            'ordering': false,
                            'lengthMenu': [10, 25, 50, 75, 100],
                            "columnDefs": [ {
                                    "targets": 4,
                                    "orderable": false
                                    } ]
                        });
            $('#staff_look').DataTable().clear().draw();
            
            $.post("<?php echo base_url('Student/search_students_lookup') ?>", {'center_id': center_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id},
                function (data)
                {
                    console.log(data);
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if (data.length > 0) {
                            
                            action2 = "";
                            action3 = "";

                            for (j = 0; j < data.length; j++) {

                                //number_content = "<td align='center'>" + (j + 1) + "</td>";'];
                                
                                if((data[j]['stu_deleted']) == "0"){
                                    btn_content = " <button data-toggle='tooltip' title='Deactivate' onclick='event.preventDefault();update_stu_status(" + data[j]['stu_id'] + ", "+1+")' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button> ";
                                } else {
                                    btn_content = " <button data-toggle='tooltip' title='Activate' onclick='event.preventDefault();update_stu_status(" + data[j]['stu_id'] + ", "+0+")' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button> ";
                                }
                                
                                if((data[j]['profileimage']) != null){
                                    s_id = data[j]['stu_id'];
                                    
                                    hlink = "<?php echo base_url("student/download/") ?>"+s_id
                                    action2 = "| <a data-toggle='tooltip' title='Download Image' href='"+hlink+"' id='download_image' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></a> ";
                                }
                                else{
                                    hlink = "";
                                    action2 = "";
                                }
                                
                                if((data[j]['apply_mahapola']) == "1"){
                                    action3 = "| <a data-toggle='tooltip' title='Apply Mahapola' class='btn btn-warning btn-xs' onclick='event.preventDefault();createCookie(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a>";
                                }
                                else
                                    action3 = "";

                                action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ");'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <a data-toggle='tooltip' title='Edit' class='btn btn-info btn-xs' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_id'] + ");'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> |"+btn_content+action2+action3+"</td>";

                                $('#staff_look').DataTable().row.add([
                                    data[j]['reg_no'],
                                    data[j]['first_name'],
                                    data[j]['nic_no'],
                                    "["+data[j]['course_code']+"] - "+data[j]['course_name'] ,
                                    action_content
                                ]).draw(false);
                            }
                        }
                    }
                },
                "json"
                );

            
        }
    
    // download student image
        function stu_pic_download(stu_id){

        $.post("<?php echo base_url('Student/load_stu_picture_url2') ?>", {'stu_id': stu_id},
            
            function (data)
            {

                //console.log("<?php echo base_url() ?>"+data)
            },
            "json"
            );
        
        }
        
        
        function createCookie(stu) {

//            document.cookie = "stu_id =" + stu;
//            document.cookie = "expires =" + new Date(new Date().getTime() + (2*1000*60*60));
//            
//            window.location = '<?php //echo base_url("student/mahapola_application_view") ?>';
            
            window.location = '<?php echo base_url("student/mahapola_application_view") ?>?id='+ (window.btoa(stu) + '&type=view');
        }
        
        
        
    </script>

