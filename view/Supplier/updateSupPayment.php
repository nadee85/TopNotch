
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Supplier Payment
            <small>Update Supplier Payment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Update Supplier Payment</li>
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
                    <form id="frmUpdateSupplierPayment">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Supplier Payment Id</label>
                                        <input type="text" class="form-control" id="supPayId" name="txtSupPayId" required="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="cmbSup" id="cmbSup">
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
                                        <label>GRN No</label>
                                        <select class="form-control" name="cmbGRNNo" id="grnNo">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>GRN Amount</label>
                                        <input type="text" class="form-control" id="grnAmount" name="txtGRNAmount" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Paid Amount</label>
                                        <input type="text" class="form-control" id="pAmount" name="txtPAmount" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Pay Amount</label>
                                        <input type="text" class="form-control" id="payAmo" name="txtPayAmo">
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
                                                    <th class="forceWidth" style="text-align: center">GRN No</th>
                                                    <th style="text-align: center">GRN Amount</th>
                                                    <th style="text-align: center">Paid Amount</th>
                                                    <th style="text-align: center">Pay Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3 pull-right">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="totAmount" name="txtTotAmount" required="" disabled value="0">
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
                            <input type="button" name="submit" id="btnUpdate" class="btn btn-primary" value="Submit">
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

    document.getElementById("grnNo").addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {
            var grnNo = $('#grnNo').val();
            //get Invoice Amount
            $.ajax({
                url: "/TopNotch/grn/retrieveGRNDet",
                method: "POST",
                data: {sData: grnNo},
                dataType: "JSON",
                success: function (data) {
                    $('#grnAmount').text("");
                    $('#pAmount').text("");
                    var html = "";
                    console.log(data);
                    $('#grnAmount').val(data[0].totalamount);
                    $('#pAmount').val(data[0].totalpaid);
                    $('#payAmo').focus();
                }
            });
        }
    });

    document.getElementById('payAmo').addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {
            $("#err").empty();
            var l = $('#table1 tr').length;
            for (var a = 1; a <= l; a++) {
                if ($('#table1 #grnNo' + a).text() == $('#grnNo').val()) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Already added to the List.</div></div>');
                    event.preventDefault();
                    return;
                }
            }
            if ($('#grnNo').val() == "") {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Select a GRN No to continue.</div></div>');
                event.preventDefault();
                return;
            }
            if ($('#payAmo').val() <= 0) {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Enter Valid Paying Amount.</div></div>');
                event.preventDefault();
                return;
            }
            if ($('#payAmo').val() > ($('#grnAmount').val()) - $('#pAmount').val()) {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Invalid Paying Amount.</div></div>');
                event.preventDefault();
                return;
            }
            var html = "";
            html += "<tr>";
            html += "<td id='grnNo" + l + "'>" + $('#grnNo option:selected').val() + "</td>";
            html += "<td id='grnAmo" + l + "' style='text-align: right'>" + $('#grnAmount').val() + "</td>";
            html += "<td id='paidAmo" + l + "' style='text-align: right'>" + $('#pAmount').val() + "</td>";
            html += "<td id='payAmo" + l + "' style='text-align: right'>" + $('#payAmo').val() + "</td>";
            html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
            html += "</tr>";

            document.getElementById("data").innerHTML += html;

            var totAmo = parseFloat($('#totAmount').val()) + parseFloat($('#payAmo').val());

            $('#totAmount').val(totAmo);
            $('#grnNo').val($('#grnNo option:first').val());
            $('#grnAmount').val("");
            $('#pAmount').val("");
            $('#payAmo').val("");
            $('#grnNo').focus();
            event.preventDefault();
        }
    });

    // delete row
    $(document).on("click", "#btnDel", function () {
        var currow = $(this).closest('tr');
        var totAmo = parseFloat($('#totAmount').val()) - parseFloat(currow.find('td:eq(3)').text());
        $('#totAmount').val(totAmo);
        $('#table1').find(currow).remove();
        $('#grnNo').focus();
    });

    //load by cusPayNo
    $(document).ready(function () {
        var supPayNo = "<?php echo $_POST['txtSupPayId']; ?>";
        $.ajax({
            url: "/TopNotch/supplier/retrieveSupPay",
            method: "POST",
            data: {supPayNo: supPayNo},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                var l = 1;
                $('#supPayId').val(data[0].id);
                $('#cmbSup option:selected').val(data[0].supid);
                $('#cmbSup option:selected').text(data[0].fname + " " + data[0].lname);
                $('#dateadded').val(data[0].paydate);
                $('#totAmount').val(data[0].totalamount);
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td id='grnNo" + l + "'>" + data[a].grnNo + "</td>";
                    html += "<td id='grnAmount" + l + "' style='text-align: right'>" + data[a].grnAmount + "</td>";
                    html += "<td id='paidAmo" + l + "' style='text-align: right'>" + data[a].paidAmount + "</td>";
                    html += "<td id='payAmo" + l + "' style='text-align: right'>" + data[a].payAmount + "</td>";
                    html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
                    html += "</tr>";
                    l++;
                }
                document.getElementById("data").innerHTML += html;

                var supplier = $('#cmbSup').val();
                $.ajax({
                    url: "/TopNotch/grn/retrieveGRNSup",
                    method: "POST",
                    data: {sData: supplier},
                    dataType: "JSON",
                    success: function (data) {
                        $('#grnNo').empty();
                        $('#grnAmount').val("");
                        $('#pAmount').val("");
                        console.log(data);
                        var html = "";
                        html += "<option></option>";
                        for (var a = 0; a < data.length; a++) {
                            html += "<option>";
                            html += data[a].id;
                            html += "</option>";
                        }
                        document.getElementById("grnNo").innerHTML += html;
                    }
                });
            }
        });
    });

    //Update
    $(document).ready(function () {
        $("#frmUpdateSupplierPayment").validate({
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
                    "grnNo": $(tr).find('td:eq(0)').text(),
                    "grnAmo": $(tr).find('td:eq(1)').text(),
                    "paidAmo": $(tr).find('td:eq(2)').text(),
                    "payAmo": $(tr).find('td:eq(3)').text()
                }
            });
            return TableData;
        }

        $(document).on("click", "#btnUpdate", function () {
            $("#frmUpdateSupplierPayment").validate();
            if ($("#frmUpdateSupplierPayment").valid()) {
                var l = $('#table1 tr').length;
                if (l <= 1) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Must Enter GRN Details.</div></div>');
                    return;
                }

                var TableData = JSON.stringify(storeTableValues());

                var supPay = {
                    id: $("#supPayId").val(),
                    supId: $("#cmbSup").val(),
                    supPayDate: $("#dateadded").val(),
                    totAmount: $("#totAmount").val(),
                    tableData: TableData
                };

                $.ajax({
                    url: "/TopNotch/supplier/supplierPaymentUpdate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        supPayData: supPay
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Supplier Payment Successfully Updated.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        window.location = "/TopNotch/supplier/supplierPaymentList";
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
