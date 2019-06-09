<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New User Form
            <small>Creating New Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Save User</li>
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



                    <?php
                    if ($errMsg != null) {
                        ?>
                        <div class="box box-solid box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Error!</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo $errMsg; ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <?php
                    }
                    ?>
                    <?php
                    if ($successMsg != null) {
                        ?>
                        <div class="box box-solid box-success">
                            <div class="box-header">
                                <h3 class="box-title">Success!</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo $successMsg; ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <?php
                    }
                    ?>



                    <!-- form start -->
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNIC">NIC</label>
                                <input type="text" class="form-control" id="inputNIC" placeholder="Enter NIC" name="nic">
                            </div>
                            <div class="form-group">
                                <label for="inputFname">First Name</label>
                                <input type="text" class="form-control" id="inputFname" placeholder="Enter First Name" name="fname">
                            </div>
                            <div class="form-group">
                                <label for="inputLname">Last Name</label>
                                <input type="text" class="form-control" id="inputLname" placeholder="Enter Last Name" name="lname">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputContact">Contact No</label>
                                <input type="tel" class="form-control" id="inputContact" placeholder="Enter Contact No" name="contact">
                            </div>
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Date of Birth:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask name="dob"/>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>User Category</label>
                                <select class="form-control" name="category">
                                    <option>Rep</option>
                                    <option>Driver</option>
                                    <option>Show Owner</option>
                                    <option>Manager</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPicture">Profile Picture</label>
                                <input type="file" id="inputPicture" name="picture">
                                <p class="help-block">Image size should below 4mb. PNG, JPG</p>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <select class="form-control" name="city">
                                    <?php
                                    try {
                                        $con = connect_database();
                                        $sql = "SELECT * FROM `City` ORDER BY `CityName`";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["CityId"] . '">' . $row["CityName"] . '</option>';
                                            }
                                        } else {
                                            
                                        }
                                        $con->close();
                                    } catch (Exception $exc) {
                                        $errMsg = "<br>Error description: " . $exc;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div><!--/.col (left) -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->