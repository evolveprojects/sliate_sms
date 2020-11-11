<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Approvals</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Approvals</li>
            <li><i class="fa fa-users"></i>Student Upgrade Approvals</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Upgrade Approvals
            </div>
            <hr>   
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#to_apprv_tab" aria-controls="to_apprv_tab" role="tab" data-toggle="tab"> To Approval</a></li>
                                <li role="presentation"><a class="fa fa-university" href="#rejected_list_tab" aria-controls="rejected_list_tab" role="tab" data-toggle="tab"> Rejected List</a></li>
                            </ul>
                            <div class="tab-content">
<!------------------Start of Approval List Tab-------------------------------------------------------------------------->                
                                <div role="tabpanel" class="tab-pane active" id="to_apprv_tab">
                                    <table id="stu_apprv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                                $i = 1;
                                                    if (!empty($result_array)) {
                                                        foreach ($result_array as $su) {
                                            ?>
                                            <tr>
                                                <td align="center"> <?php echo $i++ ?></td>
                                                <td> <?php echo $su['reg_no'] ?></td>
                                                <td> <?php echo $su['last_name'] //. " " . $va['last_name'] ?></td>
                                                <td> <?php echo $su['nic_no'] ?></td>
                                                <td align="center">
                                                    <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php echo $su['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                        
                                                    <?php 
                                                        if ($su["approved_status"] == "0") { ?>
                                                            <button data-toggle="tooltip" title="Approve for Upgrade" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php print_r($su["stu_id"]) ?>','1', '<?php print_r($su["upgrade_year"]) ?>', '<?php print_r($su["upgrade_semester"]) ?>', '<?php print_r($su["stup_id"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                    <?php } else { ?>                         
                                                        <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php print_r($su['stu_id']) ?>', '0')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                    <?php } ?>
                                                        <!--<a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php // echo $su['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>-->
                                                        <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php print_r($su["stu_id"]) ?>', '3', '<?php print_r($su["upgrade_year"]) ?>', '<?php print_r($su["upgrade_semester"]) ?>', '<?php print_r($su["stup_id"]) ?>')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                </td>
                                            </tr>
                            <?php } ?>
                                            
        <!--                                        <button data-toggle="tooltip" title="Approve for Upgrade" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php //print_r($su["stu_id"]) ?>','1')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                    <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php //print_r($su["stu_id"]) ?>', '0')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>-->
                                                </td>
                                            </tr>
                                            <?php
                                                $i++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
<!------------------End of Approval List Tab----------------------------------------------------------------------------->
                                

<!------------------Start of Reject List Tab----------------------------------------------------------------------------->                        
                                <div role="tabpanel" class="tab-pane" id="rejected_list_tab">
                                    <table id="stu_rejec" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                            $i = 1;
                                            if (!empty($reject_array)) {
                                                foreach ($reject_array as $rj) {
                                                    ?>
                                                    <tr>
                                                        <td align="center"> <?php echo $i ?></td>
                                                        <td> <?php echo $rj['reg_no'] ?></td>
                                                        <td> <?php echo $rj['last_name'] //. " " . $va['last_name'] ?></td>
                                                        <td> <?php echo $rj['nic_no'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php echo $rj['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_apprv_sem_upgrade_status('<?php print_r($rj["stu_id"]) ?>', '1', '<?php print_r($su["upgrade_year"]) ?>', '<?php print_r($su["upgrade_semester"]) ?>', '<?php print_r($su["stup_id"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
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
<!------------------End of Reject List Tab------------------------------------------------------------------------------->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    
    $.validate({
            form: '#stu_reg'
        });
    
    $(document).ready(function () {
        $('#stu_apprv').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });

        $('#stu_rejec').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });
    });   
        
       
    function update_stu_apprv_sem_upgrade_status(stu_id,approved_status, up_year, up_semester, up_id)
        {
        $.ajax(
            {
                url: "<?php echo base_url('approvals/update_stu_apprv_sem_upgrade_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'stu_id'            :   stu_id, 
                       'approved_status'   :   approved_status,
                       'up_year'           :   up_year,
                       'up_semester'       :   up_semester
                       //'approved_by'    :   approved_by
                   },
                success: function ()
                    {
                        location.reload();
                    }
            });
        }
        
        
    function stueditview(stu)
        {
           window.location = '<?php echo base_url("student/stuprof_view") ?>?id=' + stu +'&type=approval';
        }
        
        
        
          
</script>