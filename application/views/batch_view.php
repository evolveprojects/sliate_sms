<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> ADMISSION FORM</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Batch</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="company_tab">
        <br>
        <div class="row">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="<?php echo base_url('batch/batch_view') ?>" method="post"  id="reg_form" autocomplete="off" novalidate>		
                            <div class="form-group">
                                <input type="hidden" id="b_id" name="b_id" value="<?php //echo (isset($res) ? $res["b_id"] : '');   ?>">
                                <label for="comcode" class="col-md-2 control-label">Batch Name : </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="sbname" name="sbname" placeholder=""   data-validation-optional="true" value="<?php echo (isset($res) ? $res["bname"] : ''); ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Batch:</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="sbatch" name="sbatch" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["batch"] : ''); ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="sbatch" name="sbatch" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["batch"] : ''); ?>">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="comcode" class="col-sm-2 control-label"> Batch Introduction:</label>
                                <div class="col-md-8">
                                    <input type="text" height="70"  class="form-control" id="sb_intro" name="sb_intro" placeholder=""  data-validation="required" data-validation-error-msg-required="Field can not be empty" value="<?php echo (isset($res) ? $res["b_intro"] : ''); ?>">
                                </div>
                            </div>
                            <br>   <br>   <br>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-11">
                                    <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>

                                    <button type="reset" name="Reset" class="btn btn-default">Reset</button>
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
                                    <th>#</th>
<!--                                 <th>Image</th> -->
                                    <th>Batch name</th>
                                    <th>Batch</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dgr = $this->db->get('batch')->result_array();
                                foreach ($dgr as $va) {
                                    ?>
                                    <tr>
                                        <td><?php echo $va['b_id']; ?></td>
                                        <td><?php echo $va['bname']; ?></td>
                                        <td><?php echo $va['batch']; ?></td>
                                        <td><a href="<?php echo base_url(); ?>Hci_student/save_batch/<?php echo $va['b_id'] ?>"
                                               class=" btn btn-success "> View</a> 
                                            <a href="<?php echo base_url(); ?>Hci_student/bat_info/<?php echo $va['b_id'] ?>"
                                               class=" btn btn-success "> Edit </a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>		
        </div>
    </div>
</div>











