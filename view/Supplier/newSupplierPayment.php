
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Supplier Payment
            <small>Adding New Supplier Payment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Supplier Payment</li>
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
                    <form id="frmSupplierPayment">
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
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script>
    function payID() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/supplier/loadSupPayNo", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
//                $('#grnNo').val("GRN" + new Intl.NumberFormat('en-IN', {minimumIntegerDigits: 3}).format(parseInt(data[0].id) + 1));
                $('#supPayId').val("SP" + (parseInt(data[0].id) + 1).toString().padStart(4, "0"));
            }
        };
    }

    $(document).ready(function () {
        payID();
        $('#dateadded').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
    });

    //Load Supplier
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/supplier/loadName", true);
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
            document.getElementById("cmbSup").innerHTML += html;
        }
    };

    //load GRN
    document.getElementById("cmbSup").addEventListener('change', function (event) {
        var supplier = $('#cmbSup').val();
        $.ajax({
            url: "/TopNotch/GRN/retrieveGRNSup",
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
    });


    document.getElementById("grnNo").addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {
            var grnNo = $('#grnNo').val();
            //get Invoice Amount
            $.ajax({
                url: "/TopNotch/GRN/retrieveGRNDet",
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
            if ($('#payAmo').val() > ($('#grnAmount').val())-$('#pAmount').val()) {
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

    //Save
    $(document).ready(function () {
        $("#frmSupplierPayment").validate({
            rules: {
                dateadded: {
                    required: true
                },
                cmbSup: {
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

        $(document).on("click", "#btnSave", function () {
            $("#frmSupplierPayment").validate();
            if ($("#frmSupplierPayment").valid()) {
//                $("#invno").val($("invoiceNo").val());
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
                    url: "/TopNotch/supplier/addSupPayment",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        supPayData: supPay
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Supplier Payment Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $('#table1').find("tr:gt(0)").remove();
                        $('#totAmount').val(0);
                        $('#cmbSup').val($('#cmbSup option:first').val());
                        payID();
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
