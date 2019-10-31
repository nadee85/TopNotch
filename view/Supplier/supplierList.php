<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Supplier List
            <small>View Manage Supplier Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Supplier List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Supplier</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmSupList">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <input type="hidden" name="page" value="<?php // echo $pageNo;  ?>">

                                    <div class="form-group">
                                        <label for="inputCusid">Supplier Id </label>
                                        <input type="text" class="form-control" id="supId" placeholder="Enter Sup Id " name="supId" value="<?php // echo $cusid;  ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCusfname">First Name</label>
                                        <input type="text" class="form-control" id="supFName" placeholder="Enter First Name" name="txtSupFName" value="<?php // echo $cusfname;  ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCuslname">Last Name</label>
                                        <input type="text" class="form-control" id="supLName" placeholder="Enter Last Name" name="txtSupLName" value="<?php // echo $cuslname;  ?>" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputAddress">Address </label>
                                        <textarea class="form-control" rows="3" id="address" placeholder="Enter ..." name="txtAddress"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputTelephoneno">Telephone No </label>
                                        <input type="text" class="form-control" id="telephone" placeholder="Enter Telephone No " name="txtTP" value="<?php // echo $telephoneno;  ?>" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputNic">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="txtMobile" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputNic">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter Email" name="txtEmail" >
                                    </div>
                                    
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="status" id="status"> Active Only
                                        </label>
                                    </div>
                                </div><!--box-body-->
                            </div><!--md-->
                        </div><!--row-->
                        <div class="box-footer">
                            <!--<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>-->
                            <input type="button" class="btn btn-primary" id="btnUpdate" value="Update"/>
                            <!--<button type="submit" name="submit" onclick="submitForm('CollectionScheduleReport.php')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</button>-->
                            <script>
                                function submitForm(action) {
                                    $("#advform").attr("action", action);
                                    $("#advform").submit();
                                }
                            </script>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->                        
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Supplier List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="pane">
                            <?php
//                            try {
//                                $con = connect_database();
//                                $sql = "SELECT COUNT(0) AS cnt FROM `customer` INNER JOIN `shop` ON `customer`.`ShopId`=`shop`.`ShopId` WHERE " . $query;
//                                $result = $con->query($sql);
//                                if ($result->num_rows > 0) {
//                                    while ($row = $result->fetch_assoc()) {
//                                        $resultsFound = $row['cnt'];
//                                    }
//                                } else {
//                                    
//                                }
//                                $con->close();
//                            } catch (Exception $exc) {
//                                echo "<br>Error description: " . $exc;
//                            }
//                            $startNo = 1;
//                            $endNo = 1;
//                            if ($resultsFound > $resultsPerPage) {
//                                if ($resultsFound % $resultsPerPage > 0) {
//                                    $endNo = ($resultsFound / $resultsPerPage) + 1;
//                                } else {
//                                    $endNo = $resultsFound / $resultsPerPage;
//                                }
//                            }
                            ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;  ?> to <?php // echo $endNo * $resultsPerPage;  ?> of <?php // echo $resultsFound;  ?> entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_bootstrap">
                                        <ul class="pagination">
                                            <li class="prev"><a href="#">← Previous</a></li>
                                            <?php
//                                            for ($i = $startNo; $i <= $endNo; $i++) {
                                            ?>
                                            <li <?php
//                                                if ($i == $pageNo) {
//                                                    echo"class=\"active\"";
//                                                } else {
//                                                    echo "";
//                                                }
                                            ?>>
                                                <a href="<?php // echo $url . "page=" . $i  ?>" ><?php // echo $i;  ?></a>
                                            </li>
                                            <?php
//                                            }
                                            ?>
                                            <li class="next"><a href="#">Next → </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                                    
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Supplier Id </th>
                                    <th>Name</th>
                                    <th>Address </th>
                                    <th>Telephone No </th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
                        </table>
                        <div class="pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;  ?> to <?php // echo $endNo * $resultsPerPage;  ?> of <?php // echo $resultsFound;  ?> entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_bootstrap">
                                        <ul class="pagination">
                                            <li class="prev"><a href="#">← Previous</a></li>
                                            <?php
//                                            for ($i = $startNo; $i <= $endNo; $i++) {
                                            ?>
                                            <li <?php
//                                                if ($i == $pageNo) {
//                                                    echo"class=\"active\"";
//                                                } else {
//                                                    echo "";
//                                                }
                                            ?>>
                                                <a href="<?php // echo $url . "page=" . $i  ?>" ><?php // echo $i;  ?></a>
                                            </li>
                                            <?php
//                                            }
                                            ?>
                                            <li class="next"><a href="#">Next → </a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                                
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/supplier/loadSuppliers", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].id + "</td>";
                html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
                html += "<td>" + data[a].address + "</td>";
                html += "<td>" + data[a].tp + "</td>";
                html += "<td>" + data[a].mobile + "</td>";
                html += "<td>" + data[a].email + "</td>";
                if (data[a].status == 1) {
                    html += "<td><span class='label label-success'>Active</span></td>";
                } else {
                    html += "<td><span class='label label-danger'>Inactive</span></td>";
                }
                html += "<td><button type='button' id='btnView' class='btn btn-info btn-xs'>View</button></td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
        }
    };

    $('#supFName').keypress(function () {
        var fname = $('#supFName').val();
        $.ajax({
            url: "/TopNotch/supplier/loadByName",
            method: "POST",
            data: {fname: fname},
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('#data').empty();
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
                    html += "<td>" + data[a].address + "</td>";
                    html += "<td>" + data[a].tp + "</td>";
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
            }
        });
    });

    $('table tbody').on('click', '.btn', function () {
        var currow = $(this).closest('tr');
        var supName = currow.find('td:eq(1)').text().split(" ");
        $("#supId").val(currow.find('td:eq(0)').text());
        $("#supFName").val(supName[0]);
        $("#supLName").val(supName[1]);
        $("#address").val(currow.find('td:eq(2)').text());
        $("#telephone").val(currow.find('td:eq(3)').text());
        $("#mobile").val(currow.find('td:eq(4)').text());
        $("#email").val(currow.find('td:eq(5)').text());
        if (currow.find('td:eq(6)').text() === "Active") {
            $("#status").prop("checked",true);
        } else {
            $("#status").prop("checked",false);
        }
    })

    $(document).ready(function () {
        $("#frmSupList").validate({
            rules: {
                email: {
                    required: true,
                    pattern: /^[a-zA-Z0-9_\.]{3,}@([a-zA-Z0-9_]{3,})(\.[a-zA-Z0-9\_]{2,})+$/
                }
            }
        });

        $(document).on("click", "#btnUpdate", function () {
            $("#frmSupList").validate();
            if ($("#frmSupList").valid()) {
                var supplier = {
                    supId: $("#supId").val(),
                    fName: $("#supFName").val(),
                    lName: $("#supLName").val(),
                    address: $("#address").val(),
                    telephone: $("#telephone").val(),
                    mobile: $("#mobile").val(),
                    email: $("#email").val(),
                    status: $("#status").is(":checked")
                };

                $.ajax({
                    url: "/TopNotch/supplier/updateSupplier",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        supData: supplier
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Supplier Successfully Updated.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmSupList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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