    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="index2.html"><b>Admin</b>Login</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <?php
//            if ($errMsg != null) {
                ?>
                <!--                <div class="box box-solid box-danger">
                                    <div class="box-header">
                                        <h3 class="box-title">Error!</h3>
                                    </div> /.box-header 
                                    <div class="box-body">
                <?php // echo $errMsg; ?>
                                    </div> /.box-body 
                                </div> /.box 
                
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <?php // echo $errMsg; ?>
                                </div>-->
                <?php
//            }
                ?>
                <?php
//            if ($successMsg != null) {
                ?>
                <!--                <div class="box box-solid box-success">
                                    <div class="box-header">
                                        <h3 class="box-title">Error!</h3>
                                    </div> /.box-header 
                                    <div class="box-body">
                <?php // echo $successMsg; ?>
                                    </div> /.box-body 
                                </div> /.box 
                
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Success!</h4>
                <?php // echo $successMsg; ?>
                                </div>-->
                <?php
//            }
                ?>

                <p class="login-box-msg">Sign in to start your session</p>
                <form id="frmRegister" action="login" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="username" id="txtUsername"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="txtPassword"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="keep_login"> Remember Me
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <input type="button" id="btnLogin" class="btn btn-primary btn-block btn-flat" value="Sign In"/>
                            <!--<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
                        </div><!-- /.col -->
                    </div>
                </form>

                <!--
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div>
                -->

                <!-- /.social-auth-links -->

                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <script>
            $(document).ready(function () {
                $(document).on("click", "#btnLogin", function () {
                    var username = $("#txtUsername").val();
                    var password = $("#txtPassword").val();
                    var postBack = "<?= $postBack ?>";

                    $.ajax({
                        url: "/TopNotch/user/authenticate",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            username: username,
                            password: password,
                            postBack: postBack
                        },
                        success: function (data) {
                            window.location = data.postBack;
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                            console.log(errorThrown);
                        }
                    })
                });
            });
        </script>
