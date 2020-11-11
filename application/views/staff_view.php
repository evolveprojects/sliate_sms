<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-users"></i>Staff Lookup</li>
        </ol>
    </div>
</div>
<div>
    <div class="panel">
        <header class="panel-heading">
            Staff Look Up
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label class="col-md-3 control-label" style="left: 15px;">ATI Center<span style="color:red;font-size: 16px">*</span></label>
                    <div class="col-md-6" style="left: 60px;">

                        <select class="form-control" id="center_id" name="center_id" style="width:100%" data-validation="required">
                            <?php
                                if($ug_level[0]['ug_level'] == 1){
                            ?>
                                <option value="0">All</option>
                            <?php
                                }
                            ?>
                                
                            <?php
                                foreach ($centers as $row):
                                    ?>
                                <option value="<?php echo $row['br_id']; ?>">
                                <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                </option>
                                    <?php
                                endforeach;
                                ?>
                        </select>  
                    </div>
                    <div class="col-md-2" style="margin-left: 90%; margin-top: -7%;">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_staff_details();">Search</button>
                    </div>
                </div>
                <br>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <table id="staff_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr bgcolor="#F0F8FF">
                                <th>#</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>NIC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($stf_view_all)) {
                                foreach ($stf_view_all as $stf) {

                                    echo "<tr>";
                                    echo "<td align='center'>" . $i . "</td>";
                                    echo "<td>" . $stf['title_name'] . $stf['stf_fname'] . " " . $stf['stf_lname'] . "</td>";
                                    echo "<td>" . $stf['name'] ."</td>";

                                    echo "<td>" . $stf['nic'] . "</td>";
                                    echo "<td align='center'>
                                            <a class='btn btn-default btn-xs' title='profile' onclick='event.preventDefault();load_staffeditview(" . $stf['stf_id'] . ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> |
                                            <a class='btn btn-info btn-xs' title='edit' onclick='event.preventDefault();staffeditview(" . $stf['stf_id'] . ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> | ";

                                    if ($stf["staff_deleted"] == "0") {
                                        echo "<button title='deactivate' onclick='event.preventDefault();update_staff_status(" . $stf["stf_id"] .",1)' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                    } else {
                                        echo "<button title='activate' onclick='event.preventDefault();update_staff_status(" . $stf["stf_id"] . ",0)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                                    }

                                    echo "</td></tr>";

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
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#staff_look').DataTable({
            'ordering': true,
            'lengthMenu': [10, 20, 50]
        });
    });


    function update_staff_status(stf_id, new_status)
    {
        $.post("<?php echo base_url('staff/update_staff_status') ?>", {'stf_id': stf_id, 'new_status': new_status},
                function (data)
                {
                    location.reload();
                },
                "json"
                );
    }


    function load_staffeditview(stf)
    {

        window.location = '<?php echo base_url("staff/staffprof_view") ?>?id=' + (window.btoa(stf));

    }



    function staffeditview(stf)
    {
        window.location = '<?php echo base_url("staff/staffeditview") ?>?id=' + (window.btoa(stf)) + '&type=edit';
    }
    
    function search_staff_details()
    {
        $('.se-pre-con').fadeIn('slow');
        $('#staff_look').DataTable().destroy();
        $('#staff_look').DataTable({
                'ordering': true,
                'lengthMenu': [10, 20, 50],
                "columnDefs": [ {
                        "targets": 4,
                        "orderable": false,
                        "className":'text-center'
                        } ]
            });
        $('#staff_look').DataTable().clear().draw();
                
        var center_id = $('#center_id').val();
        $.post("<?php echo base_url('staff/view_staff_by_center') ?>", {'center_id': center_id},
        function (data)
        {
        $('.se-pre-con').fadeOut('slow');
                if (data.length > 0) 
                {
                    for (j = 0; j < data.length; j++) {

                        number_content = "<td align='center'>" + (j + 1) + "</td>";
                        
                        if(data[j]['staff_deleted'] == 0){
                            deleted = "<button title='deactivate' onclick='event.preventDefault();update_staff_status(" + data[j]['stf_id'] + ",1)' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                        }else{
                            deleted = "<button title='activate' onclick='event.preventDefault();update_staff_status(" + data[j]["stf_id"] + ",0)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                        }
                        action_content = "<td align='center'><a class='btn btn-default btn-xs' title='profile' onclick='event.preventDefault();load_staffeditview(" + data[j]['stf_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a>|\n\
                                          <a class='btn btn-info btn-xs' title='edit' onclick='event.preventDefault();staffeditview(" + data[j]['stf_id'] + ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>|"+ deleted +"</td>";

                        $('#staff_look').DataTable().row.add([
                            number_content,
                            data[j]['title_name'] + " "+ data[j]['stf_fname'] + " " +data[j]['stf_lname'],
                            data[j]['name'],
                            data[j]['nic'],
                            action_content
                        ]).draw(false);
                    }
                }
        },
        "json"
        );
        
    }

</script>
