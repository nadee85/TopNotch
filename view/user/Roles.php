<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Role Form
            <small>New Role</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">New Role</li>
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
                    <form id="frmRole">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNIC">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description" required="">
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
        $("#frmRole").validate({
            rules: {
                description: {required: true}
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmRole").validate();
            if ($("#frmRole").valid()) {
                var roles = {
                    description: $("#description").val(),
                };
                $.ajax({
                    url: "/TopNotch/user/addRole",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        roleData: roles
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">New Role Successfully Added.</div></div>');
                        $(frmRole).closest('form').find("input[type=text]").val("");
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
