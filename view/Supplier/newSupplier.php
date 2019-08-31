<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Supplier Form
            <small>Creating New Supplier</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">New Supplier</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-6">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Fill all Fields</h3>
                    </div><!-- /.box-header -->



                    <?php
//                    if ($errMsg != null) {
                    ?>
                    <!--                    <div class="box box-solid box-danger">
                                            <div class="box-header">
                                                <h3 class="box-title">Error!</h3>
                                            </div> /.box-header 
                                            <div class="box-body">
                    <?php // echo $errMsg; ?>
                                            </div> /.box-body 
                                        </div> /.box -->
                    <?php
//                    }
                    ?>
                    <?php
//                    if ($successMsg != null) {
                    ?>
                    <!--                    <div class="box box-solid box-success">
                                            <div class="box-header">
                                                <h3 class="box-title">Success!</h3>
                                            </div> /.box-header 
                                            <div class="box-body">
                    <?php // echo $successMsg; ?>
                                            </div> /.box-body 
                                        </div> /.box -->
                    <?php
//                    }
                    ?>



                    <!-- form start -->
                    <form role="form" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);   ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCusId">Supplier ID</label>
                                <input type="text" class="form-control" id="supplierid" placeholder="Enter Supplier ID" name="txtSupId">
                            </div>
                            <div class="form-group">
                                <label for="inputFname">First Name</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="txtFName">
                            </div>
                            <div class="form-group">
                                <label for="inputLname">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="txtLName">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" id="address" placeholder="Enter ..." name="txtAddress"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputTelephone">Telephone</label>
                                <input type="tel" class="form-control" id="telephone" placeholder="Enter Telephone" name="txtTel">
                            </div>
                            <div class="form-group">
                                <label for="inputMobile">Mobile</label>
                                <input type="tel" class="form-control" id="mobile" placeholder="Enter Mobile" name="txtMobile">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="txtEmail">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" checked > Set Enable
                                </label>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="submit" id="btnSave" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $(document).on("click", "#btnRegister", function () {
            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();

            if (password !== confirmPassword) {
                //Passwords mismatching
                alert("Passwords do not match!");
            }

            var user = {
                username: $("#username").val(),
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                email: $("#email").val(),
                password: $("#password").val()
            };

            $.ajax({
                url: "/BITProject2019/user/doRegistration",
                type: "POST",
                dataType: "JSON",
                data: {
                    userData: user
                },
                success: function (data) {
                    alert("Successfully registered!");
                    console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                    console.log(errorThrown);
                }
            })
        });
    });
</script>