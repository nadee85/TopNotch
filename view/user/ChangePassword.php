
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-6">

                <!-- general form elements -->
                <div class="box box-primary">
                    <!--                    <div class="box-header">
                                            <h3 class="box-title">Fill all Fields</h3>
                                        </div> /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmChangePW">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputContact">Current Password</label>
                                <input type="password" class="form-control" id="cpassword" placeholder="Enter Current Password" name="cpassword" required="">
                            </div>
                            <div class="form-group">
                                <label for="inputContact">New Password</label>
                                <input type="password" class="form-control" id="npassword" placeholder="Enter New Password" name="npassword" required="">
                            </div>
                            <div class="form-group">
                                <label for="inputContact">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm" placeholder="Confirm Password" name="confirm" >
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" name="submitsave" id="btnSave" class="btn btn-primary" value="Change Password">
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
            $("#frmChangePW").validate({
                rules: {
                    cpassword: {
                        required: true,
                        remote: {
                            url: "/TopNotch/user/passexists",
                            type: "POST",
                            data: {
                                cpassword: function () {
                                    return $("#cpassword").val();
                                }
                            }
                        }
                    },
                    confirm: {
                        required: true,
                        equalTo: "#npassword"
                    }
                },
                messages: {
                    cpassword: {
                        remote: "Invalied Current Password!"
                    }
                }
            });

        $(document).on("click", "#btnSave", function () {
            $("#frmChangePW").validate();
            if ($("#frmChangePW").valid()) {
                var code = {
                    password: $("#npassword").val()
                };
                $.ajax({
                    url: "/TopNotch/user/changePass",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        actData: code
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
            <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Password Changed Successfully.</div></div>');
//                        alert("Successfully registered!");
                        $('#cpassword').val("");
                        $('#npassword').val("");
                        $('#confirm').val("");
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
