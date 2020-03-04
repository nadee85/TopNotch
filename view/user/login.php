<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <!--<a href="index2.html"><b>Admin</b>Login</a>-->
        </div>
        <div id="err">

        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <img src="<?= RESOURCES ?>dist/logo.png" width="125" height="60">
            <p class="login-box-msg"></p>
            <form id="frmRegister">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="User Name" name="username" id="txtUsername"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="txtPassword"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">

                        <!--<button type="submit" name="loginuser" id="btnLogin" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
                        <input type="button" id="btnLogin" name="loginuser" class="btn btn-primary btn-block btn-flat" value="Sign In"/>
                        <!--<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
                    </div><!-- /.col -->
                </div>
                <p class="login-box-msg"></p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Dont have an Account?</p>
                    </div>
                    <div class="col-md-6">
                        <!--<a>Register here</a>-->
                        <input type="button" id="btnReg" name="btnReg" class="btn btn-link" value="Register Here"/>
                    </div>
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
                    error: function (jqXHR, textStatus, errorThrown,data) {
                        $("#err").html('<div class="box box-solid box-danger">\n\
                        <div class = "box-header"><h3 class = "box-title"> \n\
                        Error! </h3></div>\n\
                        <div class = "box-body">Your Account is inactive or \n\
                        Username or Password is incorrect. </div></div>');
                        console.log(errorThrown);
                    }
                })
            });
        });

        $(document).on("click", "#btnReg", function () {
        window.location="/TopNotch/user/userreg";
        });
    </script>
