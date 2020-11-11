<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Exam</li>
            <li><i class="fa fa-bank"></i>Marking Method</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <header class="panel-heading">
                Marking Method
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" name="marking_method_form" id="marking_method_form" role="form" method="post" action="" id="marking_method_form" autocomplete="off" novalidate>
                        <br>
                        <input type="hidden" name="marking_id" id="marking_id">
                        <input type="hidden" name="mark_code" id="mark_code">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Marking Code :</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" maxlength="10" id="m_code" name="m_code" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Marking Name :</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="m_name" name="m_name" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Description :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="m_des" name="m_des"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="clone_div" id="clone_div">
                                <div id="clonedInput1" class="clonedInput row">
                                    <input type="hidden" name="ssubid[]" id="ssubid">
                                    <div class="col-md-4">
                                        <select class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="m_type[]" id="m_type">
                                            <option value="">--- Type ---</option>
                                            <?php
                                            foreach ($marking_types as $row) {
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['type'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" height="70" placeholder="Marking Name" class="form-control" id="mt_comment" name="mt_comment[]"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" height="70" title="Percentage" placeholder="%" class="form-control" id="mt_percentage" name="mt_percentage[]" data-validation=" required number length" data-validation-error-msg-required="Field can not be empty" data-validation-length="1-100" data-validation-error-msg-number="Invalid Amount." data-validation-allowing="range[1;100],int">
                                    </div>

                                    <div class="col-md-20">
                                        <span class="button-group">
                                            <button onclick="cloning(null, null, null)" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                            <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                    </div>
                                    <br/>
                                </div>
                            </div>                          
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-3">
                            </div>
                            <button type="submit" class="btn btn-info btn-md" name="submit" onclick="event.preventDefault();save_marking_method();">Submit</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_view();">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="marking_lookup" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr bgcolor="#F0F8FF">
                                <th>#</th>
                                <th>Marking Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($marking_data as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo "[". $row['marking_code']."]-".$row['marking_name'] ?></td>
                                    <th>
                                        <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_marking_method('<?php print_r($row['id']) ?>', '<?php print_r($row['marking_code']) ?>', '<?php print_r($row['marking_name']) ?>', '<?php print_r($row['description']) ?>');"></span></button> |
                                        <?php if ($row['deleted']) { ?>
                                            <button type="button" title="activate" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_marking_status('<?php print_r($row['id']) ?>', '0','<?php print_r($row['marking_code']) ?>');"></span></button>
                                        <?php } else { ?>
                                            <button type="button" title="deactivate" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_marking_status('<?php print_r($row['id']) ?>', '1','<?php print_r($row['marking_code']) ?>');"></span></button>
                                            <?php } ?> 
                                    </th>
                                </tr>
                                <?php $i++;
                            }
                            ?>
                        </tbody>
                    </table>       
                </div>
            </div>    
        </div>
    </div>

</div>

<script type="text/javascript">
//    function load_credits(id){
//        
//    }
//    
    
    
    $.validate({
        form: '#marking_method_form'
    });

    $(document).ready(function () {

        $('#marking_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10]
        });
         $('#marking_lookup td').css('white-space', 'initial');
    });

    
    function save_marking_method() {
        
        var mark = $('#m_code').val();
        
        var mark_name = $('#m_name').val();
        
        var val1 = "";
        var val2 = "";
        var val3 = "";
        var total = 0;
        var matches = 0;
                
        for (i = 0; i <= cloneid; i++) {
            
            var extra1 = $('#m_type'+i+'').val();
            var extra2 = $('#mt_comment'+i+'').val();
            var extra3 = $('#mt_percentage'+i+'').val();

            if (i === 0) {
                val1 = document.getElementById("m_type").value;
                val2 = document.getElementById("mt_comment").value;
                val3 = document.getElementById("mt_percentage").value;
                
                total += parseInt(val3);
                

            } else {
                if((extra1 != null) && (extra2 != null) && (extra3 != null)){
                    val1 = document.getElementById("m_type" + i).value;
                    val2 = document.getElementById("mt_comment" + i).value;
                    val3 = document.getElementById("mt_percentage" + i).value;
                    
                    total += parseInt(val3);
                }
                else{
                    val1 = "";
                    val2 = "";
                    val3 = "";
                    total += 0;
                }
            }
            
            if(val1 != "" && val2 != "" && val3 != ""){
                matches++;
            }

        }
        
        if(mark == ""){

            funcres = {status: "denied", message: "Marking Code Cannot be Empty"};
            result_notification(funcres);
        }
        else if(mark_name == ""){

            funcres = {status: "denied", message: "Marking Name Cannot be Empty"};
            result_notification(funcres);
        }
        else if(matches == 0){

                funcres = {status: "denied", message: "At least one marking type, marking name and percentage should be selected!"};
                result_notification(funcres);
        }
        else if(total > 100){
            
            funcres = {status: "denied", message: "Marking Percentage total is grater than 100!"};
            result_notification(funcres);
        }
        else{
        
            $.ajax(
                {
                    url: "<?php echo base_url('marking_method/save_marking_method') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: $('#marking_method_form').serialize(),
                    success: function (data)
                    {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            console.log(data);
                            result_notification(data);
                            if (data['status'] == 'success') {
                                location.reload();
                            }
                        }
                    }
                });
            }
    }

    var cloneid = 0;
    
    function cloning(type_id, marking_name, percentage)
    {
        cloneid += 1;
        var container = document.getElementById('clone_div');
        var clone = $('#clonedInput1').clone();

        clone.find('#m_type').attr("class", "form-control temprw");

        clone.find('#m_type').attr('name', 'm_type[]');
        clone.find('#mt_comment').attr('name', 'mt_comment[]');
        clone.find('#mt_percentage').attr('name', 'mt_percentage[]');


        if (type_id != null) {
            clone.find('#m_type').val(type_id);
            clone.find('#mt_comment').val(marking_name);
            clone.find('#mt_percentage').val(percentage);
            clone.find('#m_type').attr('id', 'm_type' + cloneid + '');
            clone.find('#mt_comment').attr('id', 'mt_comment' + cloneid + '');
            clone.find('#mt_percentage').attr('id', 'mt_percentage' + cloneid + '');
        } else {
            clone.find('#m_type').val('');
            clone.find('#mt_comment').val('');
            clone.find('#mt_percentage').val('');
            clone.find('#m_type').attr('id', 'm_type' + cloneid + '');
            clone.find('#mt_comment').attr('id', 'mt_comment' + cloneid + '');
            clone.find('#mt_percentage').attr('id', 'mt_percentage' + cloneid + '');
        }

        clone.find('.remove_entry').attr('id', cloneid);
        clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');

        $('.clone_div').append(clone);
    }

    function change_marking_status(marking_id, new_status, m_code) {
        $.post("<?php echo base_url('marking_method/change_marking_status') ?>", {"marking_id": marking_id, "new_status": new_status, "m_code":m_code},
                function (data)
                {
                    location.reload();
                },
                "json"
                );
    }

    function edit_marking_method(marking_id, marking_code, marking_name, description) {
        $(".temprw").each(function (index) {
            $(this).parents(".clonedInput").remove();
        });

        $('#marking_id').val(marking_id);   
        $('#m_code').val(marking_code);
        //$('#mark_code').val(marking_code);
        $('#m_name').val(marking_name);
        $('#m_des').val(description);

        $.post("<?php echo base_url('marking_method/edit_load_marking_method') ?>", {'marking_id': marking_id},
                function (data)
                {

                    for (j = 0; j < data.length; j++) {
                        if (j == 0) {
                            $('#m_type').val(data[j]['type_id']);
                            $('#mt_comment').val(data[j]['name']);
                            $('#mt_percentage').val(data[j]['percentage']);
                        } else {
                            cloning(data[j]['type_id'], data[j]['name'], data[j]['percentage']);
                        }
                    }
                },
                "json"
                );

    }
    
    function reset_view() {
        $(".temprw").each(function (index) {
            $(this).parents(".clonedInput").remove();
        });
        
        $('#marking_id').val("");
        //$('#mark_code').val('');
        matches = 0;
        total = 0;
    }
    
//    function validateMarkingCode(){
//            
//        var marking_code = $('#m_code').val();
//
//        if(marking_code != $('#mark_code').val()){
//
//            $.post("<?php //echo base_url('subject/check_duplicate_marking_codes') ?>", {'marking_code': marking_code},
//            function (data)
//            {
//                alert(data['code_count']);
//                
//                if(data['code_count'] > 0){
//                    funcres = {status: "denied", message: "Marking Code Already Exists! Try Another Code."};
//                    result_notification(funcres);
//                }
//                else{
//                    save_marking_method();
//                }
//            },
//            "json"
//            );
//        }
//        else{
//            save_marking_method();
//        }
//    }
</script>