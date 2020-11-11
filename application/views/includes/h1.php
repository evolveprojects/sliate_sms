<!DOCTYPE html>
<html lang="en-US">
<?php
	if (!isset($this->session->userdata['u_id'])) 
	{
		redirect('login');
	} 
?>
<head>
	<meta charset="utf-8">    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--  <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico')?>"> --><!-- fav ico -->
	<title><?php echo "AS :: ".$title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/as_style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 

	<script type="text/javascript" src="<?php echo base_url('js/jquery-2.1.1.min.js')?>"></script><!--jquery-->
	<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>

	<style type="text/css">
	    	@charset "UTF-8";
			/* Base Styles */
			.as_nav
			{
				border-top: 5px solid #3fa338;
			  /*font-family: Calibri, Tahoma, Arial, sans-serif;*/
			  font-size: 12px;
			  background: #1e1e1e;
			  background: -moz-linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #1e1e1e), color-stop(100%, #040404));
			  background: -webkit-linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  background: linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  width: auto;
			  zoom: 1;
			}
			#as_nav > ul,
			#as_nav > ul li,
			#as_nav > ul ul {
			  list-style: none;
			  margin: 0;
			  padding: 0;
			}
			#as_nav > ul {
			  position: relative;
			  z-index: 597;
			}
			#as_nav > ul li {
			  float: left;
			  min-height: 100%;
			  line-height: 1.3em;
			  vertical-align: middle;
			}
			#as_nav > ul li.hover,
			#as_nav > ul li:hover {
			  position: relative;
			  z-index: 599;
			  cursor: default;
			}
			#as_nav > ul ul {
			  visibility: hidden;
			  position: absolute;
			  top: 100%;
			  left: 0;
			  z-index: 598;
			  width: 100%;
			}
			#as_nav > ul ul li {
			  float: none;
			}
			#as_nav > ul ul ul {
			  top: 1px;
			  left: 99%;
			}
			#as_nav > ul li:hover > ul {
			  visibility: visible;
			}
			/* Align last drop down RTL */
			#as_nav > ul > li.last ul ul {
			  left: auto !important;
			  right: 99%;
			}
			#as_nav > ul > li.last ul {
			  left: auto;
			  right: 0;
			}
			#as_nav > ul > li.last {
			  text-align: right;
			}
			/* Theme Styles */
			#as_nav > ul {
			  /*border-top: 4px solid #3fa338;*/
			  /*font-family: Calibri, Tahoma, Arial, sans-serif;*/
			  font-size: 12px;
			  background: #1e1e1e;
			  background: -moz-linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #1e1e1e), color-stop(100%, #040404));
			  background: -webkit-linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  background: linear-gradient(top, #1e1e1e 0%, #040404 100%);
			  width: auto;
			  zoom: 1;
			}
			#as_nav > ul:before {
			  content: '';
			  display: block;
			}
			#as_nav > ul:after {
			  content: '';
			  display: table;
			  clear: both;
			}
			#as_nav > ul li a {
			  display: inline-block;
			  padding: 10px 22px;
			}
			#as_nav > ul > li.active,
			#as_nav > ul > li.active:hover {
			  background-color: #3fa338;
			}
			#as_nav > ul > li > a:link,
			#as_nav > ul > li > a:active,
			#as_nav > ul > li > a:visited {
			  color: #ffffff;
			}
			#as_nav > ul > li > a:hover {
			  color: #ffffff;
			}
			#as_nav > ul ul ul {
			  top: 0;
			}
			#as_nav > ul li li {
			  background-color: #ffffff;
			  border-bottom: 1px solid #ebebeb;
			  font-size: 12px;
			}
			#as_nav > ul li.hover,
			#as_nav > ul li:hover {
			  background-color: #F5F5F5;
			}
			#as_nav > ul > li.hover,
			#as_nav > ul > li:hover {
			  background-color: #3fa338;
			  -webkit-box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.15);
			  -moz-box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.15);
			  box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.15);
			}
			#as_nav > ul a:link,
			#as_nav > ul a:visited {
			  color: #9a9a9a;
			  text-decoration: none;
			}
			#as_nav > ul a:hover {
			  color: #9a9a9a;
			}
			#as_nav > ul a:active {
			  color: #9a9a9a;
			}
			#as_nav > ul ul {
			  border: 1px solid #CCC \9;
			  -webkit-box-shadow: 0 0px 2px 1px rgba(0, 0, 0, 0.15);
			  -moz-box-shadow: 0 0px 2px 1px rgba(0, 0, 0, 0.15);
			  box-shadow: 0 0px 2px 1px rgba(0, 0, 0, 0.15);
			  width: 150px;
			}

			.pc_close {
			  float: right;
			  font-size: 21px;
			  font-weight: bold;
			  line-height: 1;
			  color: #000;
			  text-shadow: 0 1px 0 #fff;
			  filter: alpha(opacity=20);
			  opacity: .2;
			}
			.pc_close:hover,
			.pc_close:focus {
			  color: #000;
			  text-decoration: none;
			  cursor: pointer;
			  filter: alpha(opacity=50);
			  opacity: .5;
			}
			button.pc_close {
			  -webkit-appearance: none;
			  padding: 0;
			  cursor: pointer;
			  background: transparent;
			  border: 0;
			}
	    </style>
