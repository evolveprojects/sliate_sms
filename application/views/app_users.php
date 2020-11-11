<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
?>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Manager</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Manager</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<div class="row">
    <div class="container bg-white p-2">

    <!-- tabs -->
<ul class="nav nav-tabs" id="userTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#list_users" role="tab" aria-controls="list_users" aria-selected="true">Users</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="edit_or_add_tab_a" data-toggle="tab" href="#edit_or_add_tab" role="tab" aria-controls="edit_or_add_tab" aria-selected="false">Add new user</a>
  </li>
</ul>

<!-- tabe conetent -->
<div class="tab-content p-3" id="userTabContent">
  <div class="tab-pane fade show active" id="list_users" role="tabpanel" aria-labelledby="list_users-tab">
        <table class="users table table-stripped" id="table_users">
            <thead>
                <th>User</th>
                <th>User Type</th>
                <th>Branch</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php if($records) { ?> 
                    <?php foreach ($records as $record) {  ?> 
                    <tr>
                        <td><?php echo $record['user_name'] ?></td>
                        <td><?php echo $record['user_type'] ?></td>
                        <td><?php echo $record['br_name'] ?></td>
                        <td>
                            <div class='btn-group' role='group' aria-label='Basic example'>
                                <button type='button' class='btn btn-sm btn-primary' onclick="edit_user('<?php echo $record['user_id'] ?>','<?php echo $record['user_name'] ?>','<?php echo $record['user_email'] ?>','<?php echo $record['user_type'] ?>','<?php echo $record['user_branch'] ?>')">edit</button>
                                <button type='button' class='btn btn-sm btn-danger'>x</button>
                            </div>
                        </td>
                    </tr>
                    <?php  } } else { ?>
                        <tr class="bg-grey bg-secondary"><td colspan="4">No records found!</td></tr>
                    <?php }?>
            </tbody>
        </table>
  </div>

  <div class="tab-pane fade" id="edit_or_add_tab" role="tabpanel" aria-labelledby="edit_or_add_tab-tab">
  <!-- add new form goes here -->
    <form>
        <input type="hidden" name="user_id" id="user_id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Name" required>
                <span class="text text-danger" id="nameHelp"></span>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" placeholder="Email" required>
                <span class="text text-danger" id="emailHelp"></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" id="inputEmail4" placeholder="Password">
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" class="form-control" id="inputPassword4" placeholder="Confirm Password">
                <span class="text text-danger" id="confirm_passwordHelp"></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_type">User Type</label>
                <select type="text" id="user_type" class="form-control" placeholder="Name" required>
                        <option value="super_user">Super User</option>
                        <option value="center_user">Center User</option>
                        <option value="examiner">Examiner</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="center">Center</label>
                <?php 
                    global $branchdrop;
                    global $selectedbr;
                                            
                    $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" required';
                    echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                ?>
            </div>
        </div>
        <hr>
        <div class="float-right">
            <button class="btn btn-light " id="reset_user">Reset</button>
            <button class="btn btn-success " id="save_user"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
        </div>
    </form>

  </div>

</div>
<!-- tab is over -->

    </div> 
</div>



<script>
    
    $(document).ready(function() 
    {
        $('#table_users').DataTable();
    });

    //save user data
    $("#save_user").click(function(e)
    {
        e.preventDefault();
        let isValid = {};

        if($('#user_id').val() == '') {
            if($('#password').val() != '') {
                if($('#password').val() != $('#confirm_password').val()) {
                    $('#confirm_passwordHelp').html('Password does not match.');
                } else {
                    isValid['ps'] =1;
                    $('#confirm_passwordHelp').html('');
                }
            } else {
                $('#confirm_passwordHelp').html('Password can not be empty.');
            }
        } else {
            if($('#password').val() != $('#confirm_password').val()) {
                $('#confirm_passwordHelp').html('Password does not match. Leave blank if you don\'t want to update password.');
            } else {
                isValid['ps'] = 1;
                $('#confirm_passwordHelp').html('');
            }
        }

        if($('#name').val() == '') {
            $('#nameHelp').html("Name can not be empty.");
        } else {
            isValid['name'] = 1;
            $('#nameHelp').html('');
        }
        if($('#email').val() == '') {
            $('#emailHelp').html("Email can not be empty.");
        } else {
            if(isEmail($('#email').val())){
                isValid['email'] = 1;
                $('#emailHelp').html('');
            } else {
                $('#emailHelp').html("Enter a valid email address.");
            }
        }

        if (isValid['name'] && isValid['email'] && isValid['ps']) 
        {
            $.post('<?php echo base_url('settings/save_user') ?>', 
                {
                    user_id: $('#user_id').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    user_type: $('#user_type').val(),
                    center: $('#center').val()
                },
                function (params) 
                {
                    //let data = JSON.parse(params);
                    //alert(data['msg']);
                    $.notify(params, {
                        offset: {
                            x: 40,
                            y: 60
                        },
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        }
                    });
                    emptyFields();
                }
            );
        }   
    });


    function edit_user(u_id, name, email, u_type, branch)
    {
        //active edit tab
        $('.nav-tabs a[href="#edit_or_add_tab"]').tab('show');
        $('#edit_or_add_tab_a').html('Edit User');
        //set values
        $('#user_id').val(u_id);
        $('#name').val(name);
        $('#email').val(email);
        $('#user_type').val(u_type);
        $('#center').val(branch);
    }

    $('#reset_user').click(function(e)
    {
        e.preventDefault();
        
        emptyFields();
    })

   function emptyFields(){
        $('#user_id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#user_type').val('');
        $('#center').val('');
        $('#nameHelp').html('');
        $('#emailHelp').html('');
        $('#confirm_passwordHelp').html('');
        $('#edit_or_add_tab_a').html('Add new User');
   }

   function isEmail(email) {
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (testEmail.test(email)) return true;
        else return false;
   } 
</script>