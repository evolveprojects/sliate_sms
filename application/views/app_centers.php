<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
?>


<script type="text/javascript">
    
    $(document).ready(function () {
        
        load_centers();
    });
        
    function load_centers()
    {
        $('#br_table_body').empty();
        
        $.post("<?php echo base_url('App/load_centers') ?>", 
        function (data)
        {
            
            if (data.length > 0)
            {
                for (i = 0; i < data.length; i++) {
                    $('#br_table_body').append("<tr><td>[" + data[i]['br_code'] + '] - ' + data[i]['br_name'] + "</td><td>" + data[i]['br_addl1'] + ((data[i]['br_addl2'] != null) ? ', ' + data[i]['br_addl2'] : '') + ((data[i]['br_city'] != null) ? ', ' + data[i]['br_city'] : '') + ((data[i]['br_country'] != null) ? ', ' + data[i]['br_country'] : '') + "</td><td>" + data[i]['br_telephone'] +
                            "</td><td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_branch_load(" + data[i]['br_id'] + ")'>Edit</a><a class='btn btn-info btn-xs' onclick='event.preventDefault();delete_center(" + data[i]['br_id'] + ")'>Delete</a></td></tr>");
                }
            } else
            {
                $('#br_table_body').append("<tr><td colspan='5'>No Branch found under this group</td></tr>");
            }
            
        },
        "json"
        );
    }
    
    function edit_branch_load(id)
    {
        $.post("<?php echo base_url('App/edit_center_load') ?>", {"id": id},
        function (data)
        {
            
            $('#br_id').val(data.br_id);
            // $('#brgrp').val(data.br_group);
            $('#brname').val(data.br_name);
            $('#brcode').val(data.br_code);
            $('#braddl1').val(data.br_addl1);
            $('#brcity').val(data.br_city);
            $('#brtelephone').val(data.br_telephone);
            
        },
        "json"
        );
    }
    function delete_center(br_id)
    {
        $.post("<?php echo base_url('App/delete_branch') ?>", {"br_id": br_id},
        function (data)
        {
            location.reload();
        },
        "json"
        );
    }
    

</script>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Center Manager</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Center Manager</li>
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
                        <h5 class="m-0">Centers</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="frm_Center" name="set_capacity_form" method="post" action="<?php echo base_url('App/save_center') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" id="br_id" name="br_id">
                                    <label for="brname" class="col-md-3 control-label">Center Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="brname" name="brname" placeholder="">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="brcode" class="col-md-3 control-label">Center Code</label>
                                    <div class="col-md-4">
                                        <input type="text" data-validation="required" maxlength="10" class="form-control" id="brcode" name="brcode" placeholder="">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="braddl1" class="col-md-3 control-label">Address</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="braddl1" name="braddl1" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="brcity" class="col-md-3 control-label">City</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="brcity" name="brcity" placeholder="City">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="brtelephone" class="col-md-3 control-label">Telephone</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="brtelephone" name="brtelephone" onkeypress = "return AllowNumbersOnly(event)"  placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long">
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                     </div>
                                <!--
                                    <div class="form-group">
                                    <label for="brfax" class="col-md-3 control-label">Fax</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="brfax" name="brfax" onkeypress = "return AllowNumbersOnly(event)" placeholder="" data-validation="required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long">
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>-->
                                    
                                </div>
                                
                            </div>
                            <div class="panel-footer">
                                <button onclick="event.preventDefault();$('#frm_Center').trigger('submit');" class="btn btn-primary">Save</button> 
                                <button onclick="event.preventDefault();$('#frm_Center').trigger('reset');$('#br_id').val('');" class="btn btn-default">Reset</button>		  
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Manage Centers</h5>
                        </div>
                        <div class="card-body" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-striped table-bordered dt-responsive" id="table4" >
                                <thead>
                                    <tr>
                                        <th>Center</th>
                                        <th>Address</th>
                                        <th>Telephone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="br_table_body" >
                                    <tr>
                                        <td colspan="5">Select a group to search branches</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
