<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Supplier Due Payment List
            <small>View Manage Supplier Due Payments </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Supplier Due Payments</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Supplier Due Payment</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>From</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="dateFrom"/>
                                                </div><!-- /.input group -->
                                            </div><!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>To</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="dateTo"/>
                                                </div><!-- /.input group -->
                                            </div><!-- /.form group -->
                                        </div>
                                    </div>
                                </div><!--md-->
                            </div>
                        </div><!--row-->
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->                        
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Supplier Payment Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form id="frmSupDuePayList" action="newSupplierPayment" method="POST">
                            <input type="hidden" name="txtGRNNo" id="grnNo"> 
                            <table id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>GRN No</th>
                                        <th>Supplier</th>
                                        <th>Date Added</th>
                                        <th>GRN Amount</th>
                                        <th>Total Paid</th>
                                        <th>Balance Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    //date range
    $(function () {
        $('#dateFrom').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
        $('#dateTo').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
    });
    
    //load list
    $(document).ready(function () {
        loadList();
    });

    function loadList() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/supplier/loadSupDuePayments", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                var upPage = "";
                dataList(data);
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
    }

    function dataList(data) {
        var html = "";
        for (var a = 0; a < data.length; a++) {
            html += "<tr>";
            html += "<td>" + data[a].id + "</td>";
            html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
            html += "<td>" + data[a].grnDate + "</td>";
            html += "<td>" + data[a].grnAmount + "</td>";
            html += "<td>" + data[a].totalPaid + "</td>";
            html += "<td>" + data[a].balAmount + "</td>";
            html += "<td><input type='submit' id='btnPay' class='btn btn-success btn-xs'value='Pay'>";
            html += "</tr>";
        }
        document.getElementById("data").innerHTML += html;
    }
    
    //view Invoice
    $('table tbody').on("click", "#btnPay", function () {
        var currow = $(this).closest('tr');
        $("#invNo").val(currow.find('td:eq(0)').text());
    });
</script>