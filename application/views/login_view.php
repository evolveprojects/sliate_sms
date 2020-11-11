<!DOCTYPE html>
<html lang="en">
<style>
.online-reg{
    color: #0cda2f !important;
    font-size: 18px;
    font-weight: bold;
}

.online-reg:hover {
  color: #0cda2f8a !important
}
.fogot-password{
    color: #1c7ea8 !important;
    font-size: 15px;
    font-weight: bold;
}
.fogot-password:hover {
    color: #43a8d3 !important;
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
		.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {background: #fff !important; color:#0c6388;}
	</style>
</head>
<body class="login-img3-body">
<nav class="navbar navbar-light" style="background-color: #0c6388; margin-bottom: -120px;; height: 150px; border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <!--<a class="navbar-brand" href="#">WebSiteName</a>-->
    </div>
    <ul class="nav navbar-nav">
	<img src="<?php echo base_url('img/sliate_login.png') ?>" style="padding-left: 230px; padding-top: 10px;">
      <!--<li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>-->
    </ul>
  </div>
</nav>
    <div class="container">
        <form class="login-form" autocomplete="off" action="<?php echo base_url('login/loginSubmit')?>" method="post" id = "login_form" name = "login_form">        
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt" style="color: #0c6388;"></i></p>
                <?php
                    if(isset($_GET['login']))
                    {
                        echo '<br><div class="row">';
                        if($_GET['login']=='logout')
                        {
                ?>
                            <div class="alert alert-success fade in" role="alert">  
                                Successfully Logout
                            </div>
                <?php
                        }

                        if($_GET['login']=='invalid')
                        {
                ?>
                            <div class="alert alert-danger fade in" role="alert">  
                                Invalid Login. Try again
                            </div>
                <?php
                        }
                        
                        if($_GET['login']=='sent'){ ?>
                            <div class="alert alert-success fade in" role="alert">  
                                Successfully Notified Admin.
                            </div>
                       <?php }
                        echo '</div>';
                    } 
                ?>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" placeholder="Username" autofocus id="username" name="username">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                </div>
                <!-- <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
                </label> -->
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #0c6388; border-color: #0c6388;">Login</button>
                 <div style="text-align: center;">
                    <br/><a class="fogot-password" href="<?php echo base_url('login/forgot_password') ?>">Forgot Password?</a>
                </div>
                <?php if($online_reg_flag == true){?>
                <div style="text-align: center;">
                    <br/><a class="online-reg" href="<?php echo base_url('student/online_registration') ?>">Online Registration</a>
                </div>
                <?php }?>
                
            </div>
        </form>
        <div class="text-right">
            <div class="credits">
                <!-- 
                    All the links in the footer should remain intact. 
                    You can delete the links only if you purchased the pro version.
                    Licensing information: https://bootstrapmade.com/license/
                    Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
                -->
            </div>
        </div>
    </div>
</body>
</html>
