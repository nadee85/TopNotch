<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row justify-content-between">
            <div class="col-xs-10">
                <h2 class="page-header" id="date">

                </h2>
            </div><!-- /.col -->
            <div class="col-xs-2">
                <small class="pull-right"><img src="<?= RESOURCES ?>dist/logo.png" width="70" height="35"></small>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="forceWidth">Item</th>
                            <th class="forceWidth">Description</th>
                            <th class="forceWidth">Unit Price</th>
                            <th class="forceWidth">On-Hand</th>
                            <th class="forceWidth">Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/TopNotch/item/loadItems", true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            var total = 0;
            for (var a = 0; a < data.length; a++) {
                total = total + (data[a].curStock * data[a].price);
                html += "<tr>";
                html += "<td>" + data[a].id + "</td>";
                html += "<td>" + data[a].description + "</td>";
                html += "<td>" + data[a].price + ".00</td>";
                html += "<td>" + data[a].curStock + "</td>";
                html += "<td>" + (data[a].curStock * data[a].price) + ".00</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
            document.getElementById("total").innerHTML += total;
        }
    };

    $(document).ready(function () {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = dd + "/" + mm + "/" + yyyy;
        document.getElementById("date").innerHTML += "Product Stock as at " + today;
    });

    $("#print").on('click', function () {
        window.print();
    });
</script>

