<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Role Form
            <small>User Role Assign</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">User Role Assign</li>
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
                    <form id="frmURole">
                        <div class="box-body">
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control" name="cmbUser" id="cmbUser">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="cmbRole" id="cmbRole">
                                    <option></option>
                                </select>
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
        $("#frmURole").validate({
            rules: {
                cmbUser: {
                    required: true,
                    remote: {
                        url: "/TopNotch/user/uRExists",
                        type: "POST",
                        data: {
                            cmbUser: function () {
                                return $("#cmbUser").val();
                            }
                        }
                    }
                },
                cmbRole: {required: true}
            },
            messages: {
                cmbUser: {
                    remote: "Username is already taken!"
                }
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmURole").validate();
            if ($("#frmURole").valid()) {
                var uRole = {
                    user: $("#cmbUser").val(),
                    role: $("#cmbRole").val()
                };
                $.ajax({
                    url: "/TopNotch/user/addURole",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        uRoleData: uRole
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">User Role Successfully Added.</div></div>');
                        $('#cmbUser').val($('#cmbUser option:first').val());
                        $('#cmbRole').val($('#cmbRole option:first').val());
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
    //Load User
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/user/loadName", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].userid + ">";
                html += data[a].fname + " " + data[a].lname;
                html += "</option>";
            }
            document.getElementById("cmbUser").innerHTML += html;
        }
    };

    //Load Role
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/user/loadRoleDes", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].description;
                html += "</option>";
            }
            document.getElementById("cmbRole").innerHTML += html;
        }
    };
</script>
