<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PO List
            <small>View Manage PO Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">PO List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Search PO</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputGrnid">PO No </label>
                                        <input type="text" class="form-control" id="poNo" placeholder="Enter PO No " name="txtPONo">
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" id="cmbSup" name="cmbSupId">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                        <input type="submit" onsubmit="sub()" value="submit">
                        <!--<input type="submit" class="btn btn-success" value="View" id="btnView">-->
                    </form>
                    <div id="results"></div>
                </div><!-- /.box -->

            </div><!--/.col (left) -->                        
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Purchase Order List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;                                                 ?> to <?php // echo $endNo * $resultsPerPage;                                                 ?> of <?php // echo $resultsFound;                                                 ?> entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_bootstrap">
                                        <ul class="pagination">
                                            <li class="prev"><a href="#">← Previous</a></li>
                                            <li>
                                                <a href="" ></a>
                                            </li>
                                            <?php
//                                            }
                                            ?>
                                            <li class="next"><a href="#">Next → </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="frmPOList" action="updatePO" method="POST">
                            <input type="hidden" name="txtPO" id="poid"> 
                            <table id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>PONo</th>
                                        <th>Date Added</th>
                                        <th>Supplier</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </form>
                        <div class="pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info">Showing <?php // echo ($startNo - 1) * $resultsPerPage;                                                 ?> to <?php // echo $endNo * $resultsPerPage;                                                 ?> of <?php // echo $resultsFound;                                                 ?> entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_bootstrap">
                                        <ul class="pagination">
                                            <li class="prev"><a href="#">← Previous</a></li>
                                            <li>
                                                <a href="" ></a>
                                            </li>
                                            <li class="next"><a href="#">Next → </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                                
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
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
        ajax.open("GET", "/TopNotch/po/loadPO", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                var upPage = "";
                dataList(data);
            }
        };
    }

    //load by pono
    $('#poNo').keypress(function () {
        var pono = $('#poNo').val();
        $.ajax({
            url: "/TopNotch/po/loadByPo",
            method: "POST",
            data: {pono: pono},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                dataList(data);
            }
        });
    });
    //load by supplier
    $('#cmbSup').change(function () {
        var id = $('#cmbSup option:selected').val();
        $.ajax({
            url: "/TopNotch/po/findBySupId",
            method: "POST",
            data: {id: id},
            dataType: "JSON",
            success: function (data) {
                $('#data').empty();
                console.log(data);
                dataList(data);
            }
        });
    });
    //load by date
    $('#dateTo').change(function () {
        dateRangeData();
    });
    $('#dateFrom').change(function () {
        dateRangeData();
    });
    
    //delete po
    $('table tbody').on("click", "#btnDel", function () {
        if (confirm("Are you sure you want to delete this record?")) {
            var currow = $(this).closest('tr');
            var id = currow.find('td:eq(0)').text();
            $.ajax({
                url: "/TopNotch/po/deletePO",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function (data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Purchase Order Successfully Deleted.</div></div>');
//                        alert("Successfully registered!");
                    $('#table1').find("tr:gt(0)").remove();
                    loadList();
                    console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                    alert(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    });
    
    //view po
    $(document).ready(function () {
        $('table tbody').on("click", "#btnView", function () {
            var currow = $(this).closest('tr');
            $("#poid").val(currow.find('td:eq(0)').text());
        });
    });


    function dateRangeData() {
        var startDate = $('#dateFrom').val();
        var endDate = $('#dateTo').val();
        $.ajax({
            url: "/TopNotch/po/findByDate",
            method: "POST",
            data: {
                startDate: startDate,
                endDate: endDate
            },
            dataType: "JSON",
            success: function (data) {
                alert(data[0].id);
                $('#data').empty();
                console.log(data);
                dataList(data);
            }
        });
    }

    function dataList(data) {
        var html = "";
        for (var a = 0; a < data.length; a++) {
            html += "<tr>";
            html += "<td>" + data[a].id + "</td>";
            html += "<td>" + data[a].fname + " " + data[a].lname + "</td>";
            html += "<td>" + data[a].podate + "</td>";
//            html += "<td><input type='submit' class='btn btn-info btn-xs' id='btnView' value='View'>\n\
            html += "<td><input type='submit' id='btnView' class='btn btn-success btn-xs'value='View'>\n\
            <button type='button' class='btn btn-danger btn-xs' id='btnDel'>Delete</button></td>";
            html += "</tr>";
        }
        document.getElementById("data").innerHTML += html;
    }
</script>