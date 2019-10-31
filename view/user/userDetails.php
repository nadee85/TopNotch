<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Details Form
            <small>User Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">User Details</li>
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
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmUDetails">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNIC">User Name</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username" required="">
                            </div>

                            <div class="form-group">
                                <label for="inputNIC">NIC</label>
                                <input type="text" class="form-control" id="nic" placeholder="Enter NIC" name="txtNic" required="">
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" id="address" rows="3" placeholder="Enter ..." name="txtAddress"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputPicture">Profile Picture</label>
                                <input type="file" id="picture" name="txtPicture" required="">
                                <p class="help-block">Image size should below 4mb. PNG, JPG</p>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="status" name="status" checked>Active
                                </label>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" name="submitsave" id="btnSave" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $("#frmUDetails").validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: "/TopNotch/user/uExists",
                        type: "POST",
                        data: {
                            username: function () {
                                return $("#username").val();
                            }
                        }
                    }
                },
                nic: {required: true}
            },
            messages: {
                username: {
                    remote: "Username is already taken!"
                }
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmUDetails").validate();
            if ($("#frmUDetails").valid()) {
                var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
                var user = {
                    username: $("#username").val(),
                    nic: $("#nic").val(),
                    address: $("#address").val(),
                    picture: filename,
                    status: $("#status").is(":checked")
                };
                $.ajax({
                    url: "/TopNotch/user/addUserDetails",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        userDData: user
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">User Details Successfully Added.</div></div>');
//                            window.location = "login";
//                        alert("Successfully registered!");
                        console.log(data);
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
