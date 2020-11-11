<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Personal Details</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   <table id="stuTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                    <thead>
									</thead>
                                  <tbody>	
									         <tr>                  
                                        <th>#: </th><td><?php echo $res['stu_id']; ?></td></tr>
<!--                                 <th>Image</th> -->
                              
                                <tr><th>Name of Applicant:</th><td> <?php echo   $res['name']; ?></td></tr>
                                <tr><th>Applicant's Full Name:</th><td><?php echo  $res['full_name'];?></td></tr> 
                               <tr><th>Civil Status:</th><td> <?php echo  $res['civil_status'];?></td></tr> 
                               <tr> <th>Sex:</th><td> <?php echo  $res['sex'];?></tr>
							   <tr> <th>Date of Birth:</th><td> <?php echo  $res['birth'];?></td></tr> 
							    <tr><th>Place of Birth:</th><td> <?php echo  $res['place_birth'];?></td></tr> 
                                                        
							     <tr><th>Mobile Number:</th><td><?php echo  $res['mobile_no'];?></td></tr> 
							    <tr> <th>E-mail:</th><td><?php echo  $res['email'];?></td></tr> 
								 <tr><th>NIC No:</th><td><?php echo  $res['nic_no'];?></td></tr>  
								  <tr><th>NIC Issues Date:</th><td><?php echo  $res['nic_date'];?></td></tr>  
								  <tr><th>A/L 2015 Index Number:</th><td><?php  echo  $res['index_no'];?></td></tr> 
								  <tr><th>2015 A/L Used ID Type:</th><td><?php echo  $res['id_type'];?></td></tr> 
								 <tr> <th>2015 A/L UsedID No:</th><td><?php echo  $res['id_no'];?></td></tr> 
								  <tr><th>Citizen by descent:</th><td><?php echo  $res['citizen'];?></td></tr> 
								  <tr><th>Race:</th><td><?php echo  $res['race'];?></td></tr> 
								 <tr> <th>Religion:</th><td><?php echo  $res['religion'];?></td></tr>  
								  <tr><th>If not,State Citizenship:</th><td><?php echo  $res['citizenship'];?></td></tr> 
								  <tr><th>If clergy,indicate the full name used prior to ordination:</th><td><?php  echo  $res['ordination'];?></td></tr>  
								  <tr><th>District :</th><td><?php  echo  $res['distric'];?></td></tr> 
								  <tr><th>District No:</th><td><?php echo $res['distric_no'];?></td></tr> 
								 <tr> <th>Permanent Address of Residence:</th><td><?php echo   $res['address_resi']; ?></td></tr>  


								 <tr> <th>Adminis trative District:</th><td><?php echo    $res['distric_admi']; ?></td></tr> 
								 <tr> <th>District No::</th><td><?php echo    $res['distri_no']; ?></td></tr> 
								  <tr> <th>Fixed Telephone:</th><td><?php  echo  $res['tele'];?></td></tr> 
								 <tr><th>Year :</th><td><?php  echo  $res['year'];?></td></tr>  
								 <tr> <th>Month:</th><td><?php echo    $res['month']; ?></td></tr>  
                                                   
								  <tr><th>Date:</th><td><?php echo    $res['date'];?></td></tr>  
								  </tbody>
								  </table>
    </div>
  </div>
</div>

<!-- Small modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Parent Details</button>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
	 <table id="stuTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                    <thead>
									</thead>
                                  <tbody>	
                                    <tr><th>Name of father:</th><td><?php echo   $res['name_fath'];?></td></tr>  
								   <th>Name of Mother:</th><td><?php echo    $res['name_moth'];?></td></tr> 
								 <tr> <th>Name of Guardian:</th><td><?php echo   $res['name_guar'];?></td></tr> 
								 </tbody>
								 </table>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sn">Course Information</button>

<div class="modal fade bs-example-modal-sn" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sn" role="document">
    <div class="modal-content">
	<table id="stuTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                    <thead>
									</thead>
                                  <tbody>
								  
                                 <tr><th>Name of Institution:</th><td><?php echo    $res['name_inst'];?></td></tr> 
								  <tr> <th>Course of Study:</th><td><?php echo    $res['course_study'];?></td></tr> 
								   <tr><th>Year of registration:</th><td> <?php  echo    $res['year_regi'];?></td></tr> 
								   <tr><th>Duration of the Course</th><td><?php  echo    $res['duration'];?></td></tr> 
                                   <tr><th>Full Time or Part Time:</th><td><?php echo   $res['fp_time']; ?></td></tr> 
                                                   
								   <tr><th>Registration No:</th><td><?php echo  $res['reg_no'];?> </td></tr> 
								    </tbody>
								 </table>
								 
    </div>
  </div>
</div>