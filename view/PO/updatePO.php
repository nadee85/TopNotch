
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Purchase Order
            <small>Updating Purchase Order</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Update Purchase Order</li>
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
                    <form id="frmPOUpdate" action="/TopNotch/report/purchaseorder" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>PO No</label>
                                        <input type="text" class="form-control" id="poNo" name="txtPONo" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="cmbSup" id="cmbSup" disabled>
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
                                            <input type="text" class="form-control" id="dateadded" name="dateadded"/>
                                            <!--<input type="text" class="form-control datepicker" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask id="dateadded" name="dateadded"/>-->
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div><!--md-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Raw Material</label>
                                        <select class="form-control" name="cmbRItem" id="cmbRItem">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" id="qty" name="qty">
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
                                                    <th class="forceWidth">Raw Material</th>
                                                    <th>Quantity</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="data"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" name="btnUpdate" class="btn btn-primary" id="btnUpdate">Update</button>-->
                            <input type="submit" name="submit" id="btnUpdate" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script>
    //Qty Enter and table add
    document.getElementById('qty').addEventListener('keypress', function (event) {
        if (event.keyCode == 13) {
            var l = $('#table1 tr').length;
            for (var a = 1; a < l; a++) {
                if ($('#table1 #rid' + a).text() == $('#cmbRItem').val()) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Already added to the List.</div></div>');
                    event.preventDefault();
                    return;
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
            }
            var html = "";
            html += "<tr>";
            html += "<td id='rid" + l + "' hidden>" + $('#cmbRItem option:selected').val() + "</td>";
            html += "<td>" + $('#cmbRItem option:selected').text() + "</td>";
            html += "<td id='qty" + l + "'>" + $('#qty').val() + "</td>";
            html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
            html += "</tr>";

            document.getElementById("table1").innerHTML += html;
            $('#cmbRItem').val($('#cmbRItem option:first').val());
            $('#qty').val("");
            $('#cmbRItem').focus();
            event.preventDefault();
        }
    });

// delete row
    $(document).on("click", "#btnDel", function () {
        var currow = $(this).closest('tr');
        $('#table1').find(currow).remove();
        $('#cmbRItem').focus();
    });

    //load by pono
    function loadPO() {
        var pono = "<?php echo $_POST['txtPO']; ?>";
        $.ajax({
            url: "/TopNotch/po/retrievePO",
            method: "POST",
            data: {pono: pono},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                var l = 1;
                $('#poNo').val(data[0].id);
                $('#cmbSup option:selected').val(data[0].supid);
                $('#cmbSup option:selected').text(data[0].fname + " " + data[0].lname);
                $('#dateadded').val(data[0].podate);
                var html = "";
                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td id='rid" + l + "' hidden>" + data[a].ritemid + "</td>";
                    html += "<td>" + data[a].description + "</td>";
                    html += "<td id='qty" + l + "'>" + data[a].qty + "</td>";
                    html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
                    html += "</tr>";
                    l++;
                }
                document.getElementById("data").innerHTML += html;
            }
        });
    }

    $(document).ready(function () {
        loadPO();

        $("#table1 tr").dblclick(function () {
            alert('OK');
        });
    });

    $('#poNo').keypress(function () {
        loadPO();
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

    //Save
    $(document).ready(function () {
        $("#frmPOUpdate").validate({
            rules: {
                dateadded: {
                    required: true
                },
                cmbSup: {
                    required: true
                }
            }
        });

        function storeTableValues() {
            var TableData = new Array();

            $('#table1 tr').each(function (row, tr) {
                TableData[row] = {
                    "rItemId": $(tr).find('td:eq(0)').text(),
                    "qty": $(tr).find('td:eq(2)').text()
                }
            });
            return TableData;
        }

        $(document).on("click", "#btnUpdate", function () {
            $("#frmPOUpdate").validate();
            if ($("#frmPOUpdate").valid()) {
                var l = $('#table1 tr').length;
                if (l <= 1) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Must Enter Raw Material Details.</div></div>');
                    return;
                }

                var TableData = JSON.stringify(storeTableValues());

                var po = {
                    id: $("#poNo").val(),
                    supId: $("#cmbSup").val(),
                    poDate: $("#dateadded").val(),
                    tableData: TableData
                };

                $.ajax({
                    url: "/TopNotch/po/poUpdate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        poData: po
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Purchase Order Successfully Updated.</div></div>');
//                        alert("Successfully registered!");
//                        window.location="poList";
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
    });
</script>
