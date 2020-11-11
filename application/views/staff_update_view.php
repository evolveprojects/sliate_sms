<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-users"></i>Update Staff</li>
        </ol>
    </div>
</div>
<div class="panel">
    <header class="panel-heading">
        Update Staff
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('staff/save_staff'); ?>" id="stf_reg" enctype="multipart/form-data" autocomplete="off" novalidate>
                    <div class="form-group col-md-12">
                        <label for="staffprof_pic" class="col-md-2 control-label">Profile Picture:</label>
                        <div class="col-md-4">
                            <input id="staffprof_pic" name="staffprof_pic" type="file" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="stf_id" id="stf_id" value="<?php echo $edit_stf['stf_id']; ?>">
                        <div class="col-md-5">
                            <label for="tit_name"></label>
                            <table id="staff_look" style="width:100%" cellspacing="0">
                                <tr>
                                    <td width="28%"></td>
                                    <td width="15%">Title :</td> 
                                    <?php foreach ($title_new as $row) { ?><td>
                                            <?php if ($row['id'] == $edit_stf['tit_name']) { ?>
                                                <input type="radio" name="tit_name" checked value="<?php echo $row['id'] ?>"> <?php echo $row['title_name'] ?>
                                            <?php } else { ?>
                                                <input type="radio" name="tit_name" value="<?php echo $row['id'] ?>"> <?php echo $row['title_name'] ?>
                                            <?php } ?>
                                        </td>
                                    <?php }
                                    ?>

                                </tr>          
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name" class="col-md-2 control-label">Employee Name:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="First_name" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="stf_fname" value="<?php echo $edit_stf['stf_fname']; ?>">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="last_name" name="stf_lname" value="<?php echo $edit_stf['stf_lname']; ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Address:</label>
                        <div class="col-md-4">
                            <textarea  rows="4" class="form-control" placeholder="Personal Adderss" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="stf_address"><?php echo $edit_stf['stf_address'] ?></textarea>
                        </div>
                    </div>
                    <?php
                    $source = $edit_stf['stf_acc'];
                    $selected_source1 = 'unchecked';
                    $selected_source2 = 'unchecked';
                    if ($source == 1) {
                        $selected_source1 = 'checked="checked"';
                    } elseif ($source == 2) {
                        $selected_source2 = 'checked="checked"';
                    }
                    ?>
                    <div class="form-group col-md-12">
                        <div class="col-md-4">
                            <label for="stf_acc"></label>
                            <label class="col-md-5 control-label">Academic</label>
                            <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_acc" class="col-md-1" value="1" <?php echo $selected_source1 ?>>

                            <label class="col-md-5 control-label">Non-Academic</label>
                            <input type="radio" data-validation="required" name="stf_acc" class="col-md-1" value="2" <?php echo $selected_source2 ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Faculty:</label>
                        <div class="col-md-4">
                            <?php 
                                global $facultydrop;
                                $facextraattrs = 'id="stf_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                echo form_dropdown('stf_faculty',$facultydrop,$edit_stf['faculty_id'], $facextraattrs); 
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Mobile No:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_mobi" data-validation=" required" data-validation-error-msg-required="field can not be empty" value="<?php echo $edit_stf['stf_mobi']; ?>">
                        </div>
                        <label class="col-md-1 control-label">Home No:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_home" data-validation="required" data-validation-error-msg-required="field can not be empty" value="<?php echo $edit_stf['stf_home']; ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Email:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_email" data-validation="required email" data-validation-error-msg-required="Field can not be empty" data-validation-error-msg-email="Invalid E-mail" value="<?php echo $edit_stf['stf_email'] ?>">
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="col-md-2 control-label">Nationality:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_national" value="<?php echo $edit_stf['stf_national'] ?>">
                        </div>
                    </div>
                    <?php
                    $Status = $edit_stf['stf_marital'];
                    $selected_status1 = 'unchecked';
                    $selected_status2 = 'unchecked';
                    if ($Status == 1) {
                        $selected_status1 = 'checked="checked"';
                    } elseif ($Status == 2) {
                        $selected_status2 = 'checked="checked"';
                    }
                    ?>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="stf_marital" class="col-sm-5 control-label">Marital Status:</label>
                            <div class="col-sm-7">
                                <label class="col-md-3 control-label">Married</label>
                                <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_marital" class="col-md-2" id="stf_maritalstat1" value="1" <?php echo $selected_status1 ?>>

                                <label class="col-md-3 control-label">Unmarried</label>
                                <input type="radio" data validation="required" name="stf_marital" id="stf_maritalstat2" class="col-md-3" value="2" <?php echo $selected_status2 ?>>
                            </div>
                        </div>
                    </div><hr><hr>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Achievements:</label>
                        <div class="col-md-4">
                            <textarea title="Research Interest" rows="4" class="form-control" placeholder="Research Interest" name="research_interest" ><?php echo $edit_stf['research_interest'] ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <textarea title="Publications" rows="4" class="form-control" placeholder="Publications" name="publications_achive"><?php echo $edit_stf['publications_achive'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group  col-md-12">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <textarea title="Awards" rows="4" class="form-control" placeholder="Awards" name="awards_achive"><?php echo $edit_stf['awards_achive'] ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <textarea title="Memberships" rows="4" class="form-control" placeholder="Memberships" name="memberships_achive"><?php echo $edit_stf['memberships_achive'] ?></textarea>
                        </div>
                    </div>
                    <?php
                    $site = $edit_stf['public_achievements'];
                    $selected_site1 = 'unchecked';
                    $selected_site2 = 'unchecked';
                    if ($site == 1) {
                        $selected_site1 = 'checked="checked"';
                    } elseif ($site == 2) {
                        $selected_site2 = 'checked="checked"';
                    }
                    ?>
                    <div class="col-md-1"></div>
                    <div class="form-group">
                        <label for="public_achievements" class="col-sm-5 control-lable">Publish all lecturing qualifications with achievements Within the web site :</label>
                        <input type="radio" name="public_achievements" value="1" <?php echo $selected_site1 ?>> Yes <br>
                        <input type="radio" name="public_achievements" value="2" <?php echo $selected_site2 ?>> No
                    </div>
                    <hr>
                    <br>
                    <div class="form-group">
                        <div class="col-md-2">
                        </div>
                        <button type="submit" class="btn btn-info btn-md" name="submit">Update</button>
                        <!-- <button type="submit" onclick="event.preventDefault();confirm_regi()" name="regi_btn" id="regi_btn" class="btn btn-info">Register</button> -->
                        <!-- <button type="reset" class="btn btn-defult btn-md" name="reset">Back</button> -->
                    </div>     
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">

    $.validate({
        form: '#stf_reg'
    });

    profpic = "<?php echo base_url().$edit_stf['profileimage']; ?>";

    if(profpic == ""  || profpic==null)
    {
        profpic ="<?php echo base_url('uploads/defprof.png'); ?>";
    }

    $("#staffprof_pic").fileinput({showCaption: false,showUpload:false,defaultPreviewContent: '<img src="'+profpic+'" width="212px"'});

    function confirm_regi()
    {
        $.confirm({
            title: 'Register Staff',
            confirm: function () {
                $("#stf_reg").append("<input type='hidden' name='stf_id' value='Update' />");
                $("#stf_reg").submit();
            },
            cancel: function () {

            }
        });

    }


</script>
