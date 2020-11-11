
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Student View</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-bank"></i>Batch Lookup</li>
        </ol>
    </div>
</div>
<div>
    <div class="row">
        <div class="col-md-12">
		
            <section class="panel">
                <header class="panel-heading">
                  Batch View
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
                                        <th>#: </th><td><?php echo $res['b_id']; ?></td></tr>
<!--                                 <th>Image</th> -->
                              
                                <tr><th>Batch Name:</th><td> <?php echo   $res['bname']; ?></td></tr>
                                <tr><th>Batch:</th><td><?php echo  $res['batch'];?></td></tr> 
                               <tr><th>Batch Information:</th><td> <?php echo  $res['b_intro'];?></td></tr> 
                               
									         
                                    </tbody>
                                </table>
                           </div>
            </section>
        </div>
    </div>
</div>
                       
								 							 
									
									
									
                                            
                                                    
                                          
                                                   
                                                       
                                       
                                                      
                                    
                                  