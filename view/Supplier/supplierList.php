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
                    <!-- form start -->
                    <form role="form" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>?page=<?php // echo $pageNo;  ?>" method="get" id="advform" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <input type="hidden" name="page" value="<?php // echo $pageNo;  ?>">

                                    <div class="form-group">
                                        <label for="inputCusid">Supplier Id </label>
                                        <input type="text" class="form-control" id="supid" placeholder="Enter Sup Id " name="txtCusId" value="<?php // echo $cusid;  ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCusfname">First Name</label>
                                        <input type="text" class="form-control" id="supFName" placeholder="Enter First Name" name="txtSupFName" value="<?php // echo $cusfname;  ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCuslname">Last Name</label>
                                        <input type="text" class="form-control" id="supLName" placeholder="Enter Last Name" name="txtSupLName" value="<?php // echo $cuslname;  ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputAddress">Address </label>
                                        <input type="text" class="form-control" id="address" placeholder="Enter Address " name="txtAddress" value="<?php // echo $address;  ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTelephoneno">Telephone No </label>
                                        <input type="text" class="form-control" id="telephone" placeholder="Enter Telephone No " name="txtTP" value="<?php // echo $telephoneno;  ?>" >
                                    </div>
                                    
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="status" <?php
//                                            if ($status == '1') {
//                                                echo ' checked ';
//                                            }
                                            ?> > Active Only
                                        </label>
                                    </div>
                                </div><!--box-body-->
                            </div><!--md-->
                        </div><!--row-->
                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            <button type="submit" name="submit" onclick="submitForm('CollectionScheduleReport.php')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</button>
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
                                    <?php // if ($_SESSION["userPrivilege"] == "admin") { ?><th>Customer Id </th><?php // } ?>
                                    <th>Name</th>
                                    <th>Address </th>
                                    <th>Telephone No </th>
                                    <th>Status </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                try {
//                                    $con = connect_database();
//                                    $sql = "SELECT `customer`.*, `shop`.`ShopName`  FROM `customer` INNER JOIN `shop` ON `customer`.`ShopId`=`shop`.`ShopId` WHERE " . $query;
//                                    $result = $con->query($sql);
//                                    if ($result->num_rows > 0) {
//                                        $currentNo = 0;
//                                        while ($row = $result->fetch_assoc()) {
//                                            if ($currentNo >= ($pageNo - 1) * $resultsPerPage && $currentNo < $pageNo * $resultsPerPage) {
//                                                $statusIndc = "<span class=\"label label-danger\">Disabled</span>";
//                                                if ($row["Status"] == 1) {
//                                                    $statusIndc = "<span class=\"label label-success\">Enabled</span>";
//                                                }
//
//                                                echo '<tr>';
//                                                if ($row["Picture"] != NULL && !empty($row["Picture"])) {
//                                                    echo '<td><img class="direct-chat-img" src="dist/img/' . $row["Picture"] . '" alt=""></td>';
//                                                } else {
//                                                    echo '<td><img class="direct-chat-img" src="dist/default-profile.png" alt=""></td>';
//                                                }
//                                                if ($_SESSION["userPrivilege"] == "admin") {
//                                                    echo '<td>' . $row["CusId"] . '</td>';
//                                                }
//                                                echo '<td>' . $row["CusFname"] . " " . $row["CusLname"] . '</td>';
//                                                echo '<td>' . $row["Address"] . '</td>';
//                                                echo '<td>' . $row["TelephoneNo"] . '</td>';
//                                                echo '<td>' . $row["NIC"] . '</td>';
//                                                echo '<td>' . $row["ShopName"] . '</td>';
//                                                echo '<td>' . $statusIndc . '</td>';
                                ?>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs">Action</button>
                                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="ViewCustomer.php?cusid=<?php // echo $row["CusId"];  ?>">View</a></li>
                                        <li><a href="UpdateCustomer.php?cusid=<?php // echo $row["CusId"];  ?>">Update</a></li>
                                    </ul>
                                </div>
                            </td>
                            <?php
//                                            echo '</tr>';
//                                        }
//                                        $currentNo++;
//                                    }
//                                } else {
//                                    $errMsg = "No Items to Display.";
//                                }
//                                $con->close();
//                            } catch (Exception $exc) {
//                                $errMsg = "<br>Error description: " . $exc;
//                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php // if ($_SESSION["userPrivilege"] == "admin") { ?><th>Customer Id </th><?php // } ?>
                                    <th>Name</th>
                                    <th>Address </th>
                                    <th>Telephone No </th>
                                    <th>Status </th>
                                    <th></th>
                                </tr>
                            </tfoot>
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