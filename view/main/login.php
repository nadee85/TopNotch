<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Metro Campus</title>
        <link rel="icon" href="images/icon.png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Metro Campus">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/bootstrap4/bootstrap.min.css">
        <link href="<?= RESOURCES ?>plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/responsive.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/contact.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/contact_responsive.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/course.css">
        <link rel="stylesheet" type="text/css" href="<?= RESOURCES ?>styles/course_responsive.css">
        <link href="<?= RESOURCES ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= RESOURCES ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="<?= RESOURCES ?>vendor/jquery.min.js"></script>
    </head>
    <body>

        <div class="super_container">

            <!-- Header -->

            <header class="header">
                <!-- Header Content -->
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo_container">
                                        <a href="index.php">
                                            <div class="logo"><img src="<?= RESOURCES ?>dist/logo.png" width="150" height="75" alt="IVO"></div>
                                        </a>
                                    </div>
                                    <nav class="main_nav_contaner ml-auto">
                                        <ul class="main_nav">
                                            <li class="active"><a href="#">Home</a></li>
                                            <li><a href="about.php">About Us</a></li>
                                            <li><a href="courses.php">Our Products</a></li>
                                            <li><a href="news.php">Quality Standards</a></li>
                                            <li><a href="contact.php">Contact Us</a></li>
                                        </ul>
                                        <div class="search_button"><i class="fa fa-search" aria-hidden="true"></i></div>
                                        <div class="shopping_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                                        <div class="hamburger menu_mm">
                                            <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Menu -->

            <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
                <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
                <div class="search">
                    <form action="#" class="header_search_form menu_mm">
                        <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
                        <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                            <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <nav class="menu_nav">
                    <ul class="menu_mm">
                        <li class="menu_mm"><a href="index.php">Home</a></li>
                        <li class="menu_mm"><a href="about.php">About Us</a></li>
                        <li class="menu_mm"><a href="courses.php">Our Products</a></li>
                        <li class="menu_mm"><a href="news.php">Quality Standards</a></li>
                        <li class="menu_mm"><a href="contact.php">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="contact_info_container">
            <div class="container">
                <div id="err"></div>
                <p class="login-box-msg"></p>
                <p class="login-box-msg"></p>
                <div class="row">

                    <!-- Contact Form -->
                    <div class="col-lg-4">
                        <div class="contact_form">
                            <div class="contact_info_location_title">
                                Welcome to IVO. Please Login.
                            </div>
                            <!--<div class="course_info_title">Welcome to IVO Please Login</div>-->
                            <form id="frmLogin" class="comment_form">
                                <div>
                                    <div class="form_title">Phone Number or Email</div>
                                    <input type="text" class="comment_input" required="required">
                                </div>
                                <div>
                                    <div class="form_title">Password</div>
                                    <input type="password" class="comment_input" required="required">
                                </div>
                                <div>
                                    <button type="submit" class="comment_button trans_200">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-md-8">
                        <div class="contact_info">
                            <div class="contact_info_location_title">
                                Dont have an account?  Please Register.
                            </div>

                            <form id="frmLogin" class="comment_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <div class="form_title">First Name</div>
                                            <input type="text" class="comment_input" required="required">
                                        </div>
                                        <div>
                                            <div class="form_title">Last Name</div>
                                            <input type="text" class="comment_input" required="required">
                                        </div>
                                        <div>
                                            <div class="form_title">Password</div>
                                            <input type="password" class="comment_input" required="required">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <div class="form_title">Email</div>
                                            <input type="text" class="comment_input" required="required">
                                        </div>
                                        <div>
                                            <div class="form_title">Phone Number</div>
                                            <input type="text" class="comment_input" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button  id="sign" type="button" class="comment_button trans_200">Sign Up</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<script src="<?= RESOURCES ?>js/jquery-3.2.1.min.js"></script>-->
        <script src="<?= RESOURCES ?>styles/bootstrap4/popper.js"></script>
        <script src="<?= RESOURCES ?>styles/bootstrap4/bootstrap.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/greensock/TweenMax.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/greensock/TimelineMax.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/scrollmagic/ScrollMagic.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/greensock/animation.gsap.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/greensock/ScrollToPlugin.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="<?= RESOURCES ?>plugins/easing/easing.js"></script>
        <script src="<?= RESOURCES ?>plugins/parallax-js-master/parallax.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/js/contact.js"></script>

        <script>
            $(document).on("click", "#sign", function () {
                $("#err").html('<div class="box box-solid box-success">\n\
                <div class = "box-header"><h3 class = "box-title"> Success! </h3></div>\n\
<div class = "box-body"><h4>Registration Success. \n\
Please confirm your account details by visiting the link sent to the email address you provided. </br>Thank You!</h4></div></div>');
            });
        </script>
    </body>
</html>