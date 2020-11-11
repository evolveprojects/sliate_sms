<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Approvals</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Approvals</li>
            <li><i class="fa fa-users"></i>Exam Approvals</li>
        </ol>
    </div>
</div>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Exam Approvals
            </div>
            <hr>
<!--            <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php 
                                        global $branchdrop;
                                        global $selectedbr;
                                        $extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                        echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                </div>
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="l_faculty" class="col-md-3 control-label">Faculty:</label>
                                <div class="col-md-9">
                                    <?php 
                                        global $facultydrop;
                                        global $selectedfac;
                                        $facextraattrs = 'id="l_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degrees(this.value, 1, null, 1)"';
                                        echo form_dropdown('l_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                    ?>
                                </div>
                            </div>			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Degree Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_degree_name(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Degree Code---</option>
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
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
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
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_details();">Search</button>
                    </div>
                </div>
            </form>-->


            <div class="panel-body">
                <form class="form-horizontal" role="form" method="" id="search_form" autocomplete="off">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Center: </label>                         
                        </div>
                        <div class="col-md-2">
                         <!-- Select Central dropdown menu -->
                            <?php 
                                global $branchdrop;
                                global $selectedbr;

                                if(isset($stu_data))
                                {
                                    $selectedbr = $stu_data['center_id'];
                                }

                                $extraattrs = 'id="branch_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value,null,this)"';
                                
                                echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                ?>
<!--                            <select type="text" class="form-control">                                 
                                <option>--Select Center--</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>-->
                        </div>
                        <div class="col-md-2">
                            <label>Course: </label>
                        </div>
                        <div class="col-md-2">
                            <!-- Select Course dropdown menu  -->
                            
                            <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_batch_list(this.value)">    
                                        <option value="0">---Select Course Code---</option>
                                        
                                        <?php
//                                            foreach($courses as $row):
//                                                $selected="";
//                                                if($row['id']==$stu_data['course_id']){
//                                                    $selected="selected";
//                                                }
//                                                ?>
<!--                                                <option value="<?php //echo $row['id'];?>"  <?php //echo $selected?>>-->
                                                    <?php //echo $row['course_code']."-".$row['course_name'];?>
<!--                                                </option>-->
                                                <?php
//                                            endforeach;
                                        ?>
                                    </select>
                            
<!--                            <select type="text" class="form-control">
                                <option>--Select Course--</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>-->
                        </div>
                    
                        <div class="col-md-4"></div>
                    </div>
                    
                    <br>
                    <br>
                                        
                    <div class="row">
                        <div class="col-md-2">
                            <label>Batch: </label>
                        </div>
                        <div class="col-md-2">
                            <!-- Select Batch dropdown -->
                            <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="//load_year_list()">
                                        <option value="0">---Select Batch Code---</option>			
                            </select>
                            
                            
<!--                            <select type="text" class="form-control">
                                <option>--Select Batch--</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>-->
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                    
                    <br>
                    <br>
                    <br>
                    
                    <div>
                        <table id="staff_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Register Number</th>
                                    <th>Student Name</th>
                                    <th>Subject Code & Subject Name</th>
                                    <th>Exam ID & Exam Name</th>
                                    <th>NIC No</th>
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
                                            <td align="center"> <?php //echo $i ?></td>
                                            <td> <?php //echo $va['reg_no'] ?></td>
                                            <td> <?php //echo $va['first_name'] . " " . $va['last_name'] ?></td>
                                            <td> <?php //echo $va['nic_no'] ?></td>
                                            <td> <?php //echo $va['nic_no'] ?></td>
                                            <td> <?php //echo $va['nic_no'] ?></td>
                                            <td align="center">
                                                <?php //echo $va['nic_no'] ?>
<!--                                                <a class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('//<?php //echo $va['stu_id'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> | 
                                                <a class="btn btn-info btn-xs" onclick="event.preventDefault();load_stueditview('//<?php //echo $va['stu_id'];?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> | 


                                                <?php //if ($va["deleted"] == "0") { ?>
                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '1')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button> |
                                                <?php// } else { ?>
                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '0')" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button> |
                                                    <?php //} ?>
                                                <a href="<?php //echo base_url().'student/download/'.$va['stu_id']; ?>" id="download_image" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                                                <a href="https://dribbble.com/shots/2199042-Profile-Icon.png" download="smile.jpg">Download image</a>-->

                                            </td>
<!--                                            <td> <?php //echo $va['nic_no'] ?></td>-->
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
<!--                </br>
                <div class="col-xs-12 text-right">
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve All</button>
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject All</button>
                </div>-->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function () {
            $('#staff_look').DataTable({
                'ordering': true,
                'lengthMenu': [10, 25, 50, 75, 100]
            });
            
            //load_year_list();
        });


//Approvals - Exam Approvals
function load_course_list(center_id)
    {
        //set REG NUmber..
    //    var sel_val = selected.options[selected.selectedIndex].text;
    //    center_code = sel_val.split('-')[0].trim();

       // $('#reg_no_part1').val(center_code+'/'+course_code+'/'+year+'/'+course_type+'/');

       // $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
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




function load_batch_list(selected_course_id)
    {
        $.post("<?php echo base_url('Approvals/load_batch_list') ?>",{'selected_course_id': selected_course_id},

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



function search_student_details()
        {
            
//            var res = [];
            var center_id = $('#branch_id').val();
            var course_id = $('#course_id').val();
            var batch_id = $('#l_Bcode').val();
            // var year_no = $('#l_no_year').val().split('-')[0].trim();
            // var year_no = $('#l_no_year').val();
            // var semester_no = $('#l_no_semester').val();
            
            
            $.post("<?php echo base_url('Approvals/search_students_lookup') ?>", {},
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
//                                $('#tbl_body').find('tr').remove();
                                $('#staff_look').DataTable().clear();
                                for (j = 0; j < data.length; j++) {
//                                    if (data[j]['stu_deleted'] == "0") {
//                                        content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='update_stu_status(" + data[j]['stu_id'] + ",0);'></span></button>";
//                                    } else {
//                                        content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='update_stu_status(" + data[j]['stu_id'] + ",1);'></span></button>";
//                                    }
////                                    content2 = " |<a class='btn btn-info btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>|";
//                                    $('#tbl_body').append("<tr><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td><td>" + data[j]['nic_no'] + "</td><td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>"  + content + "</td></tr>");
                                    number_content = "<td align='center'>" + (j + 1) + "</td>";
//                                    action_content = "<td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>|" + content + "</td>";

                                    if((data[j]['stu_deleted']) == "0"){
                                        btn_content = "<button onclick='event.preventDefault();update_stu_status('" + data[j]['stu_id'] + "', '1')' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                    } else {
                                        btn_content = "<button onclick='event.preventDefault();update_stu_status('" + data[j]['stu_id'] + "', '0')' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                                    }
                                    action_content = "<td align='center'><a class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ");'>Approve</a> | <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_id'] + ");'>Reject</a></td>";
                                    

                                $('#staff_look').DataTable().row.add([
                                        number_content,
                                        data[j]['reg_no'],
                                        data[j]['first_name']+" "+data[j]['last_name'],
                                        data[j]['subject_id']+" - "+data[j]['subject'],
                                        data[j]['exam_id']+" - "+data[j]['exam_name'],
                                        data[j]['nic_no'],
                                        action_content
                                    ]).draw(false);
                                }


                            }
                       }
                },
                "json"
                );

            
        }


</script>

    



