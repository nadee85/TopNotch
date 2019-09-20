<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Raw Material Form
            <small>Creating New Raw Materials</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Item</a></li>
            <li class="active">New Raw Materials</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-6">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Fill all Fields</h3>
                    </div><!-- /.box-header -->
                    <div id="err"></div>
                    <!-- form start -->
                    <form id="frmRawMaterial">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputID">Raw Material ID</label>
                                <input type="text" class="form-control" id="rawmatid" placeholder="Enter Item ID" name="txtRawMatId">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter Description" name="txtDescription">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputCurStock">Current Stock</label>
                                <input type="text" class="form-control" id="stock" placeholder="Enter Current Stock" name="txtStock">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="mandatory" checked id="mandatory"> Mandatory
                                </label>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" name="submit" id="btnSave" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $(document).on("click", "#btnSave", function () {
            $("#frmRawMaterial").validate();
            if ($("#frmRawMaterial").valid()) {
                var rawMaterial = {
                    id: $("#rawmatid").val(),
                    description: $("#description").val(),
                    stock: $("#stock").val(),
                    mandatory: $("#mandatory").is(":checked")
                };

                $.ajax({
                    url: "/TopNotch/rawmaterial/addRawMaterial",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        rawData: rawMaterial
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Raw Material Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmRawMaterial).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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
    });
</script>