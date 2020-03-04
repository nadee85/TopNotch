<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User List
            <small>View Manage User Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">User List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Users</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form role="form" id="frmUserList">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputFname">User Name</label>
                                            <input type="text" class="form-control" id="username" placeholder="Enter User Id" name="username" required="" disabled="">
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
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--<button type="submit" name="submitsave" id="btnRegister" class="btn btn-primary">Register</button>-->
                                        <input type="button" class="btn btn-primary" id="btnRegister" value="Update"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->                        
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">          
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User Id </th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th></th>
                                    <!--<th></th>-->
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
                        </table>                   
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/user/loadUsers", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td><img src=<?= RESOURCES ?>dist/img/" + data[0].Picture + " class='user-image' \n\
            alt='User Image' style='width:40px; height: 40px'/></td>";
                html += "<td>" + data[a].UserId + "</td>";
                html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
                html += "<td>" + data[a].mobile + "</td>";
                html += "<td>" + data[a].email + "</td>";
                if (data[a].status == 1) {
                    html += "<td><span class='label label-success'>Active</span></td>";
                } else {
                    html += "<td><span class='label label-danger'>Inactive</span></td>";
                }
                html += "<td><buttin type='button' id='btnView' class='btn btn-info btn-xs'>View</button></td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
            $('#table1').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        }
    };

    $('table tbody').on('click', '.btn', function () {
        var currow = $(this).closest('tr');
        var userName = currow.find('td:eq(2)').text().split(" ");
        $("#username").val(currow.find('td:eq(1)').text());
        $("#fName").val(userName[0]);
        $("#lName").val(userName[1]);
        $("#mobile").val(currow.find('td:eq(3)').text());
        $("#email").val(currow.find('td:eq(4)').text());
        if (currow.find('td:eq(5)').text() === "Active") {
            $("#status").prop("checked", true);
        } else {
            $("#status").prop("checked", false);
        }
    })

    $(document).ready(function () {
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
                    }
                },
                messages: {
                    username: {
                        remote: "Username is already taken!"
                    }
                }
            });

            $(document).on("click", "#btnRegister", function () {
                $("#frmUserList").validate();
                if ($("#frmUserList").valid()) {
                    var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
                    var user = {
                        username: $("#username").val(),
                        fName: $("#fName").val(),
                        lName: $("#lName").val(),
                        mobile: $("#mobile").val(),
                        email: $("#email").val(),
                        picture: filename
                    };

                    $.ajax({
                        url: "/TopNotch/user/updateUser",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            userData: user
                        },
                        success: function (data) {
                            $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">User Successfully Updated.</div></div>');
                            $(frmUserList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
//                            window.location="/TopNotch/user/UserActivate";
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
    });
</script>