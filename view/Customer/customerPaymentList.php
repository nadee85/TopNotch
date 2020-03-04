<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Payment List
            <small>View Manage Customer Payment Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Customer Payments</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search Customer Payment</h3>
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
                        <h3 class="box-title">Customer Payment Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form id="frmCusPayList" action="updateCusPayment" method="POST">
                            <input type="hidden" name="txtCusPayId" id="cuspayid"> 
                            <table id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Customer Payment No</th>
                                        <th>Customer</th>
                                        <th>Date Added</th>
                                        <th>Total Amount</th>
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
        ajax.open("GET", "/TopNotch/customer/loadCusPayments", true);
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
            html += "<td>" + data[a].paydate + "</td>";
            html += "<td>" + data[a].totamount + "</td>";
            html += "<td><input type='submit' id='btnView' class='btn btn-success btn-xs'value='View'>\n\
            <button type='button' class='btn btn-danger btn-xs' id='btnDel'>Delete</button></td>";
            html += "</tr>";
        }
        document.getElementById("data").innerHTML += html;
    }
    
    //view Invoice
    $('table tbody').on("click", "#btnView", function () {
        var currow = $(this).closest('tr');
        $("#cuspayid").val(currow.find('td:eq(0)').text());
    });
    
     //delete Invoice
    $('table tbody').on("click", "#btnDel", function () {
        if (confirm("Are you sure you want to delete this record?")) {
            var currow = $(this).closest('tr');
            var id = currow.find('td:eq(0)').text();
            $.ajax({
                url: "/TopNotch/customer/deleteCusPay",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function (data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">GRN Successfully Deleted.</div></div>');
//                        alert("Successfully registered!");
                    $('#table1').find("tr:gt(0)").remove();
                    loadList();
                    console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                    console.log(errorThrown);
                }
            });
        }
    });
</script>