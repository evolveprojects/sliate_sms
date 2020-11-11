<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js')?>"></script><!--jquery-->
<style type="text/css">

    .affix-top {
      position: relative;
    }

    .affix {
      top: 70px;
    }

    .affix, 
    .affix-bottom {
        width: 168px;
    }

    .affix-bottom {
      position: absolute;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STAFF REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Staff List View</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Staff Reports
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#full_summary_tab" aria-controls="full_summary_tab" role="tab" data-toggle="tab"> Full Summary</a></li>
                                <!--<li role="presentation"><a class="fa fa-university" href="#center_wise_full_tab" aria-controls="center_wise_full_tab" role="tab" data-toggle="tab"> Center wise Full Summary</a></li>-->
                                <li role="presentation"><a class="fa fa-graduation-cap" href="#center_wise_detail_tab" aria-controls="center_wise_detail_tab" role="tab" data-toggle="tab"> Center wise Detail Summary</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="full_summary_tab"><br/>
                                    <!--<form class="form-horizontal" role="form" method="post"  id="full_sum_form" action="<?php echo base_url('report/student_list_full_summary_pdf') ?>"  autocomplete="on" novalidate enctype="multipart/form-data">-->
                                    <div class="row">
                                        <div class="col-md-12">
<!--                                            <button type="submit" style="float: right; margin-right: 5%;" class="btn btn-success">Print Report</button>-->
                                            <button style="float: right; margin-right: 1.5%;" class="btn btn-success" id="print_full" name="print_full" onclick="window.open('<?php echo base_url("report/staff_list_full_summary_pdf") ?>');">Print Report</button>
                                        </div>
                                    </div>
                                    
                                    <table id="full_sum" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Center Code</th>
<!--                                                <th>Course</th>
                                                <th>Course Code</th>-->
                                                <th>Total Staff</th>
                                                <th>Approve</th>
                                                <th>Not Approve</th>
                                                <th>Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                            $i = 1;
                                            $total_staff = 0;
                                            $total_approved = 0;
                                            $total_reject = 0;
                                            $total_not_approve = 0;
                                            
                                            $center_total_staff = 0;
                                            $center_total_approved = 0;
                                            $center_total_reject = 0;
                                            $center_total_not_approve = 0;
                                            
                                            
                                            if (!empty($staff_all_count)) 
                                            {
                                                //foreach ($stu_all_count_array as $va) 
                                                for($k=0; $k < count($staff_all_count);$k++)
                                                {
                                                    $va = $staff_all_count[$k];
                                                    
                                                    if($k == 0)
                                                    {

                                                        echo '<tr>'.
                                                            '<td>'.$va['br_name'].'</td>'.
                                                            '<td>'.$va['br_code'].'</td>'.
//                                                            '<td>'.$va['course_name'].'</td>'.
//                                                            '<td>'.$va['course_code'].'</td>'.
                                                            '<td align="center">'. $va['staff_count'].'</td>'.  
                                                            '<td align="center">'.$va['apprv_status'] .'</td>'.
                                                            '<td align="center">'.$va['status'].'</td>'. 
                                                            '<td align="center">'.$va['reject_status'].'</td>'. 
                                                        '</tr>';
                                                    }
                                                    else
                                                    {
                                                        if($staff_all_count[$k-1]['br_code'] != $staff_all_count[$k]['br_code'])
                                                        {
                                                            echo '<tr style="font-weight:bold;">'.

                                                                '<td style="border-right: 0">'.$staff_all_count[$k-1]['br_name'].' ATI Total</td>'.
//                                                                '<td style="border-right: 0"></td>'.
//                                                                '<td style="border-right: 0"></td>'.
                                                                '<td></td>'.
                                                                '<td align="center">'.$center_total_staff.'</td>'.
                                                                '<td align="center">'. $center_total_approved.'</td>'.
                                                                '<td align="center">'. $center_total_not_approve.'</td>'.
                                                                '<td align="center">'. $center_total_reject.'</td>'.
                                                            '</tr>';
                                                            
                                                            $center_total_staff = 0;
                                                            $center_total_approved = 0;
                                                            $center_total_reject = 0;
                                                            $center_total_not_approve = 0;
                                                        }
                                                        echo '<tr>'.
                                                                    '<td>'.$va['br_name'].'</td>'.
                                                                    '<td>'.$va['br_code'].'</td>'.
//                                                                    '<td>'.$va['course_name'].'</td>'.
//                                                                    '<td>'.$va['course_code'].'</td>'.
                                                                    '<td align="center">'. $va['staff_count'].'</td>'.  
                                                                    '<td align="center">'.$va['apprv_status'] .'</td>'.
                                                                    '<td align="center">'.$va['status'].'</td>'. 
                                                                    '<td align="center">'.$va['reject_status'].'</td>'. 
                                                                '</tr>';
                                                    }
                                                    $i++;
                                                    $center_total_staff += $va['staff_count'];
                                                    $center_total_approved += $va['apprv_status'];
                                                    $center_total_reject += $va['reject_status'];
                                                    $center_total_not_approve += $va['status']; 
                                                    
                                                    $total_staff += $va['staff_count'];
                                                    $total_approved += $va['apprv_status'];
                                                    $total_reject += $va['reject_status'];
                                                    $total_not_approve += $va['status']; 
                                                }
                                                echo '<tr style="font-weight:bold;">'.

                                                '<td style="font-weight:bold; border-right: 0">'.$staff_all_count[$k-1]['br_name'].' ATI Total</td>'.
//                                                '<td style="border-right: 0"></td>'.
//                                                '<td style="border-right: 0"></td>'.
                                                '<td></td>'.
                                                '<td align="center">'.$center_total_staff.'</td>'.
                                                '<td align="center">'. $center_total_approved.'</td>'.
                                                '<td align="center">'. $center_total_not_approve.'</td>'.
                                                '<td align="center">'. $center_total_reject.'</td>'.
                                            '</tr>';
                                            }
                                            
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Grand Total</th>
                                                <th></th>
<!--                                                <th></th>
                                                <th></th>-->
                                                <th> <?php echo $total_staff ?></th>
                                                <th> <?php echo $total_approved ?></th>
                                                <th> <?php echo $total_not_approve ?></th>
                                                <th> <?php echo $total_reject ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!--</form>-->
                                </div>
                               <div role="tabpanel" class="tab-pane" id="center_wise_detail_tab"><br>
                                    <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <div class="form-group col-md-4">
                                                    <div class="form-group">
                                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                                        <div class="col-md-7">
                                                            <?php 
                                                            global $branchdrop;
                                                            global $selectedbr;

                                                            if(isset($stu_data))
                                                            {
                                                                $selectedbr = $stu_data['center_id'];
                                                            }

                                                            $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value);"';

                                                            echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                                            ?>
                                                        </div>
                                                    </div>				
                                                </div>
                                                <div class="form-group col-md-4">							
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                        <div class="col-md-9">
                                                            <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                            <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                                                <option value="">---Select Course Code---</option>
                                                            </select>
                                                        </div>				         
                                                    </div>				
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10"></div>
                                            <div class="col-md-2">
                                                <button style="margin-left: -30px;" type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>        
                                            
                                                <button type="button" style="float: right; margin-right: 12px;" id="print_btn" name="print_btn" class="btn btn-success" onclick="load_pdf_center_wise_detail();">Print Report</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--<div class="panel-body">-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="staff_list" name="staff_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Center</th>
                                                            <th>Name</th>
                                                            <th>NIC No</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_body">
                                                        
                                                        <?php
