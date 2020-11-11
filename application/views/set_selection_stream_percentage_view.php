<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Set Stream Percentage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Stream Percentage</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Stream Percentage</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_stream_percentage_form" name="set_stream_percentage_form" method="post" action="<?php echo base_url('App/set_stream_percentage') ?>" onsubmit="return validateForm()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Year</label>
                                    <input type="text" class="form-control" id="set_stream_percentage_year" name="set_stream_percentage_year" placeholder="" disabled="disabled" value="<?php echo  $set_stream_percentage_year;?>">
                                    <input type="hidden" class="form-control" id="set_stream_percentage_year" name="set_stream_percentage_year" placeholder="" value="<?php echo  $set_stream_percentage_year;?>">
                                </div> 
                                <div class="form-group"> 
                                    <label for="">Center</label>
                                    <select class="form-control" id="set_stream_percentage_center" name="set_stream_percentage_center" onchange="get_stream_percentage_courses(this.value, 1, null);">
                                        <option>Select Center</option>
                                        <?php
                                        foreach ($center as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
                                                <?php echo $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <select class="form-control" id="set_stream_percentage_course" name="set_stream_percentage_course" onchange="get_stream_percentage_details()" >
                                        <option>Select Course</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Selection Stream Percentage</label>
                                    <table class="table" id="perc_table" name="perc_table">
                                        <thead id="perc_head">
                                            <tr>
                                                <th scope="col">Subjects</th>
                                                <th scope="col">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            <tr>
                                                <td>Commerce <input type="hidden" id="com_perc_id" name="com_perc_id"></td>
                                                <td><input type="text" class="form-control form-control-sm" id="com_perc" name="com_perc"></td>
                                            </tr>-->
                                            <?php foreach ($al_streams as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['stream_name']; ?></td>
                                                <td><input type="text" class="form-control form-control-sm" id="al_stream_perc_<?php echo preg_replace("/\s+/", "", $row['stream_name']); ?>" name="al_stream_perc_<?php echo $row['stream_name']; ?>"></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-primary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Stream Percentage List</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#perc_table').DataTable( {
            "paging":   false,
            "sort":   false,
            "searching":   false

        } );
    } );
    
    
    
    function validateForm(){
        var AnswerInput = document.getElementsByName('al_stream_perc[]');
        for (i=0; i<AnswerInput.length; i++){
            var x = parseFloat(AnswerInput[i].value); 
            var regexPattern = /(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)/i;
            if (AnswerInput[i].value == ""){
                alert('Complete all the fields');		
                return false;
            }else if(isNaN(x) || x < 0 || x > 100){
                alert('Set Proper Range');		
                return false;
            }
        }
    }

    function get_stream_percentage_courses(center_id, flag, course_id) {

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': center_id
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#set_stream_percentage_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }
                },
                "json"
            );

        }
    }

    /**
     * Replace subject percentage with mark
     */
    function get_stream_percentage_details() {
        var set_center = $('#set_stream_percentage_center').val();
        var set_course = $('#set_stream_percentage_course').val();
        var set_date = $('#set_stream_percentage_year').val();

        $('#set_stream_percentage').val('');
        $('#set_stream_percentage_id').val('');

        $.post("<?php echo base_url('App/get_stream_percentage_details') ?>", {
            'center_id': set_center,
            'course_id': set_course,
            'date': set_date
        },
            function (data) {
               $('#al_stream_perc_Commerce').val(data["0"].commerce_perc);
               $('#al_stream_perc_Arts').val(data["0"].arts_perc);
               $('#al_stream_perc_BioScience').val(data["0"].bio_science_perc);
               $('#al_stream_perc_Mathematics').val(data["0"].mathematics_perc);
               $('#al_stream_perc_Technology').val(data["0"].technology_perc);
               $('#al_stream_perc_Other').val(data["0"].other_perc);
            },
            "json"
        );
    }
</script>