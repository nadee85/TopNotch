<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="<?= RESOURCES ?>dist/logo2.png" type="image/x-icon">
        <title>TopNotch</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="<?= RESOURCES ?>vendor/jquery.min.js"></script>
        <script src="<?= RESOURCES ?>vendor/pagination.min.js"></script>
        <!--         Bootstrap 3.3.2 -->
        <link href="<?= RESOURCES ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--Font Awesome Icons--> 
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!--Ionicons--> 
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!--Theme style--> 
        <link href="<?= RESOURCES ?>dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?= RESOURCES ?>dist/css/tableprop.css" rel="stylesheet" type="text/css" />
        <!--         AdminLTE Skins. Choose a skin from the css/skins 
                     folder instead of downloading all of them to reduce the load. -->
        <link href="<?= RESOURCES ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= RESOURCES ?>dist/css/jquery-ui.css">
        <link href="<?= RESOURCES ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="<?= RESOURCES ?>vendor/jquery.validate.min.js"></script>
        <script src="<?= RESOURCES ?>plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?= RESOURCES ?>plugins/pdf/jspdf.min.js"></script>
        <!--<link href="<?= RESOURCES ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <!--<a href="index.php" class="navbar-brand "><b>Admin</b>Panel</a>-->
                <a href="../home/index" class="navbar-brand">
                    <img src="<?= RESOURCES ?>dist/logo1.png" width="125" height="60">
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="loadpro">

                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header" id="profile">
                                    </li>
                                    
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <!--<a href="TopNotch/User/" class="btn btn-default btn-flat">Profile</a>-->
                                        </div>
                                        <div class="pull-right">
                                            <!--<input type="button" id="logoff" class="btn btn-default btn-flat" value="Sign out">-->
                                            <a href="" id="logoff" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- side bar -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                
                <section class="sidebar">
                    <div class="user-panel"></div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
<!--                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>-->
                        </div>
                    </form>
                    <!-- Sidebar user panel -->
                    
                    <div class="user-panel" >
                        <div class="pull-left image" id="sideprofIm">
                            
                        </div>
                        <div class="pull-left info">
                            <div id="sideprofTe"></div>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                            <ul class="treeview-menu" id="user">
                                <li id="nuserh"><a href="../user/userReg"><i class="fa fa-circle-o"></i>New User</a></li>
                                <li><a href="../user/ChangePassword"><i class="fa fa-circle-o"></i>Change Password</a></li>
                                <li><a href="../user/UserList"><i class="fa fa-circle-o"></i>User List</a></li>
