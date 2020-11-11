<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> ADD ASSIGNMENT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Assignment</li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Add Assignment
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='myForm'class="form-horizontal" role="form" action="<?php echo base_url('course/course_view') ?>" method="post"  id="reg_form" autocomplete="off" novalidate>		
                        <br>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Assignment code:</label>
                            <div class="col-md-7">
                                <input type="text" height="70"  class="form-control" id="scourse_intro" name="scourse_intro"  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["acode"] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Assignment name:</label>
                            <div class="col-md-7">
                                <input type="text" height="70"  class="form-control" id="scourse_intro" name="scourse_intro"  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["acode"] : ''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Grading method:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="gmethod" name="gmethod" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["gmethod"] : ''); ?>">
                                    <option value="2">Select</option>	
                                    <option value="2">A</option>			
                                    <option value="0">B</option>
                                    <option value="1">C</option>
                                    <option value="1">F</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Branch:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="gmethod" name="gmethod" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["gmethod"] : ''); ?>">
                                    <option value="2">Select</option>	
                                    <option value="2">Branch 1</option>			
                                    <option value="0">Branch 2</option>
                                    <option value="1">Branch 3</option>
                                    <option value="1">Branch 4</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="year" name="year" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["year"] : ''); ?>">
                                    <option value="2">Select</option>	
                                    <option value="2">1</option>			
                                    <option value="0">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>					
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="year" name="year" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["year"] : ''); ?>">
                                    <option value="2">Select</option>	
                                    <option value="2">1</option>			
                                    <option value="0">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>					
                                </select>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Course year:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="dyear" name="dyear" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["dyear"] : ''); ?>">
                                    <option value="2">Select</option>	
                                    <option value="2">1</option>			
                                    <option value="0">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="semester" name="semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["semester"] : ''); ?>">
                                    <option value="2">1</option>			
                                    <option value="0">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Subject:</label>
                            <div class="col-md-7">
                                <select type="text" class="form-control" id="semester" name="semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["semester"] : ''); ?>">
                                    <option value="2">Select</option>			
                                    <option value="0">subject 1</option>
                                    <option value="0">subject 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Add Assignment
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <table class="table table-bordered table-striped viewregstudent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Assignment code</th>
                                <th>Assignment name</th>
                                <th>Grading method</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>1001</th>
                                <th>Presentaion</th>
                                <th>test</th>

                                <th>
                                    <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                    <button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

    $(function () {
        $("#datepicker").datepicker();



    }
    );


    $(function () {
        $("#datepicker2").datepicker();



    }
    );


    save_method = 'update';
    $(function () {
        $('.viewregstudent').DataTable();
    });


</script>


