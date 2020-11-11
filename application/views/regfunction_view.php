<div class="row">
	<div class="col-md-12">
		<h3 class="page-header"><i class="fa fa-bank"></i> ACCESS RIGHTS</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
			<li><i class="fa fa-cog"></i>Settings</li>
			<li><i class="fa fa-bank"></i>Access Rights</li>
		</ol>
	</div>
</div>
<div>
<br>
<div class="row">
	<div class="col-md-12">
	  	<section class="panel">
		    <header class="panel-heading">
		        Register Function
		    </header>
	      	<div class="panel-body">	
	          	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('authmanage/update_function_details')?>" id="func_form" autocomplete="off" novalidate>
	              	<div class="form-group">
	              		<input type="hidden" id="func_id" name="func_id">
	                  	<label for="name" class="col-md-2 control-label">Function Name</label>
	                  	<div class="col-md-10">
	                  		<datalist id="funcs">
	                  		<?php
	                  			if($function_id=="")
	                  			{
	                  				foreach ($pre_data['functions'] as $fun) 
		                      		{
		                      			echo "<option value='".$fun['func_id']."'>".$fun['func_name']."</option>";
		                      		}
		                      		$readonly = "";
	                  			}
	                  			else
	                  			{
	                  				$readonly = "readonly";
	                  			}
	                  		?>
	                  		</datalist>
	                      	<input type="text" list="funcs" onchange="load_function_data(this.value)" class="form-control" id="name" name="name" placeholder="" <?php echo $readonly;?>>
	                    </div>
	              	</div>
	              	<div class="form-group">
	                  	<label for="funcmodule" class="col-md-2 control-label">Module</label>
	                  	<div class="col-md-5">
	                      	<input type="text" list="modules"  data-validation="required" class="form-control" id="funcmodule" name="funcmodule" placeholder="" onchange='load_submodule(this.value)'>
	                      	<datalist id="modules">
		                      	<?php 
		                      		foreach ($pre_data['modules'] as $mod) 
		                      		{
		                      			echo "<option value='".$mod['func_module']."'>".$mod['func_module']."</option>";
		                      		}
		                      	?>
	                      	</datalist>
	                    </div>
	              	</div>
	              	<div class="form-group">
	                  	<label for="submodule" class="col-md-2 control-label">Sub Module</label>
	                  	<div class="col-md-5">
	                      	<input type="text" list="submodes" data-validation="required" class="form-control" id="submodule" name="submodule" placeholder="">
	                      	<datalist id="submodes"></datalist>
	                    </div>
	              	</div>
					<div class="form-group">
	                    <label for="func_type" class="col-md-2 control-label">Function Type</label>
	                    <div class="col-md-5">
	                        <select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="func_type" name="func_type">
	                            <option value=''></option>
	                            <option value='Page Open'>Page Open</option>
	                            <option value='Insert'>Insert</option>
	                            <option value='Update'>Update</option>
	                            <option value='Activate/Deactivate'>Activate/Deactivate</option>
	                            <option value='Insert/Update'>Insert/Update</option>
	                            <option value='Search - pre data'>Search - pre data</option>
	                            <option value='Search - Main Lookup'>Search - Main Lookup</option>
	                            <option value='Search - Detail View'>Search - Detail View</option>
	                            <option value='Delete'>Delete</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="ui_type" class="col-md-2 control-label">UI Category</label>
	                    <div class="col-md-5">
	                        <select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="ui_type" name="ui_type">
	                            <option value=''></option>
	                            <option value='Full Page'>Full Page</option>
	                            <option value='Tab'>Tab</option>
	                            <option value='Submit Button'>Submit Button</option>
	                            <option value='Search Button'>Search Button</option>
	                            <option value='Action Button'>Action Button</option>
	                            <option value='Input Event'>Input Event</option>
	                        </select>
	                    </div>
	                </div>
	              	<div class="form-group">
	                  	<label for="url" class="col-md-2 control-label">URL</label>
	                  	<div class="col-md-8">
	                      	<input type="text" class="form-control" id="url" name="url" placeholder="" readonly>
	                    </div>
	              	</div>
	              	<div class="form-group">
	                  	<label for="description" class="col-md-2 control-label">Description</label>
	                  	<div class="col-md-8">
	                  		<textarea class="form-control" id="description" name="description" ></textarea>
	                  </div>
	              	</div>
	              	<div class="form-group">
	                  	<label for="developer" class="col-md-2 control-label">Developer</label>
	                  	<div class="col-md-5">
	                      	<input type="text" class="form-control" id="developer" name="developer" readonly>
	                    </div>
	              	</div> 
	              	<div class="form-group">
	                  	<label for="developer" class="col-md-2 control-label">Editable</label>
	                  	<div class="col-md-5">
	                      	<input type="checkbox" id="editable" name="editable" >
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
<script type="text/javascript">

$( document ).ready(function() {
	func_id = "<?php echo $function_id;?>";
	if(func_id!="")
	{
		load_function_data(func_id);
	}
	
});

$.validate({
   	form : '#func_form'
});

function load_function_data(id)
{
	$.post("<?php echo base_url('authmanage/load_function_data')?>",{"id":id},
		function(data)
		{
			load_submodule(data.func_module);
			$('#func_id').val(data.func_id);
			$('#name').val(data.func_name);
			$('#funcmodule').val(data.func_module);
			$('#submodule').val(data.func_submodule);
			$('#url').val(data.func_url);
			$('#description').val(data.func_description);
			$('#developer').val(data.func_developer);
			$('#func_type').val(data.func_type);
			$('#ui_type').val(data.func_uitype);

			if(data.func_isedit==1)
			{
				$('#editable').prop('checked', true);
			}
			else
			{
				$('#editable').prop('checked', false);
			}
		},	
		"json"
	);
}

function load_submodule(mainmod)
{
	if(mainmod != '' || mainmod != ' ')
	$('#submodes').empty()
	$.post("<?php echo base_url('authmanage/load_submodule')?>",{"mainmod":mainmod},
		function(data)
		{
			for (i = 0; i<data.length; i++) 
			{
				$('#submodes').append("<option value='"+data[i]['func_submodule']+"'>"+data[i]['func_submodule']+"</option>");
			}
		},	
		"json"
	);
}
</script>
