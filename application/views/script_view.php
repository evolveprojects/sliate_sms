<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<style>
    /* Center the loader */
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
    }

    #myDiv {
        display: none;
        text-align: center;
    }
</style>
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Script View </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Script View</li>

        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Change Course Code
            </header>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="center" class="col-md-4 control-label">Center</label>
                                        <div class="col-md-7">
                                            <?php
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange=""';
                                            echo form_dropdown('prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="panel-footer">
                        <button type="submit" disabled="true" class="btn btn-info" onclick="run()">Update Student Register Code</button>
                        <button type="submit" disabled="true" class="btn btn-info" onclick="run_user()">Update User Register</button>
                        <br><br><button type="submit" class="btn btn-info" onclick="update_need_index()">Update need index for wrong DB Entry</button>
                        
                        <br><br><button type="submit" class="btn btn-info" onclick="check_duplicate_images()">Check Duplicate Images</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <br><br>
                        <label id="msg"></label>
                    </div>


                </div>
        </section>
        <p>Page rendered in {elapsed_time} seconds.
    </div>

</div>

<div id="loader" ></div>

<!--<div style="display:none;" id="myDiv" class="animate-bottom">
    <h2>Tada!</h2>
    <p>Some text in my newly loaded page..</p>
</div>-->
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">


                            $(document).ready(function () {
                                $('#loader').hide();
                            });

                            function run() {
                                // myVar = setTimeout(showPage, 3000);
                                $('#loader').show();
                                var center_id = $('#prom_centre').val();
                                //alert('run'+center_id);
                                $.post("<?php echo base_url('script/run_change_course_code') ?>", {'center_id': center_id},
                                        function (data)
                                        {
                                            console.log(data);
                                            if (data){
                                                alert("Success");
                                            showPage();}
                                           else
                                                alert("Fail");
                                        },
                                        "json"
                                        );
                            }

                            function run_user() {
                            $('#loader').show();
                                var center_id = $('#prom_centre').val();
                                //alert('run'+center_id);
                                $.post("<?php echo base_url('script/run_user_course_code') ?>", {'center_id': center_id},
                                        function (data)
                                        {
                                            console.log(data);
                                            if (data)
                                              {
                                                alert("Success");
                                            showPage();}
                                            else
                                                alert("Fail");
                                        },
                                        "json"
                                        );
                            }
                            function showPage() {
                                document.getElementById("loader").style.display = "none";
                               // document.getElementById("myDiv").style.display = "block";
                            }
                            
                            
                            function update_need_index() {
                            $('#loader').show();
                                var center_id = $('#prom_centre').val();
                                //alert('run'+center_id);
                                $.post("<?php echo base_url('script/update_need_index') ?>", {'center_id': center_id},
                                        function (data)
                                        {
                                            console.log(data);
                                            if (data)
                                              {
                                                alert("Success");
                                            showPage();}
                                            else
                                                alert("Fail");
                                        },
                                        "json"
                                        );
                            }
                            function showPage() {
                                document.getElementById("loader").style.display = "none";
                               // document.getElementById("myDiv").style.display = "block";
                            }
                            
                            function check_duplicate_images()
                            {
                                $('#loader').show();
                                $.post("<?php echo base_url('script/check_duplicate_images') ?>", {},
                                        function (data)
                                        {
                                            console.log(data);
                                            if (data)
                                              {
                                                $('#loader').text(data);
                                            showPage();}
                                            else
                                                alert("Fail");
                                        },
                                        "json"
                                        );
                                
                                showPage();
                            }


</script>