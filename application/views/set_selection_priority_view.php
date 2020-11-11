<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Set Priority</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Priority</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Priority</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_selection_form" name="set_selection_form" method="post" action="">
                            <div class="card-body">


                                <table id="priority_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($priority_list as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['priority_name']; ?></td>
                                                <td>
                                                    <input type="radio" value="" id="priority_<?php echo $row['id']; ?>" name="priority" <?php
                                                    if ($row['priority_status'] == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?>><br>
                                                    <input type="hidden" id="priority_id_check" name="priority_id_check" value="<?php echo $row['id']; ?>">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="save_priority();">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        var t = $('#priority_table').DataTable({
            "paging": false,
            "searching": false,
            "ordering": false,
            
            "order": [[1, 'asc']]
        });

        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });

    function save_priority() {
        var status = 0;

        var searchIDs = $("#priority_table input[type=radio]").map(function () {
            var row = $(this).closest("tr");
            var status = (this.checked ? "1" : "0");
            return {
                priority_id: $(row).find("input[id=priority_id_check]").val(),
                priority_status: status
            };
        }).get();

        var dataString = JSON.stringify(searchIDs);
        console.log(searchIDs);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('App/set_priority') ?>',
            dataType: 'json',
            data: {
                myData: dataString
            },
            success: function (msg) {
                //alert(msg);
                //funcres = {status: "success", message: "Priority Updated"};
                //result_notification(funcres);
                location.reload();
            }
        });



    }

    function set() {


    }
</script>