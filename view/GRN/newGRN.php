
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New GRN
            <small>Adding New GRN</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Add GRN</li>
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
                    <form id="frmGRN">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>GRN No</label>
                                        <input type="text" class="form-control" id="grnNo" name="txtGRNNo" required="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="cmbSup" id="cmbSup" required="">
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
                                        <select class="form-control" name="cmbRItem" id="cmbRItem">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" id="price" name="txtPrice" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" id="qty" name="txtQty" >
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
                            <div class="col-md-9">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="forceWidth" style="text-align: center">Raw Material</th>
                                                    <th style="text-align: center">Price</th>
                                                    <th style="text-align: center">Quantity</th>
                                                    <th style="text-align: center">Amount</th>
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
                                                    <input type="text" style="text-align: right" class="form-control" id="totAmount" name="txtTotAmount" required="" value="0">
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
    //Load GRN Numbers
    function grnNo() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/grn/loadGRNNo", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
//                $('#grnNo').val("GRN" + new Intl.NumberFormat('en-IN', {minimumIntegerDigits: 3}).format(parseInt(data[0].id) + 1));
                $('#grnNo').val("GRN" + (parseInt(data[0].id)+1).toString().padStart(4,"0"));
            }
        };
    }

    $(document).ready(function () {
        grnNo();
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

    //Load Raw Materials
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/rawMaterial/loadDescription", true);
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
            document.getElementById("cmbRItem").innerHTML += html;
        }
    };

    //Qty Enter and table add
    document.getElementById('qty').addEventListener('keypress', function (event) {
        var amount = $('#price').val() * $('#qty').val();
        $('#amount').val(amount);
        if (event.keyCode == 13) {
            var l = $('#table1 tr').length;
            for (var a = 1; a <= l; a++) {
                if ($('#table1 #rid' + a).text() == $('#cmbRItem').val()) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Already added to the List.</div></div>');
                    event.preventDefault();
                    return;
                }
            }
            if ($('#cmbRItem').val() == "") {
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
            var price=$('#price').val();
            html += "<tr>";
            html += "<td id='rid" + l + "' hidden>" + $('#cmbRItem option:selected').val() + "</td>";
            html += "<td>" + $('#cmbRItem option:selected').text() + "</td>";
            html += "<td id='price" + l + "' style='text-align: right'>" + price + "</td>";
            html += "<td id='qty" + l + "' style='text-align: right'>" + $('#qty').val() + "</td>";
            html += "<td id='amount" + l + "' style='text-align: right'>" + $('#amount').val() + "</td>";
            html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
            html += "</tr>";

            document.getElementById("data").innerHTML += html;

            var totAmo = parseFloat($('#totAmount').val()) + parseFloat($('#amount').val());

            $('#totAmount').val(totAmo);
            $('#cmbRItem').val($('#cmbRItem option:first').val());
            $('#price').val("");
            $('#qty').val("");
            $('#amount').val("");
            $('#cmbRItem').focus();
            event.preventDefault();
        }
    });
    
    // delete row
    $(document).on("click", "#btnDel", function () {
        var currow = $(this).closest('tr');
        var totAmo=parseFloat($('#totAmount').val())-parseFloat(currow.find('td:eq(4)').text());
        $('#totAmount').val(totAmo);
        $('#table1').find(currow).remove();
        $('#cmbRItem').focus();
    });

    //Save
    $(document).ready(function () {
        $("#frmGRN").validate({
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
                    "rItemId": $(tr).find('td:eq(0)').text(),
                    "price": $(tr).find('td:eq(2)').text(),
                    "qty": $(tr).find('td:eq(3)').text(),
                    "amount": $(tr).find('td:eq(4)').text()
                }
            });
            return TableData;
        }

        $(document).on("click", "#btnSave", function () {
            $("#frmGRN").validate();
            if ($("#frmGRN").valid()) {
                var l = $('#table1 tr').length;
                if (l <= 1) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Must Enter Raw Material Details.</div></div>');
                    return;
                }

                var TableData = JSON.stringify(storeTableValues());

                var grn = {
                    id: $("#grnNo").val(),
                    supId: $("#cmbSup").val(),
                    grnDate: $("#dateadded").val(),
                    totAmount: $("#totAmount").val(),
                    tableData: TableData
                };

                $.ajax({
                    url: "/TopNotch/grn/addGRN",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        grnData: grn
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">GRN Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $('#table1').find("tr:gt(0)").remove();
                        $('#totAmount').val("");
                        grnNo();
//                        $(frmPO).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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
