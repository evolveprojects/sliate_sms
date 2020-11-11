<div class="row">
	<div class="col-md-12">
		<h3 class="page-header"><i class="fa fa-bank"></i> COMPANY</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
			<li><i class="fa fa-cog"></i>Settings</li>
			<li><i class="fa fa-bank"></i>Company</li>
		</ol>
	</div>
</div>

  	<!-- Nav tabs -->
  	
  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="company_tab">
    		<br>
    		<div class="row">
				<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					       Student Information
					    </header>
				      	<div class="panel-body">	
				          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/update_stu_info')?>" id="stu_form" autocomplete="off" novalidate>
				              	<div class="form-group">
				              		<input type="hidden" id="comp_id" name="stu_id" value="<?php echo $comp_info['stu_id']?>">
				                  	<label for="name" class="col-md-2 control-label">Name</label>
				                  	<div class="col-md-10">
				                      	<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="name" name="name" placeholder="" value="<?php echo $comp_info['comp_name']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brnum" class="col-md-2 control-label">Reg.No.</label>
				                  	<div class="col-md-5">
				                      	<input type="text" class="form-control" id="brnum" name="brnum" placeholder="" value="<?php echo $comp_info['comp_brno']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="comcode" class="col-md-2 control-label">Comp.Code</label>
				                  	<div class="col-md-5">
				                      	<input type="text" data-validation="required" class="form-control" id="comcode" name="comcode" placeholder="" value="<?php echo $comp_info['comp_code']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="addl1" class="col-md-2 control-label">Address</label>
				                  	<div class="col-md-8">
				                      	<input type="text" class="form-control" id="addl1" name="addl1" placeholder="" value="<?php echo $comp_info['comp_addl1']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="addl2" class="col-md-2 control-label"></label>
				                  	<div class="col-md-8">
				                      	<input type="text" class="form-control" id="addl2" name="addl2" placeholder="" value="<?php echo $comp_info['comp_addl2']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="city" class="col-md-2 control-label"></label>
				                  	<div class="col-md-5">
				                      	<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $comp_info['comp_city']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div> 
				              	<div class="form-group">
				                  	<label for="country" class="col-md-2 control-label"></label>
				                  	<div class="col-md-5">
				                      	<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $comp_info['comp_country']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="telephone" class="col-md-2 control-label">Telephone</label>
				                  	<div class="col-md-4">
				                      	<input type="text" class="form-control" id="telephone" name="telephone" placeholder="" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" data-validation-optional="true" value="<?php echo $comp_info['comp_telephone']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="fax" class="col-md-2 control-label">Fax</label>
				                  	<div class="col-md-4">
				                      	<input type="text" class="form-control" id="fax" name="fax" placeholder="" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" data-validation-optional="true" value="<?php echo $comp_info['comp_fax']?>">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<div class="col-md-offset-2 col-md-11">
				                      	<button type="submit" class="btn btn-info">Save</button> 
				                      	<button type="submit" class="btn btn-default">Reset</button>
				                  	</div>
				              	</div>
				          	</form>
				      	</div>
				  	</section>
			  	</div>
			</div>
    	</div>
    	<div role="tabpanel" class="tab-pane" id="group_tab">
    		<br>
    		<div class="row">
				<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					        Manage Groups
					    </header>
				      	<div class="panel-body">	
				          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_group')?>" id="grp_form" autocomplete="off" novalidate>
				              	<div class="form-group">
				              		<input type="hidden" id="group_id" name="group_id">
				                  	<label for="grname" class="col-md-2 control-label">Group Name</label>
				                  	<div class="col-md-10">
				                      	<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="grname" name="grname" placeholder="">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<div class="col-md-offset-2 col-md-11">
				                      	<button type="submit" class="btn btn-info">Save</button> 
				                      	<button onclick="event.preventDefault();$('#grp_form').trigger('reset');$('#group_id').val('');" class="btn btn-default">Reset</button>
				                  	</div>
				              	</div>
				          	</form>
				      	</div>
				  	</section>
			  	</div>
			  	<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					       Look Up
					    </header>
				      	<div class="panel-body">	
				          	<table class="table">
				          		<thead>
				          			<tr>
				          				<th>Group</th>
				          				<th>Actions</th>
				          			</tr>
				          		</thead>
				          		<tbody>
			          				<?php
			          					foreach ($grp_info as $grp) 
			          					{
			          						echo "<tr>";
			          						echo "<td>".$grp['grp_name']."</td>";
			          						echo "<td><a class='btn btn-info btn-sm' onclick='event.preventDefault();edit_group_load(".$grp['grp_id'].",\"".$grp['grp_name']."\")'>Edit</a></td>";
			          						echo "</tr>";
			          					}
			          				?>
				          		</tbody>
				          	</table>
				      	</div>
				  	</section>
			  	</div>
			</div>
    	</div>
    	<div role="tabpanel" class="tab-pane" id="branch_tab">
    		<br>
    		<div class="row">
				<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					        Manage Branches
					    </header>
				      	<div class="panel-body">	
				          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_branch')?>" id="br_form" autocomplete="off" novalidate>
				          		<div class="form-group">
				                  	<label for="br_grp" class="col-md-2 control-label">Group</label>
				                  	<div class="col-md-10">
				                      	<select type="text" class="form-control" data-validation="required" onchange="load_branches(this.value)" data-validation-error-msg-required="Field can not be empty" id="brgrp" name="brgrp">
				                      		<option value=''></option>
				                      		<?php
					          					foreach ($grp_info as $grp) 
					          					{
					          						echo "<option value='".$grp['grp_id']."'>".$grp['grp_name']."</option>";
					          					}
					          				?>
				                      	</select>
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				              		<input type="hidden" id="br_id" name="br_id">
				                  	<label for="brname" class="col-md-2 control-label">Branch Name</label>
				                  	<div class="col-md-10">
				                      	<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="brname" name="brname" placeholder="">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brcode" class="col-md-2 control-label">Branch Code</label>
				                  	<div class="col-md-5">
				                      	<input type="text" data-validation="required" class="form-control" id="brcode" name="brcode" placeholder="">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="braddl1" class="col-md-2 control-label">Address</label>
				                  	<div class="col-md-8">
				                      	<input type="text" class="form-control" id="braddl1" name="braddl1" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="braddl2" class="col-md-2 control-label"></label>
				                  	<div class="col-md-8">
				                      	<input type="text" class="form-control" id="braddl2" name="braddl2" placeholder="">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brcity" class="col-md-2 control-label"></label>
				                  	<div class="col-md-5">
				                      	<input type="text" class="form-control" id="brcity" name="brcity" placeholder="City">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div> 
				              	<div class="form-group">
				                  	<label for="brcountry" class="col-md-2 control-label"></label>
				                  	<div class="col-md-5">
				                      	<input type="text" class="form-control" id="brcountry" name="brcountry" placeholder="Country">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brtelephone" class="col-md-2 control-label">Telephone</label>
				                  	<div class="col-md-4">
				                      	<input type="text" class="form-control" id="brtelephone" name="brtelephone" placeholder="" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" data-validation-optional="true">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brfax" class="col-md-2 control-label">Fax</label>
				                  	<div class="col-md-4">
				                      	<input type="text" class="form-control" id="brfax" name="brfax" placeholder="" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" data-validation-optional="true">
				                      	<!-- <p class="help-block">Example block-level help text here.</p> -->
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<div class="col-md-offset-2 col-md-11">
				                      	<button type="submit" class="btn btn-info">Save</button> 
				                      	<button type="submit" class="btn btn-default">Reset</button>
				                  	</div>
				              	</div>
				          	</form>
				      	</div>
				  	</section>
			  	</div>
			  	<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					       Look Up
					    </header>
				      	<div class="panel-body">	
				          	<table class="table">
				          		<thead>
				          			<tr>
				          				<th>Branch</th>
				          				<th>Address</th>
				          				<th>Telephone</th>
				          				<th>Fax</th>
				          				<th>Actions</th>
				          			</tr>
				          		</thead>
				          		<tbody id="br_table_body">
			          				<tr>
				          				<td colspan="5">Select a group to search branches</td>
				          			</tr>
				          		</tbody>
				          	</table>
				      	</div>
				  	</section>
			  	</div>
			</div>
    	</div>
    	<div role="tabpanel" class="tab-pane" id="fyear_tab">
    		<br>
    		<div class="row">
				<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					        Financial Year
					    </header>
				      	<div class="panel-body">	
				          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_fyear')?>" id="fy_form" autocomplete="off" novalidate>
				          		<div class="form-group">
				          			<input type="hidden" id="fy_id" name="fy_id">
				                  	<label for="br_grp" class="col-md-2 control-label">Start Date</label>
				                  	<div class="col-md-10">
				                      	<div id="fs_date_div" class="input-group date">
								    		<input class="form-control" type="text" name="fs_date" id="fs_date"  data-format="YYYY-MM-DD">
								    		<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
								    		</span>
							    		</div>
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brname" class="col-md-2 control-label">End Date</label>
				                  	<div class="col-md-10">
					                  	<div id="fe_date_div" class="input-group date">
								    		<input class="form-control" type="text" name="fe_date" id="fe_date"  data-format="YYYY-MM-DD">
								    		<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
								    		</span>
							    		</div>
							    	</div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="developer" class="col-md-2 control-label">Current Year</label>
				                  	<div class="col-md-5">
				                      	<input type="checkbox" id="is_curr" name="is_curr" >
				                    </div>
				              	</div> 
				              	<div class="form-group">
				                  	<div class="col-md-offset-2 col-md-11">
				                      	<button type="submit" class="btn btn-info">Save</button> 
				                      	<button type="submit" class="btn btn-default">Reset</button>
				                  	</div>
				              	</div>
				          	</form>
				      	</div>
				  	</section>
			  	</div>
			  	<div class="col-md-6">
				  	<section class="panel">
					    <header class="panel-heading">
					       Look Up
					    </header>
				      	<div class="panel-body">	
				          	<table class="table">
				          		<thead>
				          			<tr>
				          				<th>financial Year</th>
				          				<th>Actions</th>
				          			</tr>
				          		</thead>
				          		<tbody>
			          				<?php
			          					foreach ($fy_info as $fy) 
			          					{
			          						if($fy['fi_iscurryear']==1)
			          						{
			          							echo "<tr class='danger'>";
			          						}
			          						else
			          						{
			          							echo "<tr>";
			          						}
			          						echo "<td>".$fy['fi_startdate']." - ".$fy['fi_enddate']."</td>";
			          						echo "<td><a class='btn btn-info btn-sm' onclick='event.preventDefault();edit_fy_year(".$fy['es_finance_masterid'].",\"".$fy['fi_startdate']."\",\"".$fy['fi_enddate']."\",\"".$fy['fi_iscurryear'] ."\")'>Edit</a></td>";
			          						echo "</tr>";
			          					}
			          				?>
				          		</tbody>
				          	</table>
				      	</div>
				  	</section>
			  	</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="ayear_tab">
    		<br>
    		<div class="row">
				<div class="col-md-7">
				  	<section class="panel">
					    <header class="panel-heading">
					        Academic Year
					    </header>
				      	<div class="panel-body">	
				          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_ayear')?>" id="ay_form" autocomplete="off" novalidate>
				          		<div class="form-group">
				          			<input type="hidden" id="ay_id" name="ay_id">
				                  	<label for="br_grp" class="col-md-2 control-label">Start Date</label>
				                  	<div class="col-md-10">
				                      	<div id="as_date_div" class="input-group date">
								    		<input class="form-control" type="text" name="as_date" id="as_date"  data-format="YYYY-MM-DD">
								    		<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
								    		</span>
							    		</div>
				                  </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="brname" class="col-md-2 control-label">End Date</label>
				                  	<div class="col-md-10">
					                  	<div id="ae_date_div" class="input-group date">
								    		<input class="form-control" type="text" name="ae_date" id="ae_date"  data-format="YYYY-MM-DD">
								    		<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
								    		</span>
							    		</div>
							    	</div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="developer" class="col-md-2 control-label">Current Year</label>
				                  	<div class="col-md-5">
				                      	<input type="checkbox" id="is_curr_a" name="is_curr_a" >
				                    </div>
				              	</div>
				              	<div class="form-group">
				                  	<label for="terms" class="col-md-2 control-label">Number of terms</label>
				                  	<div class="col-md-5">
				                      	<input type="text" onblur="load_inputs(this.value)" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="terms" name="terms" placeholder="">
				                  </div>
				              	</div> 
				              	<div class="row" id="terms_div">
				              	</div>
				              	<hr>
				              	<br>
				              	<div class="form-group">
				                  	<label for="intakes" class="col-md-2 control-label">Number of intakes</label>
				                  	<div class="col-md-5">
				                      	<input type="text" onblur="load_intake_inputs(this.value)" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="intakes" name="intakes" placeholder="">
				                  	</div>
				              	</div> 
				              	<div class="row" id="intakes_div">
				              	</div>
				              	<hr>
				              	<div class="form-group">
				                  	<div class="col-md-offset-2 col-md-11">
				                  		<br>
				                      	<button type="submit" class="btn btn-info">Save</button> 
				                      	<button type="submit" class="btn btn-default">Reset</button>
				                  	</div>
				              	</div>
				          	</form>
				      	</div>
				  	</section>
			  	</div>
			  	<div class="col-md-5">
				  	<section class="panel">
					    <header class="panel-heading">
					       Look Up
					    </header>
				      	<div class="panel-body">	
				          	<table class="table">
				          		<thead>
				          			<tr>
				          				<th>Academic Year</th>
				          				<th>Actions</th>
				          			</tr>
				          		</thead>
				          		<tbody>
			          				<?php
			          					foreach ($ay_info as $ay) 
			          					{
			          						if($ay['ac_iscurryear']==1)
			          						{
			          							echo "<tr class='danger'>";
			          						}
			          						else
			          						{
			          							echo "<tr>";
			          						}
			          						echo "<td>".$ay['ac_startdate']." - ".$ay['ac_enddate']."</td>";
			          						echo "<td><a class='btn btn-info btn-sm' onclick='event.preventDefault();edit_ay_year(".$ay['es_ac_year_id'].",\"".$ay['ac_startdate']."\",\"".$ay['ac_enddate']."\",\"".$ay['ac_iscurryear'] ."\")'>Edit</a></td>";
			          						echo "</tr>";
			          					}
			          				?>
				          		</tbody>
				          	</table>
				      	</div>
				  	</section>
			  	</div>
			</div>
		</div>
  	</div>

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

