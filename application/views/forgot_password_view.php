<!DOCTYPE html>
<html lang="en">
<style>

    
.title-fp{
    color: #1c7ea8 !important;
    /*font-size: 14px;*/
    font-weight: bold;
    padding: 12px;
}


</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
	
    <link rel="shortcut icon" href="<?php echo base_url('img/sliate_logo.jpg') ?>"><!-- fav ico -->
    <title><?php echo "SLIATE SMS :: ".$title;?></title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url('css/bootstrap-theme.css')?>" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url('css/elegant-icons-style.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/font-awesome.css')?>" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style-responsive.css')?>" rel="stylesheet" />
    <style>
            .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {background: #fff !important; color:#0c6388;}
    </style>
</head>
<body class="login-img3-body">
<nav class="navbar navbar-light" style="background-color: #0c6388; margin-bottom: -120px;; height: 150px; border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-nav">
	<img src="<?php echo base_url('img/sliate_login.png') ?>" style="padding-left: 230px; padding-top: 10px;">
    </ul>
  </div>
</nav>
    <div class="container">
        <form class="login-form" autocomplete="off" action="<?php echo base_url('login/forget_password_submit')?>" method="post" id = "login_form" name = "login_form">        
            <h4 class="title-fp">Enter the Username or Email. (If you have registered an Email)</h4>
            <div class="login-wrap">
                <?php if(isset($_GET['submit'])){ 
                    if($_GET['submit']=='sent') { ?>
                        
                <div class="alert alert-success fade in" role="alert">  
                    Successfully Notified Admin.
                </div>
                
                <?php }
                if($_GET['submit']=='fail') { ?>
                    <div class="alert alert-danger fade in" role="alert">  
                        Failed Notified Admin.
                    </div>
                <?php } ?>
                <?php if($_GET['submit']=='invalid_user') { ?>
                        <div class="alert alert-danger fade in" role="alert">  
                            Invalid Username. Try again
                        </div>
                <?php } ?>
                <?php if($_GET['submit']=='no_reg') { ?>
                        <div class="alert alert-danger fade in" role="alert">  
                            No email registered. Try again
                        </div>
                <?php } ?>
                <?php if($_GET['submit']=='invalid_mail') { ?>
                        <div class="alert alert-danger fade in" role="alert">  
                            Invalid email. Try again
                        </div>
                <?php } ?>
                <?php } ?>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" placeholder="Username" autofocus id="username" name="username">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_mail"></i></span>
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #0c6388; border-color: #0c6388;">Notify Admin</button>                
            </div>
        </form>
        <div class="text-right">
            
        </div>
    </div>
</body>
</html>
