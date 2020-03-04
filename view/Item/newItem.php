<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Item Form
            <small>Creating New Items</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Item</a></li>
            <li class="active">New Item</li>
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
                    <form id="frmItemDet">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputID">Item ID</label>
                                <input type="text" class="form-control" id="itemid" placeholder="Enter Item ID" name="itemid" required="">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter Description" name="txtDescription">
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="txtPrice">
                            </div>
                            <div class="form-group">
                                <label for="inputCurStock">Current Stock</label>
                                <input type="text" class="form-control" id="stock" placeholder="Enter Current Stock" name="txtStock">
                            </div>
                            <div class="form-group">
                                <label for="inputCurStock">Re-Order Level</label>
                                <input type="text" class="form-control" id="reOrder" placeholder="Enter Re-Order Level" name="reOrder">
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
        $("#frmItemDet").validate({
            rules: {
                itemid: {
                    required: true,
                    remote: {
                        url: "/TopNotch/item/exists",
                        type: "POST",
                        data: {
                            itemid: function () {
                                return $("#itemid").val();
                            }
                        }
                    }
                }
            },
            messages: {
                itemid: {
                    remote: "ID is already taken!"
                }
            }
        });
        $(document).on("click", "#btnSave", function () {
            $("#frmItemDet").validate();
            if ($("#frmItemDet").valid()) {
                var item = {
                    itemId: $("#itemid").val(),
                    description: $("#description").val(),
                    price: $("#price").val(),
                    stock: $("#stock").val(),
                    reOrder:$('#reOrder').val(),
                    status: $("#status").is(":checked")
                };

                $.ajax({
                    url: "/TopNotch/item/addItem",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        itemData: item
                    },
                    success: function (data) {
                        $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body">Item Successfully Added.</div></div>');
//                        alert("Successfully registered!");
                        console.log(data);
                        $(frmItemDet).closest('form').find("input[type=text],input[type=tel],input[type=email],textarea").val("");
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