$(document).ready(function() 
{
    $tab_id = '<?php echo $_GET['tab_id']?>';

    if($tab_id=='group')
    {
    	$( "#grp_tab" ).trigger( "click" );
    }
    else if($tab_id=='branch')
    {
		$( "#br_tab" ).trigger( "click" );
    }
    else if($tab_id=='fyear')
    {
    	$( "#fy_tab" ).trigger( "click" );
    }
    else if($tab_id=='ayear')
    {
    	$( "#ay_tab" ).trigger( "click" );
    }
    else
    {
    	$( "#comp_tab" ).trigger( "click" );
    }
});

$('#fs_date_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
$('#fe_date_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
$('#as_date_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
$('#ae_date_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});

$.validate({
   	form : '#comp_form'
});

$.validate({
   	form : '#grp_form'
});

$.validate({
   	form : '#ay_form'
});

$.validate({
   	form : '#fy_form'
});

function edit_group_load(id,name)
{
	$('#group_id').val(id);
	$('#grname').val(name);
}

function load_branches(id)
{
	$('#br_table_body').empty();
	if(id!="")
	{
		$.post("<?php echo base_url('company/load_branches')?>",{'id':id},
			function(data)
			{	
				if(data.length>0)
				{	
					for (i = 0; i<data.length; i++) {
					   $('#br_table_body').append("<tr><td>["+data[i]['br_code']+'] - '+data[i]['br_name']+"</td><td>"+data[i]['br_addl1']+((data[i]['br_addl2']!=null)?', '+data[i]['br_addl2']:'')+((data[i]['br_city']!=null)?', '+data[i]['br_city']:'')+((data[i]['br_country']!=null)?', '+data[i]['br_country']:'')+"</td><td>"+data[i]['br_telephone']+"</td><td>"+data[i]['br_fax']+"</td><td><a class='btn btn-info btn-sm' onclick='event.preventDefault();edit_branch_load("+data[i]['br_id']+")'>Edit</a></td></tr>");
					}
				}
				else
				{
					$('#br_table_body').append("<tr><td colspan='5'>No Branch found under this group</td></tr>");
				}
			},	
			"json"
		);
	}
	else
	{
		$('#br_table_body').append("<tr><td colspan='5'>Select a group to search branches</td></tr>");
	}
	
}

function edit_branch_load(id)
{
	$.post("<?php echo base_url('company/edit_branch_load')?>",{"id":id},
		function(data)
		{
			$('#br_id').val(data.br_id);
			// $('#brgrp').val(data.br_group);
			$('#brname').val(data.br_name);
			$('#brcode').val(data.br_code);
			$('#braddl1').val(data.br_addl1);
			$('#braddl2').val(data.br_addl2);
			$('#brcity').val(data.br_city);
			$('#brcountry').val(data.br_country);
			$('#brtelephone').val(data.br_telephone);
			$('#brfax').val(data.br_fax);
		},	
		"json"
	);
}

function edit_fy_year(id,sdate,edate,stat)
{
	$('#fy_id').val(id);
	$('#fs_date').val(sdate);
	$('#fe_date').val(edate);

	if(stat==1)
	{
		$('#is_curr').prop('checked', true);
	}
	else
	{
		$('#is_curr').prop('checked', false);
	}
}

function edit_ay_year(id,sdate,edate,stat)
{
	$('#ay_id').val(id);
	$('#as_date').val(sdate);
	$('#ae_date').val(edate);

	if(stat==1)
	{
		$('#is_curr_a').prop('checked', true);
	}
	else
	{
		$('#is_curr_a').prop('checked', false);
	}

	$('#terms_div').empty();
	$('#intakes_div').empty();
	$.post("<?php echo base_url('company/load_terms')?>",{'id':id},
		function(data)
		{
			if(data['terms'].length>0)
			{
				$('#terms').val(data['terms'].length);	
				for (i = 0; i<data['terms'].length; i++) {
				   $('#terms_div').append("<div class='col-md-12'><div class='row'><input type='hidden' value='"+data['terms'][i]['term_id']+"' id='trm_id_"+data['terms'][i]['term_number']+"' name='trm_id_"+data['terms'][i]['term_number']+"'>"
						+"<div class='col-md-3'><input value='"+data['terms'][i]['term_number']+"' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='term_"+data['terms'][i]['term_number']+"' name='term_"+data['terms'][i]['term_number']+"'></div>"
						+"<div class='col-md-4'><div id='sdate_"+data['terms'][i]['term_number']+"_div' class='input-group date'><input class='form-control' type='text' name='sdate_"+data['terms'][i]['term_number']+"' id='sdate_"+data['terms'][i]['term_number']+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
						+"<div class='col-md-4'><div id='edate_"+data['terms'][i]['term_number']+"_div' class='input-group date'><input class='form-control' type='text' name='edate_"+data['terms'][i]['term_number']+"' id='edate_"+data['terms'][i]['term_number']+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
						+"</div></div>");

				   	$('#sdate_'+data['terms'][i]['term_number']+'_div').datetimepicker({ defaultDate: data['terms'][i]['term_sdate'],  pickTime: false});
					$('#edate_'+data['terms'][i]['term_number']+'_div').datetimepicker({ defaultDate: data['terms'][i]['term_edate'],  pickTime: false});
				}
			}
			else
			{
				$('#terms').val('');
			}

			if(data['intakes'].length>0)
			{
				$('#intakes').val(data['intakes'].length);	
				for (i = 0; i<data['intakes'].length; i++) {
				   $('#intakes_div').append("<div class='col-md-12'><div class='row'><input type='hidden' id='int_id_"+data['intakes'][i]['int_number']+"' name='int_id_"+data['intakes'][i]['int_number']+"' value='"+data['intakes'][i]['int_id']+"'>"
						+"<div class='col-md-2'><input value='"+data['intakes'][i]['int_number']+"' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='intnum_"+data['intakes'][i]['int_number']+"' name='intnum_"+data['intakes'][i]['int_number']+"'></div>"
						+"<div class='col-md-3'><input value='"+data['intakes'][i]['int_name']+"' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='intname_"+data['intakes'][i]['int_number']+"' name='intname_"+data['intakes'][i]['int_number']+"'></div>"
						+"<div class='col-md-3'><div id='intsdate_"+data['intakes'][i]['int_number']+"_div' class='input-group date'><input  style='padding-left:5px;padding-right:0px' class='form-control' type='text' name='intsdate_"+data['intakes'][i]['int_number']+"' id='intsdate_"+data['intakes'][i]['int_number']+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
						+"<div class='col-md-3'><div id='intedate_"+data['intakes'][i]['int_number']+"_div' class='input-group date'><input  style='padding-left:5px;padding-right:0px' class='form-control' type='text' name='intedate_"+data['intakes'][i]['int_number']+"' id='intedate_"+data['intakes'][i]['int_number']+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
						+"</div></div>");

				   	$('#intsdate_'+data['intakes'][i]['int_number']+'_div').datetimepicker({ defaultDate: data['intakes'][i]['int_start'],  pickTime: false});
					$('#intedate_'+data['intakes'][i]['int_number']+'_div').datetimepicker({ defaultDate: data['intakes'][i]['int_end'],  pickTime: false});
				}
			}
			else
			{
				$('#intakes').val('');
			}
		},	
		"json"
	);
}

function load_inputs(num)
{
	$('#terms_div').empty();
	for (i = 1; i<=num; i++) {
	   	$('#terms_div').append("<div class='col-md-12'><div class='row'><input type='hidden' id='trm_id_"+i+"' name='trm_id_"+i+"'>"
			+"<div class='col-md-3'><input value='"+i+"' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='term_"+i+"' name='term_"+i+"'></div>"
			+"<div class='col-md-4'><div id='sdate_"+i+"_div' class='input-group date'><input class='form-control' type='text' name='sdate_"+i+"' id='sdate_"+i+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
			+"<div class='col-md-4'><div id='edate_"+i+"_div' class='input-group date'><input class='form-control' type='text' name='edate_"+i+"' id='edate_"+i+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
			+"</div></div>");

	   	$('#sdate_'+i+'_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
		$('#edate_'+i+'_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
	}
}

function load_intake_inputs(num)
{
	$('#intakes_div').empty();
	for (i = 1; i<=num; i++) {
	   	$('#intakes_div').append("<div class='col-md-12'><div class='row'><input type='hidden' id='int_id_"+i+"' name='int_id_"+i+"'>"
			+"<div class='col-md-2'><input value='"+i+"' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='intnum_"+i+"' name='intnum_"+i+"'></div>"
			+"<div class='col-md-3'><input value='' type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='intname_"+i+"' name='intname_"+i+"'></div>"
			+"<div class='col-md-3'><div id='intsdate_"+i+"_div' class='input-group date'><input style='padding-left:5px;padding-right:0px' class='form-control' type='text' name='intsdate_"+i+"' id='intsdate_"+i+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
			+"<div class='col-md-3'><div id='intedate_"+i+"_div' class='input-group date'><input style='padding-left:5px;padding-right:0px' class='form-control' type='text' name='intedate_"+i+"' id='intedate_"+i+"' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
			+"</div></div>");

	   	$('#intsdate_'+i+'_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
		$('#intedate_'+i+'_div').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
	}
}
</script>