</head>
<body style="background-image: url('<?php echo base_url('img/bg7.png')?>');">

<!-- nav bar-->
		<nav class="as_nav" role="navigation" style="padding:0px 25px 0px 25px;z-index: 1;position: fixed !important;top:0;width:100%;">
			<div class="row">
				<div class="col-md-2" style="padding:5px 0px 5px 0px"><img class="img-rounded" height="60" width="140" src="<?php echo base_url('img/sys-logo.png')?>" alt="LOgo"></div><!-- logo-->
				<div class="col-md-8">
					<div id='as_nav'>
						<ul  style="height:70px">
							<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/conf_icon.png')?>"><br><span>Configurations</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('location')?>'><span>Location</span></a></li>
						   			<li><a href='<?php echo base_url('metric_system')?>'><span>Metric System</span></a></li>
						   			<li><a href='<?php echo base_url('item_trans_unit')?>'><span>Item Transaction Unit</span></a></li>
						      	</ul>
						   	</li>
						   	<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/raw-mat-icon.png')?>"><br><span>Raw Materials</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('raw_material')?>'><span>Manage Raw Materials</span></a></li>
						   			<li><a href='<?php echo base_url('raw_material/items_manage_view')?>'><span>Items</span></a></li>
						      	</ul>
						   	</li>
						   	<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/inventory-icon.png')?>"><br><span>Inventory</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('supplier')?>'><span>Supplier</span></a></li>
						   			<li><a href='<?php echo base_url('grn')?>'><span>GRN</span></a></li>
						   			<li><a href='<?php echo base_url('grn/grn_approval')?>'><span>GRN Approval</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/stock_transfer')?>'><span>Stock Transfer</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/stock_tran_approval')?>'><span>Stock Transfer Approval</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/stock_rec_confirmation')?>'><span>Stock Received Confirmation</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/stock_adjustment')?>'><span>Stock Adjustment</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/stock_adjustment_lookup')?>'><span>Stock Adjustment Lookup</span></a></li>
						   			<li><a href='<?php echo base_url('raw_inventory/inventory_management')?>'><span>Inventory</span></a></li>
						      	</ul>
						   	</li>
						   	<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/design-icon.png')?>"><br><span>Garment Design</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('piece')?>'><span>Garment Piece</span></a></li>
						   			<li><a href='<?php echo base_url('task')?>'><span>Garment Task</span></a></li>
						   			<li><a href='<?php echo base_url('size')?>'><span>Design Size</span></a></li>
						   			<li><a href='<?php echo base_url('garment_design')?>'><span>Manage Garment Design</span></a></li>
						      	</ul>
						   	</li>
						   	<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/manf.jpg')?>"><br><span>Manufacturing</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('manufacturing')?>'><span>Production Session</span></a></li>
						   			<li><a href='<?php echo base_url('manufacturing/production_session_list')?>'><span>Production Session Config</span></a></li>
						   			<li><a href='<?php echo base_url('manufacturing/production_update_view')?>'><span>Production Update</span></a></li>
						      	</ul>
						   	</li>
						   	<li style="text-align:center">
						   		<a href='#'><img class="img-rounded" height="40" width="40" src="<?php echo base_url('img/users-icon.png')?>"><br><span>HR</span></a>
						   		<ul><!-- sub menu -->
						   			<li><a href='<?php echo base_url('designation')?>'><span>Designation</span></a></li>
						   			<li><a href='<?php echo base_url('employee')?>'><span>Employee</span></a></li>
						      	</ul>
						   	</li>
						</ul>
					</div>
				</div>
				<div class="col-md-2" style="padding:5px 0px 5px 0px">
					<div class="col-md-4"></div>
					<?php
						if(isset($this->session->userdata['u_id']))
						{
					?>
							<div class="col-md-2" style='color:white;font-size:12px'><?php echo $this->session->userdata['u_name'];?></div>
					<?php
						}
					?>
					<div class="col-md-4"></div>
					<!-- <div class="col-2"><br><a style="color: #E0E0E0;" href="#"><span class="glyphicon glyphicon-envelope glyphicon-white"></span> <span class="badge">42</span></a></div>
					<div class="col-2"><br><a style="color: #E0E0E0;" href="#"><span class="glyphicon glyphicon-bell glyphicon-white"></span> <span class="badge">42</span></a></div>		 -->
					<div class="col-md-2"><a style="color: #E0E0E0;" href='<?php echo base_url('login/logout')?>'><span class="glyphicon glyphicon-off glyphicon-white"></span>Logout</a></div>
				</div>
			</div>
		</nav>
		<!-- feedback alert-->
		<?php
			// if(isset($_SESSION["msg_type"]))
			// {
			// 	if($_SESSION["msg_type"]=="Success")
			// 	{
		?>
					<!-- <div id = "notif_alerts" style="position: fixed;right: 7px;width: 400px;" Class="kalert-success">Data Saved Sucessfully</div> -->
		<?php
				// }
				// else if($_SESSION["msg_type"]=="Failure")
				// {
		?>
					<!-- <div id = "notif_alerts" style="position: fixed;right: 7px;width: 400px;" Class="kalert-failure"><?php echo $_SESSION['msg']?></div> -->
		<?php
			// 	}

			// 	$_SESSION["msg_type"]='';
			// 	$_SESSION["msg"]='';
			// } 
		?>
		<div id = "js_notif_alerts" style="position: fixed;right: 7px;width: 400px;z-index: 1000;" >
			<?php if($this->session->flashdata('flashSuccess')){?>
				<div id="notif_alerts" class="alert alert-success" role="alert">  
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flashSuccess'); ?>
				</div>
			<?php } ?>

			<?php if($this->session->flashdata('flashError')){?>
				<div id="notif_alerts" class="alert alert-danger" role="alert">  
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flashError'); ?>
				</div>
			<?php } ?>

			<?php if($this->session->flashdata('flashInfo')){?>
				<div id="notif_alerts" class="alert alert-info" role="alert">  
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flashInfo'); ?>
				</div>
			<?php } ?>

			<?php if($this->session->flashdata('flashWarning')){?>
				<div id="notif_alerts" class="alert alert-warning" role="alert">  
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flashWarning'); ?>
				</div>
			<?php } ?>
		</div>
		<!-- feedback alert-end -->