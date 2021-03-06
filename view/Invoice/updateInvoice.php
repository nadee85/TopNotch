
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Invoice
            <small>Adding New Invoice</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Update Invoice</li>
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
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmInvoiceUpdate" action="/TopNotch/report/invoice" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Invoice No</label>
                                        <input type="text" class="form-control" id="invoiceNo" name="txtInvNo" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select class="form-control" name="cmbCus" id="cmbCus">
                                            <option></option>
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
                                            <input type="text" class="form-control" id="dateadded" name="dateadded" required=""/>
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
                                        <select class="form-control" name="cmbItem" id="cmbItem">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" id="price" name="txtPrice">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" id="qty" name="txtQty">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" id="amount" name="txtAmount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="forceWidth" style="text-align: center">Item</th>
                                                    <th style="text-align: center"  class="forceWidth">Price</th>
                                                    <th style="text-align: center"  class="forceWidth">Quantity</th>
                                                    <th style="text-align: center" class="forceWidth">Amount</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="data"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group">
                                                    <input type="text" style="text-align: right" class="form-control" id="netAmount" name="txtNetAmount" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group text-right">
                                                    <label>Net Amount</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group">
                                                    <input type="text" style="text-align: right" class="form-control" id="discount" name="txtDiscount" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group text-right">
                                                    <label>Discount (%)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group">
                                                    <input type="text" style="text-align: right" class="form-control" id="totAmount" name="txtTotAmount" value="0">
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
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" name="submit" id="btnUpdate" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script>

    $(document).ready(function () {
        $('#dateadded').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
    });

    //Load Customer
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/customer/loadName", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<option value=" + data[a].id + ">";
                html += data[a].fname + " " + data[a].lname;
                html += "</option>";
            }
            document.getElementById("cmbCus").innerHTML += html;
        }
    };

    //Load Items
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/item/loadDescription", true);
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
            document.getElementById("cmbItem").innerHTML += html;
        }
    };

    //selling price insert
    document.getElementById('cmbItem').addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {

        }
    });

    //Qty Enter and table add
    document.getElementById('qty').addEventListener('keypress', function (event) {
        var amount = $('#price').val() * $('#qty').val();
        $('#amount').val(amount);
        if (event.keyCode == 13) {
            var l = $('#table1 tr').length;
            for (var a = 1; a <= l; a++) {
                if ($('#table1 #rid' + a).text() == $('#cmbItem').val()) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Already added to the List.</div></div>');
                    event.preventDefault();
                    return;
                }
            }
            if ($('#cmbItem').val() == "") {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Select a Raw Material to continue.</div></div>');
                event.preventDefault();
                return;
            }
            if ($('#qty').val() == "") {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Enter Quantity.</div></div>');
                event.preventDefault();
                return;
            }
            if ($('#price').val() == "") {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Enter Quantity.</div></div>');
                event.preventDefault();
                return;
            }
            var html = "";
            var price = $('#price').val();
            html += "<tr>";
            html += "<td id='rid" + l + "' hidden>" + $('#cmbItem option:selected').val() + "</td>";
            html += "<td>" + $('#cmbItem option:selected').text() + "</td>";
            html += "<td id='price" + l + "' style='text-align: right'>" + price + "</td>";
            html += "<td id='qty" + l + "' style='text-align: right'>" + $('#qty').val() + "</td>";
            html += "<td id='amount" + l + "' style='text-align: right'>" + $('#amount').val() + "</td>";
            html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
            html += "</tr>";

            document.getElementById("data").innerHTML += html;

            var totAmo = parseFloat($('#totAmount').val()) + parseFloat($('#amount').val());

            $('#netAmount').val(totAmo);
            $('#totAmount').val(totAmo);
            $('#cmbItem').val($('#cmbItem option:first').val());
            $('#price').val("");
            $('#qty').val("");
            $('#amount').val("");
            $('#cmbItem').focus();
            event.preventDefault();
        }
    });

    // delete row
    $(document).on("click", "#btnDel", function () {
        var currow = $(this).closest('tr');
        var totAmo = parseFloat($('#netAmount').val()) - parseFloat(currow.find('td:eq(4)').text());
        $('#netAmount').val(totAmo);
        var discount = ($('#netAmount').val() * $('#discount').val()) / 100;
        var totAmount = $('#netAmount').val() - discount;
        $('#totAmount').val(totAmount);
        $('#table1').find(currow).remove();
        $('#cmbItem').focus();
    });


    //Discount
    document.getElementById('discount').addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {
            var discount = ($('#netAmount').val() * $('#discount').val()) / 100;
            var totAmount = $('#netAmount').val() - discount;
            $('#totAmount').val(totAmount);
        }
    });

    //load by invNO
    $(document).ready(function () {
        var invNo = "<?php echo $_POST['txtInv']; ?>";
        $.ajax({
            url: "/TopNotch/invoice/retrieveInv",
            method: "POST",
            data: {invNo: invNo},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                var l = 1;
                $('#invoiceNo').val(data[0].id);
                $('#cmbCus option:selected').val(data[0].cusid);
                $('#cmbCus option:selected').text(data[0].fname + " " + data[0].lname);
                $('#dateadded').val(data[0].invdate);
                $('#netAmount').val(data[0].netamount);
                $('#discount').val(data[0].discount);
                $('#totAmount').val(data[0].totamount);
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td id='id" + l + "' hidden>" + data[a].itemId + "</td>";
                    html += "<td>" + data[a].description + "</td>";
                    html += "<td id='price" + l + "' style='text-align: right'>" + data[a].sellPrice + "</td>";
                    html += "<td id='qty" + l + "' style='text-align: right'>" + data[a].qty + "</td>";
                    html += "<td id='amount" + l + "' style='text-align: right'>" + data[a].amount + "</td>";
                    html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
                    html += "</tr>";
                    l++;
                }
                document.getElementById("data").innerHTML += html;
            }
        });
    });

    //Update
    $(document).ready(function () {
        $("#frmInvoiceUpdate").validate({
            rules: {
                dateadded: {
                    required: true
                },
                cmbCus: {
                    required: true
                },
                totAmount: {
                    required: true
                }
            }
        });

        function storeTableValues() {
            var TableData = new Array();

            $('#table1 tr').each(function (row, tr) {
                TableData[row] = {
                    "itemId": $(tr).find('td:eq(0)').text(),
                    "price": $(tr).find('td:eq(2)').text(),
                    "qty": $(tr).find('td:eq(3)').text(),
                    "amount": $(tr).find('td:eq(4)').text()
                }
            });
            return TableData;
        }

        $(document).on("click", "#btnUpdate", function () {
            $("#frmInvoiceUpdate").validate();
            if ($("#frmInvoiceUpdate").valid()) {
                var l = $('#table1 tr').length;
                if (l <= 1) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Must Enter Raw Material Details.</div></div>');
                    return;
                }

                var TableData = JSON.stringify(storeTableValues());

                var invoice = {
                    id: $("#invoiceNo").val(),
                    cusId: $("#cmbCus").val(),
                    invDate: $("#dateadded").val(),
                    netAmount: $("#netAmount").val(),
                    discount: $("#discount").val(),
                    totAmount: $("#totAmount").val(),
                    tableData: TableData
                };

                $.ajax({
                    url: "/TopNotch/invoice/invoiceUpdate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        invData: invoice
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Invoice Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
//                        window.location = "/TopNotch/invoice/invoiceList";
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
    });
</script>
