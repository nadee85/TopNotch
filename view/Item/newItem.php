<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Item Form
            <small>Creating New Items</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Register User</li>
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
                    <div class="box box-solid box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Error!</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php // echo $errMsg; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <?php
//                    }
                    ?>
                    <?php
//                    if ($successMsg != null) {
                    ?>
                    <div class="box box-solid box-success">
                        <div class="box-header">
                            <h3 class="box-title">Success!</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php // echo $successMsg; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <?php
//                    }
                    ?>



                    <!-- form start -->
                    <form role="form" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputID">Item ID</label>
                                <input type="text" class="form-control" id="itemid" placeholder="Enter Item ID" name="txtItemID">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter Description" name="txtDescription">
                            </div>
                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="size">
                                    <option>500ML</option>
                                    <option>1000ML</option>
                                    <option>1500ML</option>
                                    <option>5L</option>
                                    <option>19L</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="txtPrice">
                            </div>
                            <div class="form-group">
                                <label for="inputCurStock">Current Stock</label>
                                <input type="text" class="form-control" id="stock" placeholder="Enter Current Stock" name="txtStock">
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