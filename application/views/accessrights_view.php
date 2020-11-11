<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-key"></i> USER GROUP MANAGEMENT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-lock"></i>System Access</li>
            <li><i class="fa fa-key"></i>Access Rights</li>
        </ol>
    </div>
</div>
<div>
<div class="panel">
    <header class="panel-heading">
        Manage Group Access Rights
    </header>
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('authmanage/set_rights')?>" id="ar_form" autocomplete="off" novalidate>
    <div class="panel-body">
    	<div class="row">
<!--    		<div class="col-md-1"></div>-->
    		<div class="col-md-4">
    			<div class="form-group">
                  	<label for="group" class="col-md-3 control-label">User Group</label>
                  	<div class="col-md-9">
                      	<select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="group" name="group" onchange="load_user_right_data(this.value);">
                      		<option value=''></option>
                      		<?php
	          					foreach ($groups as $grp) 
	          					{
	          						if($grp['ug_level']>=2)
	          						{
	          							echo "<option value='".$grp['ug_id']."'>".$grp['ug_name']."</option>";
	          						}
	          					}
	          				?>
                      	</select>
                  	</div>
              	</div>
    		</div>
    		<div class="col-md-3">
    			<div class="form-group">
                  	<label for="module" class="col-md-3 control-label">Module</label>
                  	<div class="col-md-9">
                      	<select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="module" name="module">
                      		<option value='all'>All</option>
                      		<?php
                                    foreach ($pre_data['modules'] as $mod) 
                                    {
                                        if($mod['func_module'] != null){
                                            echo "<option value='".$mod['func_module']."'>".$mod['func_module']."</option>";
                                        }
                                    }
	          		?>
                      	</select>
                  	</div>
              	</div>
    		</div>
    		<div class="col-md-3">
    		<div class="form-group">
                    <label for="comp" class="col-md-3 control-label">Company</label>
                    <div class="col-md-9">
                    <select type="text" class="form-control" data-validation="required" onchange="load_branches(this.value)" data-validation-error-msg-required="Field can not be empty" id="comp" name="comp">
                        <option value=''></option>
                        <?php
                            foreach ($company as $grp) 
                            {
                                    $selected = '';
                                    if($grp['grp_id'] == 1)
                                    {
                                            $selected = 'selected';
                                    }
                                    echo "<option value='".$grp['grp_id']."' ".$selected.">".$grp['grp_name']."</option>";
                            }
                        ?>
                    </select>
                </div>
              	</div>
    		</div>
    	</div>
    	<br>
    	<div class="row">
            <div class="form-group">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8">
                        <label class="col-md-2 control-label">Center</label>
                        <div class="col-md-6" id="branchlistdiv" style="height: 100px; overflow-y: scroll;"></div>
                        <br/><br/><br/>
                        <label style="width:100%;margin-left: 100px;color: red" id="branch_validation" name="branch_validation"></label>
                    </div>
                </div>
            </div>
                </div>
    	</div>
  		<br/><br/><br/>
  		<div class="row">
  			<div class="col-md-1"></div>
  			<div class="col-md-9" style="text-align: right;margin-top: -50px">
  				<a class='btn btn-info btn-sm' onclick='event.preventDefault();search_right()'>Search</a>
  			</div>
  		</div>
  		<hr>
  		<table class="table table-bordered">
      		<thead>
      			<tr>
      				<th>Sub Module</th>
      				<th>Description</th>
      				<th>Select</th>
      			</tr>
      		</thead>
      		<tbody id="grp_table">
  				<tr><td colspan='5'>Select User Group to Load Rights.</td></tr>
      		</tbody>
      	</table>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-info">Save</button> 
        <button type="reset" class="btn btn-default">Reset</button>
    </div>
    </form>
</div>
</div>

<script type="text/javascript">

 $(document).ready(function () {
     load_branches(1);   
    });

$.validate({
   	form : '#ar_form'
});

