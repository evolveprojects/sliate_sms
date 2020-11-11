
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Student View</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Subject</li>
            <li><i class="fa fa-bank"></i>Subject Lookup</li>
        </ol>
    </div>
</div>
<div>
    <div class="row">
        <div class="col-md-12">
		
            <section class="panel">
                <header class="panel-heading">
                 Subject View
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
									        
<!--                                 <th>Image</th> -->
                              
                                <tr><th>Year:</th><td> <?php echo   $res['year']; ?></td></tr>
                                <tr><th>Sem:</th><td><?php echo  $res['sem'];?></td></tr> 
                               <tr><th>Module code:</th><td> <?php echo  $res['module'];?></td></tr> 
                               <tr><th>Title:</th><td> <?php echo   $res['title']; ?></td></tr>
                                <tr><th>Credits:</th><td><?php echo  $res['credit'];?></td></tr> 
                             
									         
                                    </tbody>
                                </table>
                           </div>
            </section>
        </div>
    </div>
</div>
                       
								 							 
									
									
									
                                            
                                                    
                                          
                                                   
                                                       
                                       
                                                      
                                    
                                  