<!--                                <li id="roleh"><a href="../user/Roles"><i class="fa fa-circle-o"></i>New Role</a></li>
                                <li id="userroleh"><a href="../user/UserRoles"><i class="fa fa-circle-o"></i>User Roles</a></li>-->
                            </ul>
                        </li>
                        <li class="treeview" id="item">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Items</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Item/newItem"><i class="fa fa-circle-o"></i>New Item</a></li>
                                <li><a href="../Item/itemList"><i class="fa fa-circle-o"></i>Item List</a></li>
                                <li><a href="../RawMaterial/newRawMaterial"><i class="fa fa-circle-o"></i>New Raw Material</a></li>
                                <li><a href="../RawMaterial/rawMaterialList"><i class="fa fa-circle-o"></i>Raw Material List</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="procurement">
                            <a href="#">
                                <i class="fa fa-gift"></i>
                                <span>Procurement</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Supplier/supplierList"><i class="fa fa-circle-o"></i>Supplier List</a></li>
                                <li><a href="../Supplier/newSupplier"><i class="fa fa-circle-o"></i>New Supplier</a></li>
                                <li><a href="../PO/poList"><i class="fa fa-circle-o"></i>Purchase Order List</a></li>
                                <li><a href="../PO/newPO"><i class="fa fa-circle-o"></i>New Purchase Order</a></li>
                                <li><a href="../GRN/grnList"><i class="fa fa-circle-o"></i>GRN List</a></li>
                                <li><a href="../GRN/newGRN"><i class="fa fa-circle-o"></i>New GRN</a></li>
                                <li><a href="../Supplier/supplierPaymentList"><i class="fa fa-circle-o"></i>Supplier Payments</a></li>
                                <li><a href="../Supplier/newSupplierPayment"><i class="fa fa-circle-o"></i>New Supplier Payment</a></li>
                                <li><a href="../Supplier/supplierDuePaymentList"><i class="fa fa-circle-o"></i>Supplier Due Payment List</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="manufacture">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Manufacture</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Manufacture/ManufacturingItems"><i class="fa fa-circle-o"></i>Manufacturing Items</a></li>
                                <li><a href="../Manufacture/ManufactureItemList"><i class="fa fa-circle-o"></i>Manufacture Item Details</a></li>
                                <li><a href="../Manufacture/Manufacture"><i class="fa fa-circle-o"></i>Manufacture</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="invent">
                            <a href="#">
                                <i class="fa fa-building-o"></i>
                                <span>Inventory</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Item/itemStock"><i class="fa fa-circle-o"></i>Item Stock</a></li>
                                <li><a href="../RawMaterial/rawMaterialStock"><i class="fa fa-circle-o"></i>Raw Material Stock</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="salesSli" >
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Sales</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Customer/customerList"><i class="fa fa-circle-o"></i>Customer List</a></li>
                                <li><a href="../Customer/newCustomer"><i class="fa fa-circle-o"></i>New Customer</a></li>
                                <li><a href="../Customer/returnEmpty"><i class="fa fa-circle-o"></i>Return Empty Bottles</a></li>
                                <li><a href="../Customer/ReturnEmptyList"><i class="fa fa-circle-o"></i>Return Empty List</a></li>
                                <li><a href="../Invoice/invoiceList"><i class="fa fa-circle-o"></i>Invoice List</a></li>
                                <li><a href="../Invoice/newInvoice"><i class="fa fa-circle-o"></i>New Invoice</a></li>
                                <li><a href="../Customer/customerPaymentList"><i class="fa fa-circle-o"></i>Customer Payments</a></li>
                                <li><a href="../Customer/newCustomerPayment"><i class="fa fa-circle-o"></i>New Customer Payment</a></li>
                                <li><a href="../Customer/customerDuePaymentList"><i class="fa fa-circle-o"></i>Customer Due Payment List</a></li>
                            </ul>
                        </li>
                        <li class="header">REPORTS</li>
                        <li class="treeview" id="rstock">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Inventory</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Report/rawMaterialStock"><i class="fa fa-circle-o"></i>Raw Material Stock</a></li>
                                <li><a href="../Report/itemStock"><i class="fa fa-circle-o"></i>Item Stock</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="rProcurement">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Procurement</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Report/SupplierRegister"><i class="fa fa-circle-o"></i>Supplier Register</a></li>
                                <li><a href="../Report/GRNSummeryDateRange"><i class="fa fa-circle-o"></i>GRN Summery - Date Range</a></li>
                                <li><a href="../Report/SupplierWisePayment"><i class="fa fa-circle-o"></i>Supplier Payment - Supplier</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="rManufacture">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Manufacture</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Report/ManufactureDateRange"><i class="fa fa-circle-o"></i>Manufacture Summery</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="rSales">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Sales</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../Report/CustomerRegister"><i class="fa fa-circle-o"></i>Customer Register</a></li>
                                <li><a href="../Report/InvoiceSummeryDateRange"><i class="fa fa-circle-o"></i>Invoice Summery - Date Range</a></li>
                                <li><a href="../Report/CustomerWiseInvoiceSummery"><i class="fa fa-circle-o"></i>Invoice Summery - Customer</a></li>
                                <li><a href="../Report/ItemWiseSalesSummery"><i class="fa fa-circle-o"></i>Invoice Summery - Item</a></li>
                                <li><a href="../Report/CustomerWisePayment"><i class="fa fa-circle-o"></i>Customer Payment - Customer</a></li>
                                <li><a href="../Report/CusDuePayament"><i class="fa fa-circle-o"></i>Customer Due Payment</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>



