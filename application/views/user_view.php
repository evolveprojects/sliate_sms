<?php
$predata = $this->auth->get_ugroup_options();
?>
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> USER MANAGEMENT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>System Access</li>
            <li><i class="fa fa-user"></i>User</li>
        </ol>
    </div>
</div>

<!--Nav tabs-->
<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active"><a href="#user_tab" aria-controls="user_tab" role="tab" data-toggle="tab">User</a></li>
    <li role="presentation"><a href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">User Lookup</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user_tab">

        <div class="row">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <!--<header class="panel-heading">
                                Manage User Groups
                            </header>-->
                            <!--<div class="panel-body">-->
                            <br>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('user/save_user') ?>" id="grp_form" autocomplete="off" novalidate>
                                <div class="form-group">
                                    <input type="hidden" id="usr_id" name="usr_id">
                                    <label for="grname" class="col-md-2 control-label">Name</label>
                                    <div class="col-md-9" style="margin-right: -100px; margin-bottom: 10px;">									
                                        <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="usname" name="usname" placeholder="" style="display: unset;" onblur="duplicate_user_check();">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                        <label style="color: red" id="user_duplicate_error_txt"></label>
                                    </div>
                                    <div class="col-md-2">
                                        <label style="color: red" id="user_duplicate_error_txt"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="acc_level" class="col-md-2 control-label">User Group Name</label>
                                    <div class="col-md-9">
                                        <select name="user_group_select" id="user_group_select" class="form-control" onchange="load_user_group_branch(this.value);">
                                            <option value=""></option>
                                            <?php
                                            foreach ($groups as $grp) {
                                                echo '<option value="' . $grp['ug_id'] . '">' . $grp['ug_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="acc_level" class="col-md-2 control-label">User Center</label>
                                    <div class="col-md-9">
                                        <input type="hidden" class="form-control" id="user_branch" name="user_branch">
                                        <input type="text" class="form-control" id="user_branch_name" name="user_branch_name" readonly>
    <!--                                    <select name="user_branch" id="user_branch" class="form-control">
                                            <option value=""></option>
                                        <?php
//                                                foreach($branches as $brnch)
//                                                { 
//                                                    echo '<option value="'.$brnch['br_id'].'"> ['.$brnch['br_code'].'] - '.$brnch['br_name'].'</option>';
//                                                }
                                        ?>
                                        </select>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-2 control-label">User Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="" data-validation="email" data-validation-error-msg-email="Invalid E-mail"  value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="group_id1" name="group_id1">
                                    <label for="grname" class="col-md-2 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="uspass" name="uspass" placeholder="">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="group_id2" name="group_id2">
                                    <label for="grname" class="col-md-2 control-label">Re-type Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="ruspass" name="ruspass" placeholder="">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" class="btn btn-info">Save</button> 
                                        <button type="reset" class="btn btn-default"  onclick="changeinputtype();">Reset</button>
                                    </div>
                                </div>
                            </form>




                            <!--                                         delete confirmation 
                                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" id="modal-btn-si">Si</button>
                                                      <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                            
                                              <div class="alert" role="alert" id="result"></div>-->

                        </div>
                    </div>
                    <div class="panel-body">
                    </div>

                </section>
            </div>

        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="lookup_tab">

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        User Look Up
                    </header>

                    <div class="col-md-12">


                        <div class="row">
                            <div class="form-group col-md-4">
                                <!--<div class="col-md-7" style="margin-bottom: -44px; z-index: 1; margin-top: 40px;">-->
                                    <label for="acc_level" class="col-md-4 control-label">Access Level</label>
                                    <select type="text" class="form-control" id="acc_level" name="acc_level">
                                        <option value=''></option>
                                        <?php
                                        echo $predata['ops'];
                                        ?>
                                    </select>
                                <!--</div>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label for="group" class="control-label">User Group</label>

                                <select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="group" name="group">
                                    <option value=''></option>
                                    <?php
                                    foreach ($groups as $grp) {
                                        if ($grp['ug_level'] >= 2) {
                                            echo "<option value='" . $grp['ug_id'] . "'>" . $grp['ug_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <br>
                                <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>
                               
                            </div>
                        </div>


                        <table id="user_table" class="table table-bordered dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <!--<th>User Employee</th>-->
                                    <th>User Group</th>
                                    <!--<th>Group</th>-->
                                    <th>Branch</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $usr) {
                                    if ($usr['user_status'] == 'A') {
                                        $status_btn = "<a class='btn btn-warning btn-sm' style='width: 80px;' onclick='event.preventDefault();update_status(" . $usr['user_id'] . ",\"D\",\"" . $usr['user_name'] . "\")'>Deactivate</a>";
                                    } else {
                                        $status_btn = "<a class='btn btn-success btn-sm' style='width: 80px;' onclick='event.preventDefault();update_status(" . $usr['user_id'] . ",\"A\",\"" . $usr['user_name'] . "\")'>Activate</a>";
                                    }
                                    //if($usr['ug_level']== '1'){
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>" . $usr['user_name'] . "</td>";
                                    //echo "<td style='text-align: center;'>".$usr['user_employee']."</td>";
                                    echo "<td style='text-align: center;'>" . ($usr['user_ugroup'] != null ? $usr['ug_name'] : '-') . "</td>";
                                    //echo "<td style='text-align: center;'>".($usr['user_group']!=null?$usr['grp_name']:'-')."</td>";
                                    echo "<td>" . ($usr['user_branch'] != null ? $usr['br_code'] . ' - ' . $usr['br_name'] : '-') . "</td>";
                                    echo "<td style='text-align: center;'><a class='btn btn-info btn-sm' onclick='event.preventDefault();reset_user(" . $usr['user_id'] . ")'>Reset</a> " . $status_btn . " <a class='btn btn-danger btn-sm' id='btnOpenDialog' onclick='event.preventDefault();delete_user(" . $usr['user_id'] . ")'>Delete</a> <a class='btn btn-primary btn-sm' onclick='event.preventDefault();edit_user_load(" . $usr['user_id'] . ",\"" . $usr['user_name'] . "\",\"" . $usr['user_ugroup'] . "\",\"" . $usr['br_id'] . "\",\"" . $usr['br_name'] . "\",\"" . $usr['user_email'] . "\")'>Edit</a></td>";
                                    echo "</tr>";
                                    //}
                                }
                                ?>
                            </tbody>
                        </table>							
                    </div>
                    <div class="panel-body"></div>

            </div>
        </div>

    </div>

    <div id="dialog-confirm"></div>

    <script type="text/javascript">

        var flag = 0;
        var pre_name = '';

        $.validate({
            form: '#user_form',
            modules: 'security',
            onModulesLoaded: function () {
                var optionalConfig = {
                    fontSize: '12pt',
                    padding: '4px',
                    bad: 'Very bad',
                    weak: 'Weak',
                    good: 'Good',
                    strong: 'Strong'
                };

                $('input[name="password"]').displayPasswordStrength(optionalConfig);
            }
        });

        $.validate({
            form: '#grp_form'
        });


//        $(document).ready(function () {
//            $('#user_table').DataTable({
//                'ordering': true,
//                'lengthMenu': [10, 25, 50, 75, 100],
//                "columnDefs": [{
//                        "targets": 3,
//                        "orderable": false
//                    }]
//            });
//
//            $('form').bind('submit', function () {
//                $(this).find(':input').prop('disabled', false);
//            });
//            //load_year_list();
//            filter_acc_level();
//        });




        function search_student_details()
        {
            $('.se-pre-con').fadeIn('slow');
            var acc_level = $('#acc_level').val();
            var group = $('#group').val();
            //alert(acc_level);
            

            $.post("<?php echo base_url('User/get_user_groups_lookup') ?>", {'acc_level': acc_level, 'group': group},
                    function (data)
                    {
                        $('.se-pre-con').fadeOut('slow');
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            $('#user_table').DataTable().destroy();
            
                            $('#user_table').DataTable().clear().draw();

                            if (data.length > 0) {

                                action2 = "";
                                action3 = "";

                                for (j = 0; j < data.length; j++) {
                                    if ((data[j]['user_status']) == 'A') {
                                        btn_content1 = "<a class='btn btn-warning btn-sm' style='width: 80px;' onclick='event.preventDefault();update_status(" + data[j]['user_id'] + ",\"D\",\"" + data[j]['user_name'] +  "\")'>Deactivate</a>";
                                    } else {
                                        btn_content1 = "<a class='btn btn-success btn-sm' style='width: 80px;' onclick='event.preventDefault();update_status(" + data[j]['user_id'] + ",\"A\",\"" + data[j]['user_name'] + "\")'>Activate</a>";
                                    }
                                   
                                    
                                    btn_content = "<td style='text-align: center;'><a class='btn btn-info btn-sm' onclick='event.preventDefault();reset_user(" + data[j]['user_id'] + ")'>Reset</a> " + btn_content1 + " <a class='btn btn-danger btn-sm' id='btnOpenDialog' onclick='event.preventDefault();delete_user(" + data[j]['user_id'] + ")'>Delete</a> <a class='btn btn-primary btn-sm' onclick='event.preventDefault();edit_user_load(" + data[j]['user_id'] + ",\"" + data[j]['user_name'] + "\",\"" + data[j]['user_ugroup'] + "\",\"" + data[j]['br_id'] + "\",\"" + data[j]['br_name'] +  "\",\"" + data[j]['user_email'] +  "\")'>Edit</a></td>";
                             

                                    $('#user_table').DataTable().row.add([
                                        data[j]['user_name'],
                                        data[j]['ug_name'],
                                        data[j]['br_name'],
                                        // data[j]['br_code'],
                                        btn_content
                                    ]).draw(false);
                                }
                            }
                        }
                    },
                    "json"
                    );


        }










        function edit_group_load(id, name, description, acclevel)
        {
            $('#group_id').val(id);
            $('#grname').val(name);
            $('#description').val(description);
            $('#acclevel').val(acclevel);
        }

        function reset_user(id)
        {
            $.post("<?php echo base_url('user/reset_user') ?>", {"id": id},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }

        function update_status(id, status, uname)
        {
            $.post("<?php echo base_url('user/update_status') ?>", {"id": id, "status": status, 'uname': uname},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }

        function delete_user(id, status)
        {
            $("#dialog-confirm").html("Do you really want to delete?");

            // Define the Dialog and its properties.
            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                title: "Delete",
                height: 140,
                width: 400,
                draggable: false,
                buttons: [
                    {
                        text: "Yes",
                        "class": 'btn btn-info',
                        click: function () {
                            $(this).dialog('close');
                            $.post("<?php echo base_url('user/delete_user') ?>", {"id": id},
                                    function (data)
                                    {
                                        location.reload();
                                    },
                                    "json"
                                    );
                        }
                    },
                    {
                        text: "No",
                        "class": 'btn btn',
                        click: function () {
                            $(this).dialog('close');
                        }
                    }
                ]
            }).prev(".ui-dialog-titlebar").css({'background': '#74caee', 'border-color': '#74caee'});

        }
        function save_user(id)
        {
            $.post("<?php echo base_url('user/save_user') ?>", {"id": id},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }
        function edit_user_load(id, unam, ugrp, ubrid, ubrname, ubemail) {

            $('#all_tabs a[href="#user_tab"]').tab('show');

            pre_nam = unam;
            flag = 1;
            if(ubemail == null){
                ubemail = '';
            }
            $('#usr_id').val(id);
            $('#usname').val(unam).attr('readonly', true);
            $('#user_group_select').val(ugrp);
            $('#user_branch').val(ubrid);
            $('#user_branch_name').val(ubrname);
            $('#email').val(ubemail);
        }


        function duplicate_user_check() {

            var usrname = $('#usname').val();

            $.post("<?php echo base_url('user/check_duplicate_user') ?>", {'usrname': usrname},
                    function (data)
                    {
                        if (flag == 1)
                        {
                            if (pre_name != usrname)
                            {
                                if (data['usrname_count'] == "1")
                                {

                                    $('#user_duplicate_error_txt').text("User Already Exists! Use Another Name.");

                                } else {
                                    $('#user_duplicate_error_txt').text("");
                                }
                            } else {
                                $('#user_duplicate_error_txt').text("");
                            }
                        } else {
                            if (data['usrname_count'] == "1")
                            {

                                $('#user_duplicate_error_txt').text("User Already Exists! Use Another Name.");

                            } else {
                                $('#user_duplicate_error_txt').text("");
                            }
                        }


                    },
                    "json"
                    );
        }


        $('#grp_form').on('submit', function (e) {
            validateUserField(e)
        });

        function validateUserField(e)
        {
            var txt = $('#user_duplicate_error_txt').text();

            if (txt != "") {
                e.preventDefault();

                //funcres = {status: "denied", message: "Register Number Already Exists"};
                //result_notification(funcres);

                return false;
            }

        }


        function load_user_group_branch(user_group) {

            $.post("<?php echo base_url('user/get_user_group_branch') ?>", {'user_group': user_group},
                    function (data)
                    {
                        if (data != null) {
                            $('#user_branch').val(data['br_id']);
                            $('#user_branch_name').val(data['br_name']);
                        }

                    },
                    "json"
                    );
        }

        function changeinputtype() {

            flag = 0;
            $("#usname").attr('readonly', false);
        }

        function filter_acc_level() {

            var type_val;

            //        if($('input[name=acc_level]:1')){
            //            type_val = $('input[name=type]:checked').val();
            //        }

            /* if(type_val == "gender"){
             $('#header1').text("Male");
             $('#header2').text("Female");
             }
             if(type_val == "time"){
             $('#header1').text("Part Time");
             $('#header2').text("Full Time");
             } */

            $.post("<?php echo base_url('User/filter_accuser_detail') ?>", {'type_val': type_val},
                    function (data)
                    {
                        console.log(data);
                        $('#center_full_sum').DataTable().destroy();


                        /* $('#center_full_sum').DataTable({
                         'ordering': true,
                         'paging': false,
                         "columnDefs": [ {
                         "targets": 4,
                         "className": "text-center"
                         },
                         {
                         "targets": 5,
                         "className": "text-center"
                         }],
                         'footerCallback': function ( row, data, start, end, display ) {
                         
                         var api = this.api(), data;
                         
                         // Remove the formatting to get integer data for summation
                         var intVal = function ( i ) {
                         return typeof i === 'string' ?
                         i.replace(/[\$,]/g, '')*1 :
                         typeof i === 'number' ?
                         i : 0;
                         };
                         
                         // Total over all pages
                         total_5 = api
                         .column(4)
                         .data()
                         .reduce(function (a, b) {
                         return intVal(a) + intVal(b);
                         }, 0);
                         
                         total_6 = api
                         .column(5)
                         .data()
                         .reduce(function (a, b) {
                         return intVal(a) + intVal(b);
                         }, 0);
                         
                         // Total over this page
                         //                        pageTotal = api
                         //                            .column(5, {page: 'current'})
                         //                            .data()
                         //                            .reduce(function (a, b) {
                         //                                return intVal(a) + intVal(b);
                         //                        }, 0);
                         
                         // Update footer
                         $( api.column(0).footer()).html(
                         'Grand Total'
                         );
                         
                         $( api.column(4).footer()).html(
                         total_5
                         );
                         
                         $( api.column(5).footer()).html(
                         total_6
                         );
                         
                         }
                         }); */

                        $('#center_full_sum').DataTable().clear();

                        var r = 1;
                        for (x = 0; x < data.length; x++) {

                            $('#center_full_sum').DataTable().row.add([
                                data[x]['user_name'],
                                data[x]['ug_name'],
                                data[x]['br_name']
                            ]).draw(false);

                            r++;
                        }
                    },
                    "json"
                    );
        }

        //--------delete dialog box---------
        //function fnOpenNormalDialog() {
        //    $("#dialog-confirm").html("Confirm Dialog Box");
        //
        //    // Define the Dialog and its properties.
        //    $("#dialog-confirm").dialog({
        //        resizable: false,
        //        modal: true,
        //        title: "Modal",
        //        height: 140,
        //        width: 400,
        //        draggable: false,
        //        buttons: [
        //            {
        //                text: "Yes",
        //                "class": 'btn btn-info',
        //                click: function() {
        //                    $(this).dialog('close');
        //                    callback(true);
        //                }
        //            },
        //            {
        //                text: "No",
        //                "class": 'btn btn',
        //                click: function() {
        //                    $(this).dialog('close');
        //                    callback(false);
        //                }
        //            }
        //        ]
        ////        buttons: {
        ////            "Yes": function () {
        ////                $(this).dialog('close');
        ////                callback(true);
        ////            },
        ////                "No": function () {
        ////                $(this).dialog('close');
        ////                callback(false);
        ////            }
        ////        }
        //    }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'});
        //}


        //$('#btnOpenDialog').click(fnOpenNormalDialog);
        //
        //function callback(value) {
        //    if (value) {
        //        alert("Confirmed");
        //    } else {
        //        alert("Rejected");
        //    }
        //}
    </script>
