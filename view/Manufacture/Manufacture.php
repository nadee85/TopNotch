<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manufacture
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Manufacture</a></li>
            <li class="active">Manufacture</li>
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
                    <form id="frmManufacture">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Manufacture No</label>
                                        <input type="text" class="form-control" id="manNo" name="txtManNo" required="" disabled="">
                                    </div>
<!--                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="status" id="retBot" > Return Bottles
                                        </label>
                                    </div>-->
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
                                            <input type="text" class="form-control" id="dateadded" name="dateadded"/>
                                            <!--<input type="text" class="form-control datepicker" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask id="dateadded" name="dateadded"/>-->
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                    <div class="form-group">
                                        <label></label>
                                    </div>
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
                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>No of Empty Bottles</label>
                                        <input type="text" class="form-control" id="emptyBot" name="txtEBot" disabled value="0">
                                        <input type="hidden" class="form-control" id="curStock" name="curStock">
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
                            <div class="col-md-9">
                                <div class="box">
                                    <div class="box-body">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="forceWidth">Item</th>
                                                    <th class="forceWidth">Empty</th>
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
            //check raw mat stock
            var empty=parseFloat($('#emptyBot').val());
            var cur=parseFloat($('#curStock').val());
            if ($('#qty').val() > (empty+cur)) {
                $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Quantity is greater than Current Stock.</div></div>');
                event.preventDefault();
                return;
            }

            var html = "";
            html += "<tr>";
            html += "<td id='rid" + l + "' hidden>" + $('#cmbItem option:selected').val() + "</td>";
            html += "<td>" + $('#cmbItem option:selected').text() + "</td>";
            html += "<td id='empty" + l + "'>" + $('#emptyBot').val() + "</td>";
            html += "<td id='qty" + l + "'>" + $('#qty').val() + "</td>";
            html += "<td style='text-align:right'><button type='button' class='btn btn-danger btn-xs' id='btnDel'>Remove</button></td>";
            html += "</tr>";

            document.getElementById("table1").innerHTML += html;
            $('#cmbItem').val($('#cmbItem option:first').val());
            $('#qty').val("");
            $('#emptyBot').val("");
            $('#cmbItem').focus();
            event.preventDefault();
        }
    });

    // delete row
    $(document).on("click", "#btnDel", function () {
        var currow = $(this).closest('tr');
        $('#table1').find(currow).remove();
        $('#cmbItem').focus();
    });

    //return Check box
//    $(document).on("click", "#retBot", function () {
//        if ($('#retBot').is(":checked")) {
//            document.getElementById("cmbCus").disabled = false;
//        } else {
//            $('#cmbCus').val($('#cmbCus option:first').val());
//            document.getElementById("cmbCus").disabled = true;
//        }
//    });

    //get empty bottles
    function getEmpty() {
        var customer = $('#cmbCus').val();
        var item = $('#cmbItem').val();
        $('#emptyBot').val("0");
        $.ajax({
            url: "/TopNotch/manufacture/getEmpty",
            method: "POST",
            data: {
                customer: customer,
                item: item
            },
            dataType: "JSON",
            success: function (data) {
                $('#emptyBot').val(data[0].Qty);
                if (data[0].Qty == null) {
                    $('#emptyBot').val("0");
                }
            }
        });
    }
    
    //get CurStock
    function getCurStock() {
        var item = $('#cmbItem').val();
        $.ajax({
            url: "/TopNotch/manufacture/getCurStock",
            method: "POST",
            data: {
                item: item
            },
            dataType: "JSON",
            success: function (data) {
                $('#curStock').val(data[0].curStock);
                if (data[0].curStock == null) {
                    $('#curStock').val("0");
                }
                $("#qty").focus();
            }
        });
    }

    document.getElementById("cmbItem").addEventListener('change', function (event) {
        getEmpty();
        getCurStock();
        $("#qty").focus();
    });

    document.getElementById("cmbCus").addEventListener('change', function (event) {
        getEmpty();
    });

    //Load PO Numbers
    function manNo() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "/TopNotch/manufacture/loadManNo", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
//                $('#poNo').val("PO" + new Intl.NumberFormat('en-IN', {minimumIntegerDigits: 3}).format(parseInt(data[0].id) + 1));
                $('#manNo').val("MAN" + (parseInt(data[0].id) + 1).toString().padStart(4, "0"));
            }
        };
    }

    $(document).ready(function () {
        manNo();
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

    //Load Raw Materials
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

    //Save
    $(document).ready(function () {
        $("#frmManufacture").validate({
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
                    "ItemId": $(tr).find('td:eq(0)').text(),
                    "qty": $(tr).find('td:eq(3)').text()
                }
            });
            return TableData;
        }

        $(document).on("click", "#btnSave", function () {
            $("#frmManufacture").validate();
            if ($("#frmManufacture").valid()) {
                var l = $('#table1 tr').length;
                if (l <= 1) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">Must Enter Raw Material Details.</div></div>');
                    return;
                }

                var TableData = JSON.stringify(storeTableValues());

                var man = {
                    id: $("#manNo").val(),
                    cusId: $("#cmbCus").val(),
                    manDate: $("#dateadded").val(),
                    retBot: $("#retBot").is(":checked"),
                    tableData: TableData
                };

                $.ajax({
                    url: "/TopNotch/manufacture/addMan",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        manData: man
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Manufacture Data Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $('#table1').find("tr:gt(0)").remove();
                        manNo();
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
