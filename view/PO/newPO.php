
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Purchase Order
            <small>Adding New Purchase Order</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Add Purchase Order</li>
        </ol>
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
                    <?php
//                    if ($errMsg != null) {
                    ?>
                    <div class="box box-solid box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Error!</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php // echo $errMsg; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <?php
//                    }
                    ?>
                    <?php
//                    if ($successMsg != null) {
                    ?>
                    <div class="box box-solid box-success">
                        <div class="box-header">
                            <h3 class="box-title">Success!</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php // echo $successMsg; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <?php
//                    }
                    ?>
                    <!-- form start -->
                    <form role="form" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);           ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>PO No</label>
                                        <input type="text" class="form-control" id="poNo" name="txtPONo" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="cmbSup">
                                            <option>Select Supplier</option>
                                            <?php
//                                            try {
//                                                $con = connect_database();
//                                                $sql = "SELECT * FROM `supplier` WHERE `ShopId` = '" . $shopId . "';";
//                                                //echo $sql;
//                                                $result = $con->query($sql);
//                                                if ($result->num_rows > 0) {
//                                                    while ($row = $result->fetch_assoc()) {
//                                                        echo '<option value="' . $row["SupId"] . '" >' . $row["SupName"] . '</option>';
//                                                    }
//                                                } else {
//                                                    $errMsg = "No Items to Display.";
//                                                }
//                                                $con->close();
//                                            } catch (Exception $exc) {
//                                                $errMsg = "<br>Error description: " . $exc;
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!--md-->
                            <div class="col-md-6">
                                <div class="box-body">

                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group">
                                        <label>Date Added </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask name="dateadded"/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div><!--md-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Item</label>
                                        <select class="form-control" name="cmbItem" id="item">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" id="qty" name="txtQty" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="forceWidth">Item</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script>
    document.getElementById('qty').addEventListener('keypress', function (event) {
        if (event.keyCode == 13){
        alert("OK");
                var rows = "";
                rows += "<tr><td>" + $(#item).val() + "</td><td>" + $(#size).val() + "</td><td>" + $(#price).val()
                + "</td><td>" + $(#qty).val() + "</td></tr>";
                $(rows).appendTo(#table1 tbody);
                event.preventDefault();
        }
    });

</script>
