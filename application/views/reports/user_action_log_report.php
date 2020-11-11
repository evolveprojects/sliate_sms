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
        <h3 class="page-header"><i class="fa fa-users"></i> USER ACTION LOG</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>User Action Log</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                User Action Log
            </div>
            <div class="panel-body"><br/>
                <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                    <div class="row">
                        <!--<div class="col-md-1"></div>-->
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="center" class="col-md-3 control-label">User Group: </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="user_group" name="user_group" onchange="get_user_types(this.value);">
                                            <option value="">---Select User group---</option>
                                        <?php 
                                            foreach($user_groups as $ug):
                                            ?>
                                                <option value="<?php echo $ug['ug_id']?>"><?php echo $ug['ug_name']?></option>
                                            <?php
                                            endforeach;
                                        ?>
                                        </select>
                                    </div>
                                </div>				
                            </div>
                            <div class="col-md-4">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">User :</label>
                                    <div class="col-md-9">
                                        <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                        <select class="form-control" id="user" name="user">    
                                            <option value=""></option>
                                        </select>
                                    </div>				         
                                </div>				
                            </div>
                            <div class="col-md-4">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">From :</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" id="from_date" name="from_date" placeholder="YYYY-MM-DD" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>				         
                                </div>				
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">To :</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" id="to_date" name="to_date" placeholder="YYYY-MM-DD" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>				         
                                </div>				
                            </div>
                            <div class="col-md-8">							
                                <button style="width:100px" type="button" class="btn btn-primary btn-md" name="search" onclick="search_user_log_actions();">Search</button>        
                                <!--<button type="button" style="float: right; margin-right: 12px;" id="print_btn" name="print_btn" class="btn btn-success" onclick="load_pdf_center_wise_detail();">Print Report</button>-->				
                            </div>
                        </div>
                    </div>
                    <br/>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <table id="user_log_tbl" name="user_log_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Log Action</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Date & Time</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     

<!-- Modal-->
<div class="modal fade bs-example-modal-lg" id="array_modal">
    <div class="modal-dialog modal-lg" style="width:70%;padding-top:13px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal_title" id="modal_title">Data</h4>
            </div>
            <div class="modal-body" id="dataModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal-->
<script type="text/javascript">
   
    $.validate({
        form: '#stu_reg'
    });

    $(document).ready(function () {
         
        $('#user_log_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': true
        });
      
    });
    
    
    function get_user_types(user_group){
        
        $('#user').find('option').remove().end();
        $("#user").append('<option value="">---Select User---</option>').val('');
        
        $.post("<?php echo base_url("report/get_user_types")?>", {'user_group': user_group},
        function(data){
            for(var x=0; x<data.length; x++){
                $('#user').append($("<option></option>").attr("value", data[x]['user_id']).text(data[x]['user_name']));
            }
        },
        "json"
        );
    }
    
    
    function search_user_log_actions(){
        
        $('.se-pre-con').fadeIn('slow');
        var sel_user_group = $('#user_group').val();
        var sel_user = $('#user').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        
        if(sel_user_group == '' || sel_user == '' || from_date == '' || to_date == '' ){
            funcres = {status: "denied", message: "Please select user group,user and date period."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $('#user_log_tbl').DataTable().destroy();
            $('#user_log_tbl').DataTable({
                'ordering': true,
                'lengthMenu': [10, 25, 50, 75, 100],
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                    "className":'text-center'
                }]
            });
            $('#user_log_tbl').DataTable().clear().draw();

            $.post("<?php echo base_url('report/search_user_log_actions') ?>", {'sel_user': sel_user,'from_date':from_date, 'to_date':to_date},
            function (data)
            {
                if (data.length > 0) 
                {
                    var x = 1;
                    for (j = 0; j < data.length; j++) {
                        var dataArray = data[j]['log_data'];
                        $('#user_log_tbl').DataTable().row.add([
                            x,
                            data[j]['log_action'],
                            data[j]['log_status'],
                            data[j]['log_description'],
                            data[j]['log_timestamp'],
                            "<input type='button' class='btn btn-success btn-xs' value=' . . . ' onclick='openModal(" + JSON.stringify(dataArray) + ")'>"
                        ]).draw(false);

                        x++;
                    }
                }
            },
            "json"
            );
            $('.se-pre-con').fadeOut('slow');
        }
    }
    
    function openModal(data_array){
        $('#array_modal').modal({
            show: 'false'
        });
        $('#array_modal').modal('show');
        
        var result_array = JSON.parse(data_array);
        $('#dataModalBody').empty();
        if(result_array != null){
            for (var key in result_array){
                if(jQuery.type(result_array[key]) === 'object'){
                    $('#dataModalBody').append('<p><b>'+key+'</b></p>');
                    var sub_array = result_array[key];
                    for (var sub_key in sub_array){
                        if (jQuery.type(sub_array[sub_key]) === 'object') {
                            $('#dataModalBody').append('<p><b>'+sub_key+'</b></p>');
                            var sub_array2 = sub_array[sub_key];
                            for (var sub_key2 in sub_array2){
                                if (jQuery.type(sub_array2[sub_key2]) === 'object') {
                                    $('#dataModalBody').append('<p><b>'+sub_key2+'</b></p>');
                                    var sub_array3 = sub_array2[sub_key2];
                                    for (var sub_key3 in sub_array3){
                                        $('#dataModalBody').append('<p><b>'+sub_key3+'</b> : '+sub_array3[sub_key3]+'</p>');
                                    }
                                } else {
                                    $('#dataModalBody').append('<p><b>'+sub_key2+'</b> : '+sub_array2[sub_key2]+'</p>');
                                }
                            }
                        } else {
                            $('#dataModalBody').append('<p><b>'+sub_key+'</b> : '+sub_array[sub_key]+'</p>');
                        }
                    }
                } else {
                    $('#dataModalBody').append('<p><b>'+key+'</b> : '+result_array[key]+'</p>');
                }
            }
        } else {
            $('#dataModalBody').append('<p><b>No data to display</b></p>');
        }
    }

</script>

