<div class="row">
	<div class="col-md-12">
		<h3 class="page-header"><i class="glyphicon glyphicon-open"></i>System DataBase Backup</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
			<li><i class="fa fa-cog"></i>System Access</li>
			<li><i class="fa fa-user"></i>System DB Backup</li>
		</ol>
	</div>
</div>



<div class="row">
    <div class="container">
        <form class="form-horizontal" role="form" method="post"  id="reg_form" action=""  autocomplete="on" novalidate enctype="multipart/form-data">
            <section class="panel affixpanel" id="generaldata">
                <header class="panel-heading">
                    System Backup
                </header>
                
                <div class="container">
                    <h4>Download Backup</h4>
                </div>
                <div class="container">
                    <div class="row">
                        <br>
                        <div class="col-sm-2">
                            <img src="<?php echo base_url('img/backup-solutecsa.png') ?>" style="height: 100px; width: 100px;"class="img-responsive">
                        </div>
<!--                        <div class="col-sm-2">
                            <div class="row"><label>Last downloaded Date</label></div>
                            <div class="row"><label>Last downloaded Time</label></div>
                            <div class="row"><label>Last downloaded User</label></div>
                        </div>
                        <div class="col-sm-1">
                            <div class="row "><label>:</label></div>
                            <div class="row "><label>:</label></div>
                            <div class="row "><label>:</label></div>
                        </div>-->
<!--                        <div class="col-sm-3">
                            <div class="row"><label>06/28/2018</label></div>
                            <div class="row"><label>5:01 PM</label></div>
                            <div class="row"><label>Hello</label></div>
                        </div>-->
                    </div>
                    
                </div>
                
                
                <div class="row container">
                    <br>
                    <div class="row container align-center">
                        <div class="col-sm-2" <!--style="background-color: red;" -->
                        </div>
                        <div class="col-sm" >
                            <a class="btn btn-primary red-tooltip" href="<?php echo base_url().'util/dbbackup'?>"  type="button" data-toggle="tooltip" data-placement="top" title="Download Backup File"><span class="glyphicon glyphicon-save"></span><b>  Download</b></a></div>
                        </div>
                </div>
           <br>
            </section>
        </form>
    </div>
</div>

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>




