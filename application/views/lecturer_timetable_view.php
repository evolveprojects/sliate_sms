<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Lecturer Time Table</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Lecturer Timetable</li>
        </ol>
    </div>
</div>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="grp_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">Look Up</a></li>
    <li role="presentation"><a id="#addexam_tab" href="#addexam_tab" aria-controls="company_tab" role="tab" data-toggle="tab">Add Lecturer Time Table</a></li>
    <li role="presentation"><a id="#assign_tab" href="#assign_tab" aria-controls="assign_tab" role="tab" data-toggle="tab">Assign Timetable</a></li>
    <li role="presentation"><a id="#conflicts_tab" href="#conflicts_tab" aria-controls="conflicts_tab" role="tab" data-toggle="tab">Conflicts</a></li>

</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <header class="panel-heading">
                Staff Look Up
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="timetable_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr bgcolor="#F0F8FF">
                                    <th>#</th>
                                    <th>Timetable Code</th>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>LecturerTT01</th>
                                    <th>Permanent</th>
                                    <th>2017-06-01</th>
                                    <th>2017-12-01</th>
                                    <th> 
                                        <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                        <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>
                                    </th>
                                </tr>

                                <tr>
                                    <th>2</th>
                                    <th>LecturerTT02</th>
                                    <th>Optional</th>
                                    <th>2017-08-01</th>
                                    <th>2017-10-01</th>
                                    <th> 
                                        <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                        <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="addexam_tab">
        <div class="row">				
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-3">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>"
                                                <option value="0">select course</option>			
                                            <option value="1">Civil</option>
                                            <option value="2">IT</option>
                                            <option value="3">Electronic</option>
                                        </select>											
                                    </div>				         
                                </div>				
                            </div>
                            <div class="form-group col-md-3">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="0">select year</option>			
                                            <option value="1">1st year</option>
                                            <option value="2">2nd year</option>
                                            <option value="3">3rd year</option>	

                                        </select>											
                                    </div>				         
                                </div>				
                            </div>
                            <div class="form-group col-md-3">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="0">select semester</option>			
                                            <option value="1">1st semester</option>
                                            <option value="2">2nd semester</option>
                                            <option value="3">3rd semester</option>		

                                        </select>											
                                    </div>				         
                                </div>				
                            </div>
                            <div class="form-group col-md-3">							
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Term:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="0">select term</option>			
                                            <option value="1">1st term</option>
                                            <option value="2">2nd term</option>
                                            <option value="3">3rd term</option>

                                        </select>											
                                    </div>				         
                                </div>				
                            </div>
                        </div><br/><br/><br/>
                        <!--<div class="row">-->
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Timetable Code:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="dname" name="dname"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>				         
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Type:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">
                                            <option value="0">select type</option>			
                                            <option value="1">Permanent</option>
                                            <option value="2">Temporary</option>
                                        </select>
                                    </div>				         
                                </div>
                            </div>
                        </div><br/><br/><br/>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Time Period:</label>
                                    <div class="col-md-9">
                                        <div class="col-md-6">
                                            From:<input type="date" class="form-control" id="datepicker4" name="sbirth" placeholder="00.00.00" value="">
                                        </div>
                                        <div class="col-md-6">
                                            To:<input type="date" class="form-control" id="datepicker5" name="sbirth" placeholder="00.00.00" value="">
                                        </div>

                                    </div>				         
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Description:</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>				         
                                </div>
                            </div>
                        </div>
                        <br/><br/><br/>
                        <div class="form-group col-md-10"></div>
                        <div class="form-group col-md-2">
                            <button type="button" name="save_btn" onclick="//return  validateForm()" id="save_btn" class="btn btn-info">Create</button>
                        </div>
                        <br/><br/><br/>

                        <div class="col-md-4"><br/>					
                            <form name='myForm'class="form-horizontal" role="form" action="<?php echo base_url('course/course_view') ?>" method="post"  id="reg_form" autocomplete="off" novalidate>		

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Date:</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" id="datepicker" name="sbirth" placeholder="YYYY-MM-DD" value="">											
                                    </div>				         
                                </div> 
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Start Time:</label>
                                    <div class="col-md-9">
                                        <input type="time" class="form-control" id="timepicker" name="sbirth" placeholder="00.00.00" value="">											
                                    </div>				         
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">End Time:</label>
                                    <div class="col-md-9">
                                        <input type="time" class="form-control" id="timepicker" name="sbirth" placeholder="00.00.00" value="">											
                                    </div>				         
                                </div>								


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Subject Group:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="2">select year</option>			
                                            <option value="0">compulsory</option>
                                            <option value="1">optional</option>

                                        </select>											
                                    </div>				         
                                </div>  					
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Subject:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="0">select subject</option>			
                                            <option value="1">D.structure</option>
                                            <option value="2">D.Maths</option>
                                            <option value="3">Statistics</option> 
                                        </select>												
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Lecturer:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">

                                            <option value="0">1</option>			
                                            <option value="1">2</option>
                                            <option value="2">3</option>
                                            <option value="3">4</option> 
                                        </select>												
                                    </div>    
                                </div>
                                <div class="form-group"><br/>	
                                    <label for="inputEmail3" class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" name="save_btn" onclick="return  validateForm()" id="save_btn" class="btn btn-info">Save</button>

                                        <button type="reset" name="Reset" class="btn btn-default">Reset</button>												
                                    </div>    
                                </div>
                                <br><br><br>                	
                            </form>				     
                        </div>
                        <div class="col-md-8"><br/>
                            <table class="table table-striped table-bordered " style="width:100%" align="center">
                                <thead>
                                    <tr>
                                        <th align="center">Time</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>								
                                        <td>9.00 - 10.00 am</td>
                                        <td>Data Structures<br/>Prof. 1</td>
                                        <td>Maths<br/>Prof. 2</td>
                                        <td>Leadership skills<br/>Prof. 2</td>
                                        <td>Psychology<br/>Prof. 3</td>	
                                        <td>Computer Science<br/>Prof. 2</td>
                                    </tr>
                                    <tr>								
                                        <td>10.00 - 11.00 am<br/>Prof. 2</td>
                                        <td>Data Structures<br/>Prof. 2</td>
                                        <td>Maths<br/>Prof. 5</td>
                                        <td>Leadership skills<br/>Prof. 2</td>
                                        <td>Psychology<br/>Prof. 2</td>	
                                        <td>Computer Science<br/>Prof. 2</td>
                                    </tr>
                                    <tr>								
                                        <td>11.00 - 12.00 am</td>
                                        <td>Data Structures<br/>Prof. 1</td>
                                        <td>Maths<br/>Prof. 2</td>
                                        <td>Leadership skills<br/>Prof. 4</td>
                                        <td>Psychology<br/>Prof. 5</td>	
                                        <td>Computer Science<br/>Prof. 3</td>
                                    </tr>
                                    <tr>								
                                        <td>12.00 - 13.00 pm</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>	
                                        <td></td>
                                    </tr>
                                    <tr>								
                                        <td>13.00 - 14.00 pm</td>
                                        <td>Data Structures<br/>Prof. 5</td>
                                        <td>Maths<br/>Prof. 2</td>
                                        <td>Leadership skills<br/>Prof. 3</td>
                                        <td>Psychology<br/>Prof. 2</td>	
                                        <td>Computer Science<br/>Prof. 3</td>
                                    </tr>
                                    <tr>								
                                        <td>14.00 - 15.00 pm</td>
                                        <td>Data Structures<br/>Prof. 2</td>
                                        <td>Maths<br/>Prof. 4</td>
                                        <td>Leadership skills<br/>Prof. 1</td>
                                        <td>Psychology<br/>Prof. 6</td>	
                                        <td>Computer Science<br/>Prof. 1</td>
                                    </tr>
                                    <tr>								
                                        <td>15.00 - 16.00 pm</td>
                                        <td>Data Structures<br/>Prof. 2</td>
                                        <td>Maths<br/>Prof. 2</td>
                                        <td>Leadership skills<br/>Prof. 2</td>
                                        <td>Psychology<br/>Prof. 2</td>	
                                        <td>Computer Science<br/>Prof. 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

        </div>	
    </div>

    <div role="tabpanel" class="tab-pane" id="assign_tab">
        <div class="panel">
            <header class="panel-heading">
                Assign Timetable
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="row">
                        <div class="form-group col-md-3">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Branch:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">
                                        <option value="0">select branch</option>			
                                        <option value="1">branch 1</option>
                                        <option value="2">branch 2</option>
                                        <option value="3">branch 3</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-3">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>"
                                            <option value="0">select course</option>			
                                        <option value="1">Civil</option>
                                        <option value="2">IT</option>
                                        <option value="3">Electronic</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-3">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">
                                        <option value="0">select year</option>			
                                        <option value="1">1st year</option>
                                        <option value="2">2nd year</option>
                                        <option value="3">3rd year</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-3">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">
                                        <option value="0">select semester</option>			
                                        <option value="1">1st semester</option>
                                        <option value="2">2nd semester</option>
                                        <option value="3">3rd semester</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-xs-1">
                                </div>
                                <label for="inputEmail3" class="col-md-4 control-label">Permanent Time table:</label>
                                <div class="col-md-6">
                                    <input type="text" height="70" disabled value="Timetable 01" class="form-control" id="dname" name="dname"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                </div>
                                <br/><br/><br/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-xs-1">
                                </div>
                                <label for="inputEmail3" class="col-md-4 control-label">Temporary Time table:</label>
                                <div class="col-md-6">
                                    <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">			
                                        <option value="1">Temp1</option>
                                        <option value="2">Temp2</option>
                                        <option value="3">Temp3</option>	
                                    </select>
                                </div>
                                <br/><br/><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-7">	
                                <div class="form-group col-md-12">							
                                    <div class="form-group">
                                        <button type="submit" name="save_btn" onclick="return  validateForm()" id="save_btn" class="btn btn-info">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="conflicts_tab">
        <div class="panel">
            <header class="panel-heading">
                Conflicts
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-md-6">							
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Branch:</label>
                            <div class="col-md-9">
                                <div class="clone_div2" id="clone_div2">
                                    <div id="clonedInput2" class="clonedInput row">
                                        <div class="col-md-7">

                                            <select type="text" class="form-control" id="scourse" name="scourse" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["course"] : ''); ?>">
                                                <option value="0">select branch</option>			
                                                <option value="1">Branch 1</option>
                                                <option value="2">Branch 2</option>
                                                <option value="3">Branch 3</option>	
                                            </select><br/>
                                        </div>

                                        <div class="col-md-5">
                                            <span class="button-group">
                                                <button onclick="cloning2(null, null)" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                                <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry"><span class="glyphicon glyphicon-minus"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group col-md-2">							
                        <div class="form-group">
                            <button type="submit" name="save_btn" onclick="//return  validateForm()" id="save_btn" class="btn btn-info">Search for Conflicts </button>
                        </div>
                    </div>
                    <div class="form-group col-md-2">							
                        <div class="form-group">
                            <button type="submit" name="save_btn" onclick="//return  validateForm()" id="save_btn" class="btn btn-info">Conflicts Report </button>											
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <label for="inputEmail3" class="col-md-2 control-label">Conflicts:</label>
                        No conflicts to show.
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>		


<link href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('assets/jquery-2.2.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min') ?>"></script>

<script>

                                save_method = 'update';
                                $(document).ready(function () {
                                    $('#timetable_look').DataTable({
                                        'ordering': true,
                                        'lengthMenu': [10, 25, 50, 75, 100]
                                    });
                                });





</script>


<script>

    $(function () {
        $("#datepicker").datepicker();
    });
</script>
<script type="text/javascript">

    $(function () {
        $("#datepicker2").datepicker();
    });
    $(function () {
        $("#datepicker3").datepicker();
    });
    //    $(function () {
    //        $("#datepicker4").datepicker();
    //    });
    //    $(function () {
    //        $("#datepicker5").datepicker();
    //    });

    var cloneid = 0;
    function cloning2()
    {
        cloneid += 1;
        //alert(cloneid);
        var container = document.getElementById('clone_div2');
        var clone = $('#clonedInput2').clone();



        clone.find('.remove_entry').attr('id', cloneid);
        clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();Calculate_gr_tot()');

        $('.clone_div2').append(clone);
    }






</script>