function search_right()
{
        $('.se-pre-con').fadeIn('slow');
	group  = $('#group').val();
	module = $('#module').val();

	var branchary = [];

	$(".branch_chk:checked").each(function() {
		branchary.push($(this).val());
	});

	//var facultsary = [];

//	$(".facults_chk:checked").each(function() {
//		facultsary.push($(this).val());
//	});

	$('#grp_table').empty();

	$.post("<?php echo base_url('authmanage/search_right')?>",{"group":group,"module":module,"branchary":branchary}, //,"facultsary":facultsary
		function(data)
		{
		    console.log(data);
                    $('.se-pre-con').fadeOut('slow');
			if(data == 'denied')
			{
        		funcres = {status:"denied", message:"You have no right to proceed the action"};
        		result_notification(funcres);
			}
			else
			{
				if(data.length>0)
				{	
					for (i = 0; i<data.length; i++) 
					{
						numchecked = 0;
						funcs = data[i]['functions'];

						for (x = 0; x<funcs.length; x++) 
						{
							if(funcs[x]['rgt_hasrgt']=='A')
							{
								++numchecked;
							}
						}

						if((funcs.length)==numchecked)
						{
							ch_stat = 'checked';
						}
						else
						{
							ch_stat = '';
						}

						modid = data[i]['func_module'].replace(/\s+/g, '_');
						modid = modid.replace("&", "_");
                       // alert('before : '+data[i]['func_module']+' after : '+modid)
                        if(data[i]['func_module']!='')
						$('#grp_table').append("<tr class='success'><td  colspan='2'><strong>"+data[i]['func_module']+"</strong></td><td><input type='checkbox' class='mod_check' id='"+data[i]['func_module']+"' name='mod_check[]' onclick='select_module_all(this.id,this.value)' value='ar_"+modid+"' "+ch_stat+"></td></tr>");

						for (x = 0; x<funcs.length; x++) 
						{
                                                    if((funcs[x]['func_description']) != null){
							if(funcs[x]['rgt_hasrgt']=='A')
							{
								func_stat = 'checked';
							}
							else
							{
								func_stat = '';
							}
//alert('sub model :'+funcs[x]['func_submodule']+'  desc : '+funcs[x]['func_description']);
							$('#grp_table').append("<tr><td>"+funcs[x]['func_submodule']+"</td><td>"+funcs[x]['func_description']+"</td><td><input type='checkbox' class='ar_"+modid+"' name='ar_check[]' value='"+funcs[x]['func_id']+"' "+func_stat+"></td></tr>");
                                                    }
                                                }
                                            
					}
				}
				else
				{
					$('#grp_table').append("<tr><td colspan='5'>Select User Group to Load Rights</td></tr>");
				}
			}
		},	
		"json"
	);
}

function load_branches(id)
{
	$('#branchlistdiv').empty();

	$.post("<?php echo base_url('company/load_branches')?>",{'id':id},
		function(data)
		{	
			if(data == 'denied')
			{
        		funcres = {status:"denied", message:"You have no right to proceed the action"};
        		result_notification(funcres);
			}
			else
			{
				brliststr = '';
				if(data.length>0)
				{	
					for (i = 0; i<data.length; i++) {
						brliststr += '<label class="checkbox-inline"><input type="checkbox" name="branch[]" id=branch_list class="branch_chk"   data-validation="checkbox_group" data-validation-qty="min1" data-validation-error-msg="You must select at least one branch" data-validation-error-msg-container="#branch_validation" value="'+data[i]['br_id']+'"> ['+data[i]['br_code']+'] - '+data[i]['br_name']+'</label><br>';
					}

					$('#branchlistdiv').append(brliststr+'<div id="branchvalidationmsgdiv"></div>');
				}
			}
		},	
		"json"
	);
}

function select_module_all(id,value)
{
	if(document.getElementById(id).checked)
	{
		$('.'+value).prop('checked', true);
	}
	else
	{
		$('.'+value).prop('checked', false);
	}
}

function load_user_right_data(ugroup){
    
    $.post("<?php echo base_url('authmanage/load_user_right_data')?>",{'ugroup':ugroup},
            function(data)
            {	
                if(data.length > 0){
                    $('input:checkbox').removeAttr('checked');

                    for(v=0; v<data.length; v++)
                    {
                        $('#module').val(data[v]['rlist_module']);
                        $('input[id=branch_list][value=' + data[v]['arbl_branch'] + ']').attr('checked', 'checked');
                    }

                     search_right();
                }
                else{
                    $('#module').val('all');
                    $('input:checkbox').removeAttr('checked');
                    $('#grp_table').empty();
                    $('#grp_table').append("<tr><td colspan='5'>Select User Group to Load Rights.</td></tr>");
                }
                
            },	
            "json"
    );
    
   
}

</script>
