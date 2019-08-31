
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Invoice
            <small>Adding New Invoice</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Add Invoice</li>
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
                    <form role="form" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);        ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Invoice No</label>
                                        <input type="text" class="form-control" id="invoiceNo" name="txtInvNo" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select class="form-control" name="cmbCus">
                                            <option>Select Customer</option>
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
                                        <label>Price</label>
                                        <input type="text" class="form-control" id="price" name="txtPrice" required="">
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
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" id="amount" name="txtAmount" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="forceWidth">Item</th>
                                                    <th class="forceWidth">Price</th>
                                                    <th class="forceWidth">Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3 pull-right">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="totAmount" name="txtTotAmount">
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <div class="form-group text-right">
                                            <label>Total Amount</label>
                                        </div>
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
