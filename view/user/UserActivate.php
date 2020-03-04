<body class="skin-blue">
    <header class="main-header">
        <a class="navbar-brand"><img src="<?= RESOURCES ?>dist/logo1.png" width="150" height="75"></a>
    </header>
    <aside class="main-sidebar">
    </aside>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Activation
            </h1>
            <!--        <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Users</a></li>
                        <li class="active">New Role</li>
                    </ol>-->
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
                        <form id="frmActivate" action="login" method="POST">
                            <div class="box-body">
                                <input type="hidden" class="form-control" id="username"  name="username" >

                                <div class="form-group">
                                    <label for="inputNIC">Activation Code</label>
                                    <input type="text" class="form-control" id="actCode" placeholder="Enter Activation Code" name="actCode" required="">
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" name="submitsave" id="btnSave" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div><!-- /.box -->

                </div><!--/.col (left) -->

            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <script>
        $(document).ready(function () {
            $("#frmActivate").validate({
                rules: {
                    actCode: {
                        required: true,
                        remote: {
                            url: "/TopNotch/user/checkCode",
                            type: "POST",
                            data: {
                                actCode: function () {
                                    return $("#actCode").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    actCode: {
                        remote: "Invalied Activation Code!"
                    }
                }
            });

            $(document).on("click", "#btnSave", function () {
                $("#frmActivate").validate();
                if ($("#frmActivate").valid()) {
                    var code = {
                        username: $("#username").val(),
                        actCode: $("#actCode").val()
                    };
                    $.ajax({
                        url: "/TopNotch/user/activate",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            actData: code
                        },
                        success: function (data) {
                            $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">New Role Successfully Added.</div></div>');
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


        $(document).ready(function () {
            var username = "<?php echo $_POST['username']; ?>";
            $('#username').val(username);
        });
    </script>
