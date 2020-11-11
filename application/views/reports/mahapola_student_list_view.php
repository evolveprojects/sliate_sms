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
        <h3 class="page-header"><i class="fa fa-users"></i> MAHAPOLA STUDENT REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Mahapola Student List</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Mahapola Student Reports
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#full_summary_tab" aria-controls="full_summary_tab" role="tab" data-toggle="tab"> Full Summary</a></li>
                                <!--<li role="presentation"><a class="fa fa-university" href="#center_wise_full_tab" aria-controls="center_wise_full_tab" role="tab" data-toggle="tab"> Center wise Full Summary</a></li>-->
                                <!--<li role="presentation"><a class="fa fa-graduation-cap" href="#center_wise_detail_tab" aria-controls="center_wise_detail_tab" role="tab" data-toggle="tab"> Center wise Detail Summary</a></li>-->
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="full_summary_tab"><br/>
                                    <!--<form class="form-horizontal" role="form" method="post"  id="full_sum_form" action="<?php echo base_url('report/student_list_full_summary_pdf') ?>"  autocomplete="on" novalidate enctype="multipart/form-data">-->
<!--                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" style="float: right; margin-right: 5%;" class="btn btn-success">Print Report</button>
                                            <button style="float: right; margin-right: 1.5%;" class="btn btn-success" onclick="window.open('<?php echo base_url("report/student_list_full_summary_pdf") ?>');">Print Report</button>
                                        </div>
                                    </div>-->
                                    
                                    <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <div class="form-group col-md-6">
                                                    <div class="form-group">
                                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                                            <div class="col-md-7">
                                                                <?php 
                                                                global $branchdrop;
                                                                global $selectedbr;

                                                                if(isset($stu_data))
                                                                {
                                                                    $selectedbr = $stu_data['center_id'];
                                                                }

                                                                $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_wise();"';

                                                                echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                                                ?>
                                                            </div>
                                                        <div class="col-md-12">
                                                            <!--<button style="float: right; margin-right: -405px;" type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>--> 
                                                            
                                                            <button style="float: right; margin-right: -109%;" class="btn btn-success" id="print_btn" name="print_btn" onclick="load_pdf_for_mahapola();">Print Report</button>
                                                        </div>
                                                    </div>				
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <br/>
                                    
                                    <table id="full_sum" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Center Code</th>
                                                <th>Course</th>
                                                <th>Course Code</th>
                                                <th>Total Applied<br/>Students</th>
                                                <th>Approve</th>
                                                <th>Not Approve</th>
                                                <th>Reject</th>
                                                <th class="hidden">flag</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Grand Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ------------------- -->
                </div>
            </div>
        </div>
    </div>
</div>            

