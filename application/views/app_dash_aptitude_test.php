<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Approvals</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="card ml-5 mr-5">
                <div class="card-header">
                    <h5 class="card-title">Aptitude Test Marks</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="aptitude_test_mark" action="<?php echo base_url('aptitude_test/search_apt_students') ?>" method="POST">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="" class="ubuntu">Year</label>
                                <input type="text" class="ubuntu form-control custom-select border-radius" name="year" id="year" value="<?php echo date('Y'); ?>" placeholder="Year" aria-label="Year" aria-describedby="basic-addon2">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="" class="ubuntu">Center</label>
                                <select type="text" class="ubuntu form-control custom-select border-radius" id="priority1_center" name="priority1_center" value="" onchange="get_courses(this.value, 1, null, null)">
                                    <option value="" name="">Select Center</option>

                                    <?php
                                    foreach ($centers as $row):

                                        ?>
                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
                                            <?php echo $row['br_name']; ?>
                                        </option>
                                    <?php

                                    endforeach;

                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="" class="ubuntu">Course</label>
                                <select type="text" class="ubuntu form-control custom-select border-radius" id="course" name="course">
                                    <option value="" name="">Select Course</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="submit" value = "Search" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu"/>
                            </div>
                        </div>
                    </form>

                    <!-- <form action="<?php echo base_url('aptitude_test/save_apt_mark') ?>" id="save_marks" method="POST" > -->
                        <hr>
                        <table class="table table-striped table-bordered" id="student_table" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Index No</th>
                                <th>Student Name</th>
                                <th>NIC No</th>
                                <th>Marks</th>
                            </tr>
                            </thead>
                            <tbody id="reg_table_body">
                            <?php

                            //print_r($results);

                            $i = 1;
                            if (!empty($results)) {
                                // print_r($results);

                                foreach ($results as $va) {
                                    ?>

                                    <tr>
                                        <td align="center"> <?php echo $i ?></td>
                                        <td id="<?php echo $va['indexno'] ?>" class="stu_id"> <?php echo $va['indexno'] ?></td>
                                        <td> <?php echo $va['fullname'] ?></td>
                                        <td> <?php echo $va['nic'] ?></td>
                                        <td class="text-right"><input value="<?php echo $va['mark'] ?>" type="textbox" class="stu_mark" id="input_aptitude_marks-<?php echo $va['indexno'] ?>" name="input_aptitude_marks"></td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                        <hr>
                        <div class="float-right">
                            <input type="submit" id="save_apt" value="Save" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu">
                        </div>
                    <!-- </form> -->
                    
                </div>

            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

</div>


<script>
    $(document).ready(function () {
        $('#student_table').DataTable({searching: false, paging: true, info: false});
    });

    function student_view (student)
    {
        window.open('<?php echo base_url("App/student_profile_view") ?>?id='+student);
    }

    function student_edit_view(student){
        window.open('<?php echo base_url("App/student_edit_view") ?>?id='+student);
    }

    function get_courses(center_id, flag, course_id, course_submited) {
        $('#course').find('option').remove().end().append('<option value="" name="">Select Course</option>').val('');
        if (flag === 1) {

            $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': center_id
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {

                        if(data[i]['course_id'] == course_submited)
                        {
                            $('#course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']).attr("selected", "selected"));
                        }else
                        {
                            $('#course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    }
                },
                "json"
            );
        }
    }


    //set dropdown submitted values as selected
    function set_old_value() {
        let center_submited = "<?php if (isset($_SESSION['center_submited'])) { echo  $_SESSION['center_submited'];  } ?>";

        let course_submited = "<?php if (isset($_SESSION['course_submited'])) { echo  $_SESSION['course_submited'];  } ?>";

        if (center_submited) {
            $("#priority1_center").val(center_submited);
        }

        if (course_submited) {
            get_courses(center_submited, 1, null, course_submited);
        }
    }

    set_old_value();


    //save table data
    $("#save_apt").click(function(e) {

        var year = $('#year').val();
        var priority1_center = $('#priority1_center').val();
        var course = $('#course').val();

        e.preventDefault();

        let data = {};
        let i = 0;

        $('.stu_mark').each(function() {

            if($(this).val()) {
                id = this.id.split("-").pop();
                data[i] = { 'student_id' : id,
                    'center_id': priority1_center,
                    'course_id': course,
                    'mark' : $(this).val(),
                    'year' : year
                }
                i++;
            }
        });

        let url = "<?php echo base_url('aptitude_test/save_apt_mark') ?>";

        $.ajax({
            type: "post",
            url: url,
            data: {
                rec: data,
                test: 'test'
            },
            success: function(dat){
                alert("Insert Successfull!");
                //alert('Insert Successfull!');
                location.reload();
            }
        });
    });


    //to use this ajax form submit remove "_" from ID below.
    $("#aptitude_test_mark_").submit(function(e) {

        var year = $('#year').val();
        var priority1_center = $('#priority1_center').val();
        var course = $('#course').val();

        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: {
                year: year,
                center: center,
                course: course
            },
            success: function(data) {
                //location.reload(data);
                console.log(data);
            }
        });
    });
</script>









