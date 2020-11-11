<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> ADMISSION FORM</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Admission</li>
        </ol>
    </div>
</div>
</div></section></div></div>
<div>

    <section class="panel">
        <header class="panel-heading">
            Personal Details of Applicant
        </header>
        <div class="panel-body">
            <div class="row">	

                <form class="form-horizontal" role="form" action="<?php echo base_url('student/save_student') ?>" method="post"  id="stu_form" autocomplete="off" novalidate>	
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="hidden" id="student_id" name="student_id" value="<?php echo $edit_stu[0]['id'];?>">
                                <label for="inputEmail3" class="col-sm-5 control-label">Name of Applicant:</label>
                                <div class="col-sm-7">

                                    <input type="text" class="form-control" id="sname" name="sname" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['name'];?>">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Applicant's Full Name:</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sfull_name" name="sfull_name" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['full_name'];?>">

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">Civil Status:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="scivil_status" name="scivil_status" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['civil_status'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Sex</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="ssex" name="ssex" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['sex'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">Date of Birth: </label>
                                <div class="col-sm-7">

                                    <input type="date" class="form-control" id="sdob" name="sdob" placeholder="YYYY-MM-DD" value="<?php echo $edit_stu[0]['dob'];?>">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Place of Birth:</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sp_birth" name="sp_birth" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['p_birth'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">Mobile Number:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sm_number" name="sm_number" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['m_number'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">E-mail</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="se_mail" name="se_mail" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['e_mail'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">NIC No: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="snic_no" name="snic_no" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['nic_no'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">NIC Issues Date:</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sissues_date" name="sissues_date" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['issues_date'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">A/L 2015 Index Number:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sindex_no" name="sindex_no" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['index_no'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">2015 A/L Used ID Type</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sid_type" name="sid_type" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['id_type'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">2015 A/L UsedID No: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sid_no" name="sid_no" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['id_no'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Citizen by descent:</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="scitizen" name="scitizen" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['citizen'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">Race  </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="srace" name="srace" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['race'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Religion </label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sreligion" name="sreligion" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['religion'];?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-5 control-label">If not,State Citizenship: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sstate_citiznship" name="sstate_citiznship" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['state_citiznship'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">If clergy,indicate the full name used prior to ordination:</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="sordination" name="sordination" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['ordination'];?>">

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
    </section>		











    <section class="panel">
        <header class="panel-heading">
            Details of Residence
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Permanent Address of Residence: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="saddress" name="saddress" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['address'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Adminis trative District:</label>
                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="sa_distric" name="sa_distric" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['a_distric'];?>">

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">District No:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sdistric_no" name="sdistric_no" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['distric_no'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Fixed Telephone </label>
                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="stelephone" name="stelephone" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['telephone'];?>">

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-11 control-label">Period of residence this address : </label>

                    </div>
                </div> </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Year :</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="sr_year" name="sr_year" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['r_year'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Month</label>
                        <div class="col-sm-3">

                            <input type="text" class="form-control" id="sr_month" name="sr_month" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['r_month'];?>">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-3">

                            <input type="text" class="form-control" id="sr_date" name="sr_date" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['r_date'];?>">

                        </div>
                    </div>
                </div>
            </div>	

        </div>
    </section>

    <section class="panel">
        <header class="panel-heading">
            Details of Parents/Guardian
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Name of father: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sn_father" name="sn_father" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['n_father'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Name of Mother:</label>
                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="sn_mother" name="sn_mother" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['n_mother'];?>">

                        </div>
                    </div></div>	
            </div><hr>

        </div>			
    </section>			


    <section class="panel">
        <header class="panel-heading">
            Contact Person
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Name of Parent/Guardian: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sn_parent" name="sn_parent" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['n_parent'];?>">
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Address of Parent/Guardian:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sp_address" name="sp_address" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['p_address'];?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Fixed Telephone Number  </label>
                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="stp_no" name="stp_no" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['tp_no'];?>">

                        </div>
                    </div>
                </div>
            </div>


            <hr>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Mobile No: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sm_no" name="sm_no" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['m_no'];?>">
                        </div>
                    </div>
                </div>
            </div>	
        </div> 
    </section>


    <section class="panel">
        <header class="panel-heading">
            Education Details
        </header>

        <header class="panel-heading">
            G.C.E.(A/L) August Results
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">

                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Year: </label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" id="se_year" name="se_year" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['e_year'];?>">
                                <option value="2">select</option>			
                                <option value="0">1 </option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="2">3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>	
            <hr>



            <div class="row">
                <div class="col-md-5">

                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Attempts: </label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" id="se_attems" name="se_attems" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['e_attems'];?>">
                                <option value="2">select</option>			
                                <option value="0">1 </option>
                                <option value="1">2</option>
                                <option value="2">3</option>



                            </select>
                        </div>

                    </div>
                </div>

            </div>	
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="clone_div" id="clone_div">
                        <div id="clonedInput1" class="clonedInput row">
                            <div class="col-md-5">


                                <div class="form-group">

                                    <label for="comcode" class="col-sm-5 control-label">Subject: </label>
                                    <div class="col-sm-7">
                                        <select type="text" class="form-control" id="se_subject" name="se_subject" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['e_subject'];?>">
                                            <option value="2">select</option>			
                                            <option value="2">select</option>			
                                            <option value="0">ECONOMICS </option>
                                            <option value="1">Sinhala</option>
                                            <option value="2">BUSINESS</option>
                                            <option value="3">ACCOUNTING</option>
                                            <option value="3">GEN.ENGLISH</option>




                                        </select>
                                    </div>

                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12">      
                                    <input type="hidden" id="course_id" name="course_id" value="<?php echo (isset($res) ? $res[""] : ''); ?>">
                                    <label for="comcode" class="col-md-2 control-label">grade : </label>
                                    <div class="col-md-3">
                                        <select type="text" class="form-control" id="se_grade" name="se_grade" placeholder=""   data-validation-optional="true" value="<?php echo $edit_stu[0]['e_grade'];?>">

                                            <option value="2">select</option>			
                                            <option value="0">A</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                            <option value="3">F</option>





                                        </select>


                                    </div>	

                                </div>



                                <span class="button-group">
                                    <button onclick="cloning(null, null)" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                    <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry"><span class="glyphicon glyphicon-minus"></span></button>
                                </span>
                            </div>		

                        </div></div></div>	</div>








            <hr>
            <br>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Medium: </label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" id="se_medium" name="se_medium" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['e_medium'];?>">
                                <option value="2">select</option>			
                                <option value="0">Sinhala</option>
                                <option value="1">Tamil</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>	
            <hr>

            <br>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Z-Score: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sz_score" name="sz_score" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['z_score'];?>">
                        </div>
                    </div>
                </div>

            </div>	

            <hr>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">School/Private Candidate: </label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" id="scandidate" name="scandidate" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['candidate'];?>">
                                <option value="2">select</option>			
                                <option value="0">School</option>
                                <option value="1">Private Candidate</option>
                            </select>


                        </div>
                    </div>
                </div>

            </div>	

            <hr>



            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="comcode" class="col-sm-5 control-label">Name of the School : </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="sschool" name="sschool" placeholder=""   data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo $edit_stu[0]['school'];?>">
                        </div>
                    </div>
                </div>

            </div>	

            <hr>






            <div class="form-group">
                <div class="col-md-offset-2 col-md-11">
                    <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                    <button onclick="event.preventDefault();$('#stu_form').trigger('reset');$('#stu_id').val('');" class="btn btn-default">Reset</button>
                </div>
            </div>					


            </form>
        </div>	

    </section>








    <script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>

    <script>

                                       save_method = 'update';
                                       $(function () {
                                           $('.viewregstudent').DataTable();
                                       });


    </script>


    <script type="text/javascript">

        $.validate({
            form: '#stu_form'
        });





        function edit_sub_load(id)
        {
            $(".temprw").each(function (index) {
                $(this).parents(".clonedInput").remove();
            });

            $('#ssubname').val('');
            $('#ssubname').attr('name', 'ssubname[]');
            $('#ssubid').val('');
            $('#ssubid').attr('name', 'ssubid[]');

            $.post("<?php echo base_url('hci_subject/edit_sub_load') ?>", {"sub_id": id},
                    function (data)
                    {
                        $('#sub_id').val(data['subject']['sub_id']);
                        $('#sub_name').val(data['subject']['sub_name']);
                        $('#sub_curriculum').val(data['subject']['sub_curriculum']);
                        $('#sub_section').val(data['subject']['sub_section']);
                        $('#sub_type').val(data['subject']['sub_type']);

                        for (i = 0; i < data['subsubjects'].length; i++)
                        {
                            if (i == 0)
                            {
                                $('#ssubname').val(data['subsubjects'][i]['ssub_name']);
                                $('#ssubname').attr('name', 'ssubname_' + data['subsubjects'][i]['ssub_id']);

                                $('#ssubid').val(data['subsubjects'][i]['ssub_id']);
                                $('#ssubid').attr('name', 'ssubid[' + data['subsubjects'][i]['ssub_id'] + ']');
                            } else
                            {
                                cloning(data['subsubjects'][i]['ssub_id'], data['subsubjects'][i]['ssub_name']);
                            }
                        }

                        load_schemelist(data['subject']['sub_section'], data['schemes']);
                    },
                    "json"
                    );
        }

        var cloneid = 0;

        function cloning(ssubid, ssubname)
        {
            cloneid += 1;
            //alert(cloneid);
            var container = document.getElementById('clone_div');
            var clone = $('#clonedInput1').clone();

            clone.find('#ssubid').attr("class", "form-control temprw");
            if (ssubid != null)
            {
                clone.find('#ssubid').val(ssubid);
                clone.find('#ssubid').attr('name', 'ssubid[' + ssubid + ']');
                clone.find('#ssubid').removeAttr("id");
            } else
            {
                clone.find('#ssubid').val('');
                clone.find('#ssubid').attr('name', 'ssubidnew[]');
                clone.find('#ssubid').removeAttr("id");
            }

            if (ssubname != null)
            {
                clone.find('#ssubname').val(ssubname);
                clone.find('#ssubname').attr('name', 'ssubname_' + ssubid);
                clone.find('#ssubname').removeAttr("id");
            } else
            {
                clone.find('#ssubname').val('');
                clone.find('#ssubname').attr('name', 'ssubname[]');
                clone.find('#ssubname').removeAttr("id");
            }

            clone.find('.remove_entry').attr('id', cloneid);
            clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();Calculate_gr_tot()');

            $('.clone_div').append(clone);
        }



    </script>











