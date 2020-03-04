<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Raw Materials Form
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
                    <form id="frmRawItem">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputID">Raw Material ID</label>
                                <input type="text" class="form-control" id="ritemid" placeholder="Enter Item ID" name="ritemid" required="">
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
                                    <input type="checkbox" name="status" id="status" checked > Active
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
        $("#frmRawItem").validate({
            rules: {
                ritemid: {
                    required: true,
                    remote: {
                        url: "/TopNotch/rawMaterial/exists",
                        type: "POST",
                        data: {
                            ritemid: function () {
                                return $("#ritemid").val();
                            }
                        }
                    }
                }
            },
            messages: {
                ritemid: {
                    remote: "ID is already taken!"
                }
            }
        });

        $(document).on("click", "#btnSave", function () {
            $("#frmRawItem").validate();
            if ($("#frmRawItem").valid()) {
                var ritem = {
                    id: $("#ritemid").val(),
                    description: $("#description").val(),
                    stock: $("#stock").val(),
                    status: $("#status").is(":checked")
                };

                $.ajax({
                    url: "/TopNotch/rawMaterial/addRawMaterial",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        rawData: ritem
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Raw Material Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmRawItem).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
                        $("#ritemid").focus();
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