<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-gears"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Manufacture</span>
                        <span class="info-box-number" id="man"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sales (Rs)</span>
                        <span class="info-box-number" id="sales"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Customer Payments(Rs)</span>
                        <span class="info-box-number" id="cuspay"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">GRNs (Rs)</span>
                        <span class="info-box-number" id="grn"></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>Sales and Payments for the Month of <?php echo date('F') . ", " . date('Y'); ?></strong>
                                </p>
                                <!-- Donut chart -->
                                <div class="box-body">
                                    <div id="donut-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header" id="invoice"></h5>
                                    <span class="description-text">TOTAL SALES</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header" id="totPaid"></h5>
                                    <span class="description-text">TOTAL PAID</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header" id="dueAmo"></h5>
                                    <span class="description-text">TOTAL DUE</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <div class="info-box bg-aqua-active">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Inventory</span>
                        <span class="info-box-number" id="inventory"></span>
                        <!--                        <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    50% Increase in 30 Days
                                                </span>-->
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                <div class="info-box bg-green-active">
                    <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" >Customers</span>
                        <span class="info-box-number" id="cus"></span>
                        <!--                        <div class="progress">
                                                    <div class="progress-bar" style="width: 20%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    20% Increase in 30 Days
                                                </span>-->
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                <div class="info-box bg-yellow-active">
                    <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Suppliers</span>
                        <span class="info-box-number" id="sup"></span>
                        <!--                        <div class="progress">
                                                    <div class="progress-bar" style="width: 70%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    70% Increase in 30 Days
                                                </span>-->
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->

            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- quick email widget -->
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">Quick Email</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div><!-- /. tools -->
            </div>
            <div class="box-body">
                <div id="err"></div>
                <form id="sendmail">
                    <div class="form-group">
                        <input type="email" class="form-control" name="emailto" id="emailto" placeholder="Email to:" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required/>
                    </div>
                    <div>
                        <textarea class="textarea" placeholder="Message" id="message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="box-footer clearfix">
                <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    //sales
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/invoice/totalInvoice", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].totamount == null) {
                    $("#sales").text(0);
                } else {
                    $("#sales").text(data[0].totamount);
                }
                
            }
        };
    });
    //Manufacture
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/manufacture/totalManufacture", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].qty == null) {
                    $("#man").text(0);
                } else {
                    $("#man").text(data[0].qty);
                }
            }
        };
    });
    //customer payments
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/customer/loadTotalPayment", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].totamount == null) {
                    $("#cuspay").text(0);
                } else {
                    $("#cuspay").text(data[0].totamount);
                }
            }
        };
    });
    //GRNs
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/grn/totalGRN", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].totamount == null) {
                    $("#grn").text(0);
                } else {
                    $("#grn").text(data[0].totamount);
                }
            }
        };
    });
    //Inventory
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/item/totalStock", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].stock == null) {
                    $("#inventory").text(0);
                } else {
                    $("#inventory").text(data[0].stock);
                }
            }
        };
    });
    //customer
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/customer/totalCus", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].totCus == null) {
                    $("#cus").text(0);
                } else {
                    $("#cus").text(data[0].totCus);
                }
            }
        };
    });
    //supplier
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/supplier/totalSup", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                if (data[0].totSup == null) {
                    $("#sup").text(0);
                } else {
                    $("#sup").text(data[0].totSup);
                }
            }
        };
    });
    
    //chart
    $(document).ready(function () {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/invoice/invoicePayments", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            $invAmount = 0;
            $totPaid = 0;
            $dueAmount = 0;
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                if (data[0].invAmount != null) {
                    $invAmount=data[0].invAmount;
                }
                if (data[0].totpaid != null) {
                    $totPaid=data[0].totpaid;
                }
                if (data[0].dueamount != null) {
                    $dueAmount=data[0].dueamount;
                }
                $('#invoice').text("Rs. " + $invAmount + ".00");
                $('#totPaid').text("Rs. " + $totPaid + ".00");
                $('#dueAmo').text("Rs. " + $dueAmount + ".00");
                console.log(data);
                var donutData = [
//                    {label: "Invoice", data: $invAmount, color: "#00a7d0"},
                    {label: "Total Paid", data: $totPaid, color: "#00a7d0"},
                    {label: "Due Amount", data: $dueAmount, color: "#d33724"}
                ];
                $.plot("#donut-chart", donutData, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            innerRadius: 0.4,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: labelFormatter,
                                threshold: 0.1
                            }
                            
                        }
                    },
                    legend: {
                        show: true
                    }
                });
            }
        };
        
    });
    
    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
    }
    
    
    $(document).ready(function () {
//        $("#sendmail").validate({
//            rules: {
//                emailto: {
//                    required: true,
//                    pattern: /^[a-zA-Z0-9_\.]{3,}@([a-zA-Z0-9_]{3,})(\.[a-zA-Z0-9\_]{2,})+$/
//                }
//            }
//        });
        
        $(document).on("click", "#sendEmail", function () {
//            $("#sendmail").validate();
//            if ($("#sendmail").valid()) {
            var sendmail = {
                emailto: $("#emailto").val(),
                subject: $("#subject").val(),
                message: $("#message").val()
            };
            
            $.ajax({
                url: "/TopNotch/home/sendMail",
                type: "POST",
                dataType: "JSON",
                data: {
                    mailData: sendmail
                },
                success: function (data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Email Successfully Sent.</div></div>');
//                        alert("Successfully registered!");
                    console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
//                        alert(textStatus);
                    console.log(errorThrown);
                }
            });
//            }
        });
    });
</script>