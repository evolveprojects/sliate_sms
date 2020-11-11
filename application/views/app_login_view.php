<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.2/tailwind.min.css">
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/vendors/css/animate.css') ?>">
        <style>
            .wrap:before{
                content:"";
                position: absolute;
                top:0;
                left:0;
                height:100%;
                width:100%;
                background: rgba(66,153,225,0.5);
                z-index:999;
            }
        </style>


        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/jquery/jquery.min.js') ?>" ></script>
        <script src="<?php echo base_url('new_assets/assets/vendors/css/bootstrap-notify-master/bootstrap-notify.min.js') ?>"></script>

        <title>Hello, world!</title>
    </head>
    <body>
        <section class="flex flex-col md:flex-row h-screen items-center">

            <div style="position:relative;" class="bg-blue-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen wrap">
                <img style="" src="<?php echo base_url('img/IMG_5113.jpg') ?>" alt="" class="w-full h-full object-cover">
            </div>

            <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
                 flex items-center justify-center">

                <div class="w-full h-100">
                    <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>

                    <form class="mt-6" action="<?php echo base_url('App/loginSubmit') ?>" method="post" id="login_form" name="login_form">
                        <?php
                        if (isset($_GET['login'])) {
                            echo '<br><div class="row">';
                            if ($_GET['login'] == 'logout') {
                                ?>
                                <div id="logout_submit" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Holy smokes!</strong>
                                    <span class="block sm:inline">Successfully Logged Out</span>
        <!--                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                    </span>-->
                                </div>
                                <?php
                            }

                            if ($_GET['login'] == 'invalid') {
                                ?>
                                <div id="invalid_submit" class="fadeOut  bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Holy smokes!</strong>
                                    <span class="block sm:inline">Invalid Login Credentials</span>
        <!--                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                    </span>-->
                                </div>
                                <?php
                            }

                            if ($_GET['login'] == 'sent') {
                                ?>
                                <div class="alert alert-success fade in" role="alert">  
                                    Successfully Notified Admin.
                                </div>
                                <?php
                            }
                            echo '</div>';
                        }
                        ?>
                        <br>
                        <div>
                            <label class="block text-gray-700">Email Address</label>
                            <input type="text" name="username" id="username" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                                   focus:bg-white focus:outline-none" required>
                        </div>

                        <div class="text-right mt-2">
                            <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
                        </div>

                        <button type="submit" class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
                                px-4 py-3 mt-6">Log In</button>
                    </form>

                    <hr class="my-6 border-gray-300 w-full">

<!--                    <p class="mt-8">Need an account? <a href="#" class="text-blue-500 hover:text-blue-700 font-semibold">Create an
                            account</a></p>-->


                </div>
            </div>

        </section>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
    </body>
</html>
<script>
    $('#invalid_submit').delay(500).fadeOut(5000);
    $('#logout_submit').delay(500).fadeOut(5000);
</script>