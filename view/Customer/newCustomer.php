<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Customer Form
            <small>Creating New Customer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">New Customer</li>
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
                    <div id="err">

                    </div>
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
                    <form id="frmCustomer" method="post">
                        <div class="box-body">
<!--                            <div class="form-group">
                                <label for="inputFname">Customer Id</label>
                                <input type="text" class="form-control" id="customerid" placeholder="Enter Customer Id" name="txtCusId">
                            </div>-->
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
                                    <input type="checkbox" id="status" name="status" checked > Set Enable
                                </label>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                            <!--<button type="submit" name="savecus" id="btnSave" class="btn btn-primary">Submit</button>-->
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $("#frmCustomer").validate({
            rules: {
                email: {
                    required: true,
                    pattern: /^[a-zA-Z0-9_\.]{3,}@([a-zA-Z0-9_]{3,})(\.[a-zA-Z0-9\_]{2,})+$/
                }
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmCustomer").validate();
            if ($("#frmCustomer").valid()) {
                var customer = {
//                    cusId: $("#customerid").val(),
                    fName: $("#fname").val(),
                    lName: $("#lname").val(),
                    address: $("#address").val(),
                    telephone: $("#telephone").val(),
                    mobile: $("#mobile").val(),
                    email: $("#email").val(),
                    status: $("#status").is(":checked")
                };

                $.ajax({
                    url: "/TopNotch/customer/addCustomer",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        cusData: customer
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Customer Successfully Registered.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmCustomer).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                        alert(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });
    });
</script>