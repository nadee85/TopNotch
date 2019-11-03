
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
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmPO">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>PO No</label>
                                        <input type="text" class="form-control" id="poNo" name="txtPONo" required="" disabled="">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" name="submit" class="btn btn-primary">Submit</button>-->
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
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

    //Load PO Numbers
    function poNo() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/po/loadPONo", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
//                $('#poNo').val("PO" + new Intl.NumberFormat('en-IN', {minimumIntegerDigits: 3}).format(parseInt(data[0].id) + 1));
                $('#poNo').val("PO" + (parseInt(data[0].id) + 1).toString().padStart(4, "0"));
            }
        };
    }

    $(document).ready(function () {
        poNo();
        $('#dateadded').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', 'today');
    });

    $(function () {
        $('#dateadded').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
//            yearRange: '-100y:c+nn'
//            maxDate: '-1d'
        });
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
        $("#frmPO").validate({
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

        $(document).on("click", "#btnSave", function () {
            $("#frmPO").validate();
            if ($("#frmPO").valid()) {
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
                    url: "/TopNotch/po/addPO",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        poData: po
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Purchase Order Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $('#table1').find("tr:gt(0)").remove();
                        poNo();
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

    $('tr').dblclick(function () {
        var id = $(this).attr('id');
        alert(id);
        //do something with id
    });
</script>
