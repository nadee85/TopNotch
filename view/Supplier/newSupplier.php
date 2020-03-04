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

            <div class="col-xs-12">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Fill all Fields</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>

                    <!-- form start -->
                    <form id="frmSupplier">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputFname">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="txtFName" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="txtLName" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="3" id="address" placeholder="Enter ..." name="txtAddress" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputTelephone">Telephone</label>
                                        <input type="tel" class="form-control" id="telephone" placeholder="Enter Telephone" name="txtTel" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMobile">Mobile</label>
                                        <input type="tel" class="form-control" id="mobile" placeholder="Enter Mobile" name="txtMobile" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="txtEmail" required="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="status" id="status" checked >Active
                                        </label>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                            <!--<button type="submit" name="submit" id="btnSave" class="btn btn-primary">Submit</button>-->
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $("#frmSupplier").validate({
            rules: {
                email: {
                    required: true,
                    pattern: /^[a-zA-Z0-9_\.]{3,}@([a-zA-Z0-9_]{3,})(\.[a-zA-Z0-9\_]{2,})+$/
                }
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmSupplier").validate();
            if ($("#frmSupplier").valid()) {
                var supplier = {
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
                    url: "/TopNotch/supplier/addSupplier",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        supData: supplier
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Supplier Successfully Registered.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmSupplier).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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