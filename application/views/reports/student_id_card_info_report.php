<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js')?>"></script><!--jquery-->
<style type="text/css">

    .affix-top {
      position: relative;
    }

    .affix {
      top: 70px;
    }

    .affix, 
    .affix-bottom {
        width: 168px;
    }

    .affix-bottom {
      position: absolute;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT ID CARD REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Student ID Card Info Report</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="container col-md-12">
        <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
            <section class="panel affixpanel" id="generaldata">
                <header class="panel-heading">
                    Student ID Card Info Report
                </header>
                <div class="panel-body" style="padding-bottom: 30px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Year : </label>
                                <div class="col-md-9">
                                <select class="form-control" id="fullsumyear" name="fullsumyear" onchange="" data-validation="required">
                                        <option value="">---Select Year---</option>
                                            <?php
                                                 foreach ($year_list as $yr):
                                                    if ($yr['year'] != 0) {
                                                            ?>
                                                            <option value="<?php echo $yr['year']; ?>">
                                                                <?php echo $yr['year']; ?>
                                                            </option>
                                                            <?php
                                                        }    
                                                 endforeach;   
                                            ?>                   
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-7">
                                    <?php 
                                    global $branchdrop;
                                    global $selectedbr;

//                                    if(isset($stu_data))
//                                    {
//                                        $selectedbr = $stu_data['center_id'];
//                                    }
//
//                                    $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value,null,this);"';
//
//                                    echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                    ?>
                                    
                                    <select class="form-control" id="center_id" name="center_id" style="width:100%" data-validation="required" onchange="load_course_list(this.value)">
                                        <option value="">---Select center---</option>
                                        <?php
                                            foreach ($centers as $row):
                                                ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                            <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                            </option>
                                                <?php
                                            endforeach;
                                            ?>
                                    </select> 
                                </div>
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                <div class="col-md-9">
                                    <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                    <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                        <option value="">---Select Course Code---</option>
                                    </select>
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    
                    <div class="col-md-12">
                         
                        <!--<a data-toggle='tooltip' title='Download Image' href='download_bulk_profile_images'  >Download All images</a>-->  
                        <button type="button" style="float: right; margin-right: 12px;"   class="btn btn-success" id="download_btn" name="download_btn" onclick="download_bulk_profile_images();">Download All images</button>
                        <button type="button" style="float: right; margin-right: 12px;" id="print_btn" name="print_btn" class="btn btn-success" onclick="load_student_id_card_pdf();">Print PDF</button>
                        <button type="button" style="float: right; margin-right: 12px;" id="print_btn_excel" name="print_btn_excel" class="btn btn-success" onclick="load_student_id_card_excel();">Print Excel</button>
                        <button type="button" style="float: right; margin-right: 12px;" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>
                    </div>
                </div>
                    
                    <table id="stu_idcard_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Center</th>
                            <th>Name</th>
                            <th>Register No</th>
                            <th>Course</th>
                            <th>NIC</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_body">
                        
                    </tbody>
                </table>
                </div>
            </section>
        </form> 
    </div>
</div>

<script type="text/javascript">
   
    $.validate({
        form: '#stu_reg'
    });

    $(document).ready(function () {
        
        $('#print_btn').attr('disabled', true);
        $('#print_btn_excel').attr('disabled', true);
        $('#download_btn').attr('disabled', true);
        
        $('#stu_idcard_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });
      
    });
    
    

    /*
    * load courses
    */
     function load_course_list(center_id)
    {
        $('#course_id').find('option').remove().end();
        $("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},

        function (data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
            }
        },
        "json"
        );
    }

    function search_student_details()
    {
        $('.se-pre-con').fadeIn('slow');
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year = $('#fullsumyear').val();
        

        $.post("<?php echo base_url('Report/search_students_id_card_details') ?>", {'center_id': center_id, 'course_id': course_id, 'year':year},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $('#stu_idcard_tbl').DataTable().destroy();
                    $('#stu_idcard_tbl').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        $('#print_btn').attr('disabled', false);
                        $('#download_btn').attr('disabled', false);
                        $('#print_btn_excel').attr('disabled', false);
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            
                            prof_image = data[j]['profileimage'];
                            
                            if(data[j]['profileimage'] == "" || data[j]['profileimage'] == null){
                                prof_image = '';//"uploads/defprof.png";
                            }
                            
                            img_link = "<?php echo base_url()?>"+prof_image;
                            image_content = "<img src='"+img_link+"' style='height: 100px; width: 100px;'/>";
                            
                            if(data[j]['profileimage'] == "" || data[j]['profileimage'] == null){
                                image_content = '<span style="font-weight:bold">No Preview</span>';
                            }
                            
                            $('#stu_idcard_tbl').DataTable().row.add([
                                "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                data[j]['first_name'],
                                data[j]['reg_no'],
                                "[" + data[j]['course_code'] + "] - " + data[j]['course_name'], //+ " " + data[j]['last_name'],
                                data[j]['nic_no'],
                                image_content
                            ]).draw(false);
                        }
                        $('.se-pre-con').fadeOut('slow');
                    }
                    else{
                         $('.se-pre-con').fadeOut('slow');
                        $('#print_btn').attr('disabled', true);
                    }
                }
            },
            "json"
            );


    }
    
   function download_bulk_profile_images()
   {
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year = $('#fullsumyear').val();
        
//        $.post("<?php echo base_url('Report/download_bulk_profile_images') ?>", {'center_id': center_id, 'course_id': course_id},
//        function (data)
//        {
//            
//        });
        cenName = $('#center_id option:selected').text().split("-");
        courseName = $('#course_id option:selected').text().split("-");
        //alert(cenName[0] + "   " + courseName[0]);
        var url = 'download_bulk_profile_images/' + center_id + '/' + course_id+'/'+$.trim(cenName[0])+'/'+$.trim(courseName[0]+'/'+year);
        window.location = url;
   }
    function load_student_id_card_pdf(){
        
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year = $('#fullsumyear').val();

        window.open('<?php echo base_url("report/student_id_card_report_pdf") ?>?cen=' + center_id +'&cou=' +course_id +'&year='+year);
  
//          $.ajax({
//            type: "POST",
//            url: "<?php //echo base_url("report/imageResize")?>",
//            data: {}
//          }).done(function(msg) {
//            alert( "Image Resized" + msg );
//          });    
    }
    
    function load_student_id_card_excel(){
        
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year = $('#fullsumyear').val();

        window.open('<?php echo base_url("report/student_id_card_report_excel") ?>?cen=' + center_id +'&cou=' +course_id + '&year='+year);
  
//          $.ajax({
//            type: "POST",
//            url: "<?php //echo base_url("report/imageResize")?>",
//            data: {}
//          }).done(function(msg) {
//            alert( "Image Resized" + msg );
//          });    
    }
    
    

</script>