//                                                            $i = 1;
//                                                            if (!empty($result_array)) {
//                                                            foreach ($result_array as $va) {
                                                        ?>

<!--                                                        <tr>
                                                            <td align="center"> <?php //echo $i ?></td>
                                                            <td> <?php //echo $va['reg_no'] ?></td>
                                                            <td> <?php //echo $va['first_name'] . " " . $va['last_name'] ?></td>
                                                            <td> <?php //echo $va['nic_no'] ?></td>
                                                            <td align="center">
                                                                <a class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php //echo $va['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> | 
                                                                <a class="btn btn-info btn-xs" onclick="event.preventDefault();load_stueditview('<?php //echo $va['stu_id'];?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> | 

                                                                <?php //if ($va["deleted"] == "0") { ?>
                                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '1')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                                <?php //} else { ?>
                                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '0')" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>
                                                                <?php //} ?>
                                                            </td>
                                                        </tr>-->
                                                        <?php
                                                               // $i++;
                                                          //  }
                                                      //  }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ------------------- -->
                </div>
            </div>
        </div>
    </div>
</div>            

<script type="text/javascript">
   
    $.validate({
        form: '#stu_reg'
    });

    $(document).ready(function () {
        
        var rowCount = $('#full_sum tbody tr').length;
        if(rowCount > 0){
           $('#print_full').attr('disabled', false);
        }
        else{
           $('#print_full').attr('disabled', true); 
        }
        
        $('#print_btn').attr('disabled', true);
        
        $('#student_list').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });
        
        if($('#user_level').val() == "1"){
            $('#center_id').find('option').get(0).remove();
            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }
        
        load_course_list($("#center_id").val());
        
        $('#full_sum').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });
        
        $('#staff_list').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });
        
      
    });
    

    /*
    * load courses
    */
     function load_course_list(center_id)
    {
        $('#course_id').find('option').remove().end();
        $("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},

        function (data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
            }
        
        },
        "json"
        );
    }


    function search_student_details()
    {
        $('.se-pre-con').fadeIn('slow');
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        
        var status = '';
        var title = '';

        $.post("<?php echo base_url('Report/search_staff_lookup') ?>", {'center_id': center_id, 'course_id': course_id},
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
                    $('#staff_list').DataTable().destroy();
                    $('#staff_list').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        $('#print_btn').attr('disabled', false);
                        
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            
                            if ((data[j]['stf_acc']) == 1) {
                                status= "Acedemic";
                            } else {
                                status= "Non-Academic";
                            }
                            
//                            if ((data[j]['tit_name']) == 1) {
//                                title= "Rev.";
//                            }else if ((data[j]['tit_name']) == 2) {
//                                title= "Prof.";
//                            }else if ((data[j]['tit_name']) == 3) {
//                                title= "Dr.";
//                            }else if ((data[j]['tit_name']) == 4) {
//                                title= "Mr.";
//                            }else if ((data[j]['tit_name']) == 5) {
//                                title= "Mrs.";
//                            }else {
//                                title= "Miss.";
//                            }

                            
                            $('#staff_list').DataTable().row.add([
                                "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                data[j]['title_name']+" "+data[j]['stf_fname']+ " " + data[j]['stf_lname'],
                                data[j]['nic'],
                                status
                            ]).draw(false);
                        }
                    }
                    else{
                        $('#print_btn').attr('disabled', true);
                    }
                }
                $('.se-pre-con').fadeOut('slow');
            },
            "json"
            );


    }

    
    function load_pdf_center_wise_detail(){
        
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();

        window.open('<?php echo base_url("report/center_staff_detail_summary_pdf") ?>?cen=' + center_id +'&cou=' +course_id);
  
    }
    
    

</script>
