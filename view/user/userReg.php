<body class="skin-blue">
    <header class="main-header">
        <a href="../home/index" class="navbar-brand"><img src="<?= RESOURCES ?>dist/logo1.png" width="150" height="75"></a>
    </header>
    <aside class="main-sidebar">
    </aside>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create New User Form
                <small>Creating New Users</small>
            </h1>
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

                        <div id="err">

                        </div>

                        <!-- form start -->
                        <form role="form" id="frmURegister" action="login">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputNIC">User Name</label>
                                            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputFname">First Name</label>
                                            <input type="text" class="form-control" id="fName" placeholder="Enter First Name" name="fName" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLname">Last Name</label>
                                            <input type="text" class="form-control" id="lName" placeholder="Enter Last Name" name="lName" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContact">Mobile</label>
                                            <input type="tel" class="form-control" id="mobile" placeholder="Enter Email" name="mobile" required="" >
                                        </div>
                                    </div><!-- /.box-body -->
                                </div>
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputContact">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPicture">Profile Picture</label>
                                            <input type="file" id="picture" name="txtPicture" required="">
                                            <p class="help-block">Image size should below 4mb. PNG, JPG</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContact">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContact">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm" placeholder="Confirm Password" name="confirm" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--<button type="submit" name="submitsave" id="btnRegister" class="btn btn-primary">Register</button>-->
                                        <input type="button" class="btn btn-primary" id="btnRegister" value="Register"/>
                                    </div>
                                    <!--                                    <div class="col-md-6">
                                                                            <button type="button" name="cancel" id="btnCancel" class="btn btn-primary pull-right">Cancel</button>
                                                                        </div>-->
                                </div>
                            </div>
                        </form>
                    </div><!-- /.box -->

                </div><!--/.col (left) -->

            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <script>
        $(document).ready(function () {
            $.validator.addMethod("pattern", function (value, element, regexpr) {
                return regexpr.test(value);
            }, "Value in the field is invalid");

            $("#frmURegister").validate({
                rules: {
                    username: {
                        required: true,
                        remote: {
                            url: "/TopNotch/user/exists",
                            type: "POST",
                            data: {
                                username: function () {
                                    return $("#username").val();
                                }
                            }
                        }
                    },
                    email: {
                        required: true,
                        pattern: /^[a-zA-Z0-9_\.]{3,}@([a-zA-Z0-9_]{3,})(\.[a-zA-Z0-9\_]{2,})+$/
                    },
                    confirm: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        remote: "Username is already taken!"
                    }
                }
            });

            $(document).on("click", "#btnRegister", function () {
                $("#frmURegister").validate();
                if ($("#frmURegister").valid()) {
                    var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
                    var user = {
                        username: $("#username").val(),
                        password: $("#password").val(),
                        fName: $("#fName").val(),
                        lName: $("#lName").val(),
                        mobile: $("#mobile").val(),
                        email: $("#email").val(),
                        picture: filename,
                        status: $("#status").is(":checked")
                    };

                    $.ajax({
                        url: "/TopNotch/user/doRegistration",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            userData: user
                        },
                        success: function (data) {
                            $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">User Successfully Registered.</div></div>');
                            window.location = "login";
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