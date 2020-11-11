<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="icon_document_alt"></i>ASSIGNMENT MARKS</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Marks</li>
            <li><i class="fa fa-bank"></i>Add Marks</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="comp_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">Look Up</a></li>
    <li role="presentation"><a id="grp_tab" href="#add_tab" aria-controls="add_tab" role="tab" data-toggle="tab">Add Marks</a></li>
</ul>
<div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <header class="panel-heading">
                Add Assignment Result
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" action="" autocomplete="off" novalidate>
                        <br>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Course :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="course_code">
                                    <option value="">--Select---</option>
                                    <option value="1">test1</option>
                                    <option value="2">test2</option>
                                    <option value="3">test3</option>
                                </select>
                            </div>

                            <label class="col-md-1 control-label">Year :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="year">
                                    <option value="">--Select---</option>
                                    <option value="1">year1</option>
                                    <option value="2">year2</option>
                                    <option value="3">year3</option>
                                </select>
                            </div>
                            <label class="col-md-1 control-label">Semester :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="semester">
                                    <option value="">--Select---</option>
                                    <option value="1">semester1</option>
                                    <option value="2">semester2</option>
                                    <option value="3">semester3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Subject Name :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="subject_name">
                                    <option value="">--Select---</option>
                                    <option value="1">subject_1</option>
                                    <option value="2">subject_2</option>
                                    <option value="3">subject_3</option>
                                </select>
                            </div>
                            <label class="col-md-1 control-label">Assignment Name :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="assignment_name">
                                    <option value="">--Select---</option>
                                    <option value="1">assignment_1</option>
                                    <option value="2">assignment_2</option>
                                    <option value="3">assignment_3</option>
                                </select>
                            </div>

                            <div class="col-md-3 ">
                                <button type="button" class="btn btn-info btn-md" name="submit">Search</button>
                            </div>



                        </div>
                        <br><br>
                        <div class="col-md-12 ">
                            <div class="col-md-6 col-md-offset-3">
                                <table id="assignment_mark_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:50%" cellspacing="0" align="center">
                                    <thead>
                                        <tr bgcolor="#F0F8FF">
                                            <th>#</th>
                                            <th>Registration No</th>
                                            <th>Student Name</th>
                                            <th>Assignment Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>CS/001</th>
                                            <th>Lakshan Dissanayaka</th>
                                            <th>85</th>
                                        </tr>

                                        <tr>
                                            <th>2</th>
                                            <th>CS/002</th>
                                            <th>Irantha De Silva</th>
                                            <th>85</th>
                                        </tr>

                                        <tr>
                                            <th>3</th>
                                            <th>CS/003</th>
                                            <th>Nuwan Asela</th>
                                            <th>85</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br/><br/><br/><br/>

                        <!--                        <div class="form-group">
                                                    <div class="col-md-9 ">
                                                    </div>
                                                    <div class="col-md-3 ">
                        
                                                        <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                                                        <button type="reset" class="btn btn-defult btn-md" name="reset">Reset</button>
                                                    </div>
                                                </div>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="add_tab">
        <div class="panel">
            <header class="panel-heading">
                Add Assignment Result
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" action="" autocomplete="off" novalidate>
                        <br>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Course :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="course_code">
                                    <option value="">--Select---</option>
                                    <option value="1">test1</option>
                                    <option value="2">test2</option>
                                    <option value="3">test3</option>
                                </select>
                            </div>

                            <label class="col-md-1 control-label">Year :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="year">
                                    <option value="">--Select---</option>
                                    <option value="1">year1</option>
                                    <option value="2">year2</option>
                                    <option value="3">year3</option>
                                </select>
                            </div>
                            <label class="col-md-1 control-label">Semester :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="semester">
                                    <option value="">--Select---</option>
                                    <option value="1">semester1</option>
                                    <option value="2">semester2</option>
                                    <option value="3">semester3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Subject Name :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="subject_name">
                                    <option value="">--Select---</option>
                                    <option value="1">subject_1</option>
                                    <option value="2">subject_2</option>
                                    <option value="3">subject_3</option>
                                </select>
                            </div>
                            <label class="col-md-1 control-label">Assignment Name :</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" name="assignment_name">
                                    <option value="">--Select---</option>
                                    <option value="1">assignment_1</option>
                                    <option value="2">assignment_2</option>
                                    <option value="3">assignment_3</option>
                                </select>
                            </div>

                            <div class="col-md-3 ">
                                <button type="button" class="btn btn-info btn-md" name="submit">Search</button>
                            </div>



                        </div>
                        <br><br>
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:50%" cellspacing="0" align="center">
                            <thead>
                                <tr bgcolor="#F0F8FF">
                                    <th>#</th>
                                    <th>Registration No</th>
                                    <th>Student Name</th>
                                    <th>Assignment Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>CS/001</th>
                                    <th>Lakshan Dissanayaka</th>
                                    <th><input type="text" name="res1"></th>
                                </tr>

                                <tr>
                                    <th>2</th>
                                    <th>CS/002</th>
                                    <th>Irantha De Silva</th>
                                    <th><input type="text" name="res1"></th>
                                </tr>

                                <tr>
                                    <th>3</th>
                                    <th>CS/003</th>
                                    <th>Nuwan Asela</th>
                                    <th><input type="text" name="res1"></th>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-md-10 ">
                            </div>
                            <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#assignment_mark_look').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });
    });

</script>