<script type="text/javascript">
   
    $.validate({
        form: '#stu_reg'
    });

    $(document).ready(function () {
        
        $('#print_btn').attr('disabled', true);
       
        $('#full_sum').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });
        
        if($('#user_level').val() == "1"){
        $('#center_id').find('option').get(0).remove();
        $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
    }
        load_course_wise();
      
    });
    
    
    function load_course_wise(){
        
        var type_val = $('#center_id').val();

        $.post("<?php echo base_url('Report/student_course_wise_mahapola_details')?>",{'type_val':type_val},
            function(data)
            {
                var total_student = 0;
                var total_approved = 0;
                var total_reject = 0;
                var total_not_approve = 0;

                var center_total_student = 0;
                var center_total_approved = 0;
                var center_total_reject = 0;
                var center_total_not_approve = 0;

                $('#full_sum').DataTable().destroy();

                $('#full_sum').DataTable({
                    'ordering': true,
                    'paging': false,
                    "columnDefs": [ 
                    {
                        "targets": 4,
                        "className": "text-center"
                    },
                    {
                        "targets": 5,
                        "className": "text-center"
                    },
                    {
                        "targets": 6,
                        "className": "text-center"
                    },
                    {
                        "targets": 7,
                        "className": "text-center"
                    },
                    {
                        "targets": 8,
                        "className": "hidden"
                    }],
                    'footerCallback': function ( row, data, start, end, display ) {
                        //this function is to get the total to the footer by ignoring the center wise total rows.
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };


                        // Total over all pages
                        total_5 = api
                            .column(4)
                            .data()
                            .reduce(function (a, b) {
                                var cur_index = api.column(4).data().indexOf(b);

                                if (api.column(8).data()[cur_index] != "1") {
                                   return intVal(a) + intVal(b);
                                }
                                else { return intVal(a); }
                               // return intVal(a) + intVal(b);
                        }, 0);

                        total_6 = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                               // return intVal(a) + intVal(b);

                               var cur_index2 = api.column(5).data().indexOf(b);

                                if (api.column(8).data()[cur_index2] != "1") {
                                   return intVal(a) + intVal(b);
                                }
                                else { return intVal(a); }
                        }, 0);

                        total_7 = api
                            .column(6)
                            .data()
                            .reduce(function (a, b) {
                                //return intVal(a) + intVal(b);

                                var cur_index3 = api.column(6).data().indexOf(b);

                                if (api.column(8).data()[cur_index3] != "1") {
                                   return intVal(a) + intVal(b);
                                }
                                else { return intVal(a); }
                        }, 0);

                        total_8 = api
                            .column(7)
                            .data()
                            .reduce(function (a, b) {
                                //return intVal(a) + intVal(b);

                                var cur_index4 = api.column(7).data().indexOf(b);

                                if (api.column(8).data()[cur_index4] != "1") {
                                   return intVal(a) + intVal(b);
                                }
                                else { return intVal(a); }
                        }, 0);

                        // Update footer
                        $( api.column(0).footer()).html(
                            'Grand Total'
                        );

                        $( api.column(4).footer()).html(
                            total_5
                        );

                        $( api.column(5).footer()).html(
                            total_6
                        );

                        $( api.column(6).footer()).html(
                            total_7
                        );

                        $( api.column(7).footer()).html(
                            total_8
                        );
                    },
                    'fnRowCallback': function( nRow, aData, iDisplayIndex ) {
                        //this function is to make the center wise total rows bold
                        var api = this.api(), aData;

                        if (api.column(8).data()[iDisplayIndex] == "1") {
                            $('td', nRow).each(function(){
                                $(this).html('<b>'+$(this).text()+'</b>');
                            });
                        }
                        else { 
                            $('td', nRow).each(function(){
                                $(this).html($(this).text());
                            });
                        }
                        return nRow;
                    }
                });

                $('#full_sum').DataTable().clear().draw();

                if (data.length > 0) 
                {
                    $('#print_btn').attr('disabled', false);
                    
                    for (x = 0; x < data.length; x++) 
                    {
                        if(x == 0){
                            $('#full_sum').DataTable().row.add([
                                data[x]['br_name'],
                                data[x]['br_code'],
                                data[x]['course_name'],
                                data[x]['course_code'],
                                data[x]['stu_count'],
                                data[x]['apprv_status'],
                                data[x]['status'],
                                data[x]['reject_status'],
                                '0'
                            ]).draw(false); 
                        }
                        else{
                            if(data[x-1]['br_code'] != data[x]['br_code'])
                            {
                                $('#full_sum').DataTable().row.add([
                                    data[x-1]['br_name']+' ATI Total',
                                    '',
                                    '',
                                    '',
                                    parseInt(center_total_student, 10),
                                    parseInt(center_total_approved, 10),
                                    parseInt(center_total_not_approve, 10),
                                    parseInt(center_total_reject, 10),
                                    '1'
                                ]).draw(false);

                                center_total_student = 0;
                                center_total_approved = 0;
                                center_total_reject = 0;
                                center_total_not_approve = 0;
                            }

                            $('#full_sum').DataTable().row.add([
                                data[x]['br_name'],
                                data[x]['br_code'],
                                data[x]['course_name'],
                                data[x]['course_code'],
                                data[x]['stu_count'],
                                data[x]['apprv_status'],
                                data[x]['status'],
                                data[x]['reject_status'],
                                '0'
                            ]).draw(false); 
                        }

                        center_total_student += parseInt(data[x]['stu_count']);
                        center_total_approved += parseInt(data[x]['apprv_status']);
                        center_total_reject += parseInt(data[x]['reject_status']);
                        center_total_not_approve += parseInt(data[x]['status']); 

                        total_student += parseInt(data[x]['stu_count']);
                        total_approved += parseInt(data[x]['apprv_status']);
                        total_reject += parseInt(data[x]['reject_status']);
                        total_not_approve += parseInt(data[x]['status']); 
                    }

                    $('#full_sum').DataTable().row.add([
                        data[x-1]['br_name']+' ATI Total',
                        '',
                        '',
                        '',
                        parseInt(center_total_student, 10),
                        parseInt(center_total_approved, 10),
                        parseInt(center_total_not_approve, 10),
                        parseInt(center_total_reject, 10),
                        '1'
                    ]).draw(false);
                }
                else{
                    $('#print_btn').attr('disabled', true);
                }
            },  
            "json"
            );
    }
    
    
    function load_pdf_for_mahapola(){
        
        var type_val = $('#center_id').val();
        
        window.open('<?php echo base_url("report/mahapola_student_full_summary_pdf") ?>?cen_type=' + type_val);
    }
    

</script>


