<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manufacture Item List
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manufacture</a></li>
            <li class="active">Manufacture Item List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
                                
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manufacture Item Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">             
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Raw Material </th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
                        </table>                     
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/manufacture/manItemDetails", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for (var a = 0; a < data.length; a++) {
                html += "<tr>";
                html += "<td>" + data[a].ides +"</td>";
                html += "<td>" + data[a].rdes + "</td>";
                html += "<td>" + data[a].qty + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
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

    $('table tbody').on('click', '.btn', function () {
        var currow = $(this).closest('tr');
        $("#rMaterialId").val(currow.find('td:eq(0)').text());
        $("#description").val(currow.find('td:eq(1)').text());
        $("#stock").val(currow.find('td:eq(2)').text());
        if (currow.find('td:eq(3)').text() === "Mandatory") {
            $("#mandatory").prop("checked", true);
        } else {
            $("#mandatory").prop("checked", false);
        }
    })

    $(document).ready(function () {
        $(document).on("click", "#btnUpdate", function () {
            var rawMaterial = {
                id: $("#rMaterialId").val(),
                description: $("#description").val(),
                stock: $("#stock").val(),
                mandatory: $("#mandatory").is(":checked")
            };

            $.ajax({
                url: "/TopNotch/rawmaterial/updateRawMaterial",
                type: "POST",
                dataType: "JSON",
                data: {
                    rawData: rawMaterial
                },
                success: function (data) {
                    $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Raw Material Successfully Updated.</div></div>');
//                        alert("Successfully registered!");
                    console.log(data);
                    $(frmRawMaterialList).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#err").html('<div class="box box-solid box-danger">\n\
                <div class = "box-header"><h3 class = "box-title"> Error! </h3></div>\n\
<div class = "box-body">' + textStatus + '</div></div>');
                    alert(textStatus);
                    console.log(errorThrown);
                }
            });
        });
    });
</script>