
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Semester View</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-bank"></i>Semester Lookup</li>
        </ol>
    </div>
</div>
<div>
    <div class="row">
        <div class="col-md-12">
		
            <section class="panel">
                <header class="panel-heading">
                   Semester View
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                           
                            <input type="hidden" name="type_temp" id="type_temp" value="r">
                        </div>
                    </div>
                    <table id="stuTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:40%" cellspacing="0">
                                    <thead>
									</thead>
                                  <tbody>	
									         <tr>                  
                                        <th>#: </th><td><?php echo $res['s_id']; ?></td></tr>
<!--                                 <th>Image</th> -->
                              
                                <tr><th>Semester Code:</th><td> <?php echo   $res['s_code']; ?></td></tr>
                                <tr><th>Period:</th><td><?php echo  $res['s_period'];?></td></tr> 
                               <tr><th>Name:</th><td> <?php echo  $res['s_name'];?></td></tr> 
                               
									         
                                    </tbody>
                                </table>
                           </div>
            </section>
        </div>
    </div>
</div>
                       
								 							 
									
									
									
                                            
                                                    
                                          
                                                   
                                                       
                                       
                                                      
                                    
                                  