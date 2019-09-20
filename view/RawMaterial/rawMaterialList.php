<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raw Material List
            <small>View Manage Raw Material Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Raw Material List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Raw Materials</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmRawMaterialList">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <input type="hidden" name="page" value="<?php // echo $pageNo;   ?>">

                                    <div class="form-group">
                                        <label for="inputCusid">Raw Material Id </label>
                                        <input type="text" class="form-control" id="rMaterialId" placeholder="Enter Raw Material Id " name="txtRMaterialId">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCusfname">Description</label>
                                        <input type="text" class="form-control" id="description" placeholder="Enter Description" name="txtDescription">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <input type="hidden" id="stock" name="txtStock">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mandatory" id="mandatory"> Mandatory
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
                        <h3 class="box-title">Raw Material List</h3>
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
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;   ?> to <?php // echo $endNo * $resultsPerPage;   ?> of <?php // echo $resultsFound;   ?> entries</div>
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
                                                <a href="<?php // echo $url . "page=" . $i   ?>" ><?php // echo $i;   ?></a>
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
                                    <th>Raw Material Id</th>
                                    <th>Description </th>
                                    <th>Current Stock </th>
                                    <th>Status </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
                        </table>
                        <div class="pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;   ?> to <?php // echo $endNo * $resultsPerPage;   ?> of <?php // echo $resultsFound;   ?> entries</div>
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
                                                <a href="<?php // echo $url . "page=" . $i   ?>" ><?php // echo $i;   ?></a>
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
    ajax.open("GET", "/TopNotch/rawmaterial/loadRawMaterials", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].id + "</td>";
                html += "<td>" + data[a].description + "</td>";
                html += "<td>" + data[a].curStock + "</td>";
                if (data[a].mandatory == 1) {
                    html += "<td><span class='label label-success'>Mandatory</span></td>";
                } else {
                    html += "<td><span class='label label-danger'>Optional</span></td>";
                }
                html += "<td><buttin type='button' id='btnView' class='btn btn-info btn-xs'>View</button></td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
        }
    };

    $('#description').keypress(function () {
        var description = $('#description').val();
        $.ajax({
            url: "/TopNotch/rawmaterial/loadByName",
            method: "POST",
            data: {description: description},
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('#data').empty();
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td>" + data[a].id + "</td>";
                    html += "<td>" + data[a].description + "</td>";
                    html += "<td>" + data[a].curStock + "</td>";
                    if (data[a].mandatory == 1) {
                        html += "<td><span class='label label-success'>Mandatory</span></td>";
                    } else {
                        html += "<td><span class='label label-danger'>Optional</span></td>";
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
        $("#rMaterialId").val(currow.find('td:eq(0)').text());
        $("#description").val(currow.find('td:eq(1)').text());
        $("#stock").val(currow.find('td:eq(2)').text());
        if (currow.find('td:eq(4)').text() === "Mandatory") {
            $("#mandatory").prop("checked", true);
        } else {
            $("#mandatory").prop("checked", false);
        }
    })

    $(document).ready(function () {
        $(document).on("click", "#btnUpdate", function () {
            var rawMaterial = {
                id: $("#rMaterialId").val(),
                description: $("#description").val(),
                stock: $("#stock").val(),
                mandatory: $("#mandatory").is(":checked")
            };

            $.ajax({
                url: "/TopNotch/rawmaterial/updateRawMaterial",
                type: "POST",
                dataType: "JSON",
                data: {
                    rawData: rawMaterial
                },
                success: function (data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Raw Material Successfully Updated.</div></div>');
//                        alert("Successfully registered!");
                    console.log(data);
                    $(frmRawMaterialList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                    alert(textStatus);
                    console.log(errorThrown);
                }
            });
        });
    });
</script>