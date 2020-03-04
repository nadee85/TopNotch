
<footer class="main-footer no-print">

</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<!--<script src="<?= RESOURCES ?>plugins/jQuery/jquery-3.4.1.min.js"></script>-->
<!--<script src="<?= RESOURCES ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>-->
<!-- Bootstrap 3.3.2 JS -->
<script src="<?= RESOURCES ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="<?= RESOURCES ?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= RESOURCES ?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?= RESOURCES ?>plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?= RESOURCES ?>plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?= RESOURCES ?>dist/js/app.min.js" type="text/javascript"></script>
<script src="<?= RESOURCES ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= RESOURCES ?>vendor/jquery-ui.js"></script>
<script src="<?= RESOURCES ?>plugins/chartjs/Chart.js" type="text/javascript"></script>
<!-- FLOT CHARTS -->
<script src="<?= RESOURCES ?>plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= RESOURCES ?>plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?= RESOURCES ?>plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?= RESOURCES ?>plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var userid = "<?php echo $_SESSION['user']['name']['username']; ?>";
        $.ajax({
            url: "/TopNotch/home/loadImage",
            method: "POST",
            data: {userid: userid},
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                var html = "";
                html += "<img src=<?= RESOURCES ?>dist/img/" + data[0].picture + " class='user-image' alt='User Image' />";
                html += "<span class='hidden-xs'>" + data[0].fname + " " + data[0].lname + "</span>";
                document.getElementById("loadpro").innerHTML += html;
                var html = "";
                html += "<img src=<?= RESOURCES ?>dist/img/" + data[0].picture + " class='img-circle' alt='User Image' />";
                html += "<p>" + data[0].fname + " " + data[0].lname + "</p>";
                document.getElementById("profile").innerHTML += html;
                var html = "";
                html += "<img src=<?= RESOURCES ?>dist/img/" + data[0].picture + " class='img-circle' alt='User Image' />";
                document.getElementById("sideprofIm").innerHTML += html;
                var html = "";
                html += "<p>" + data[0].fname + " " + data[0].lname + "</p>";
                document.getElementById("sideprofTe").innerHTML += html;
            }
        });
    });
    
    $('#logoff').click(function () {
        var userid = "<?php echo $_SESSION['user']['name']['username']; ?>";
        $.ajax({
            url: "/TopNotch/user/logoff",
            method: "post",
            data: {
                userid: userid
            },
            dataType: "JSON",
            success: function (data) {
                consol.log(data);
            }
        });
    });
    
    //permission
//    $(document).ready(function () {
//        var userid = "<?php echo $_SESSION['user']['name']['username']; ?>";
//        $.ajax({
//            url: "/TopNotch/user/permission",
//            method: "POST",
//            data: {userid: userid},
//            dataType: "JSON",
//            success: function (data) {
//                if (data[0].description != 'Admin') {
//                    document.getElementById("roleh").style.display="none";
//                    document.getElementById("userroleh").style.display="none";
//                }
//                if (data[0].description == 'User' || data[0].description == 'Super User') {
//                    document.getElementById("nuserh").style.display="none";
//                    document.getElementById("roleh").style.display="none";
//                    document.getElementById("userroleh").style.display="none";
//                }
//                if (data[0].description == 'User') {
//                    document.getElementById("nuserh").style.display="none";
//                    document.getElementById("roleh").style.display="none";
//                    document.getElementById("userroleh").style.display="none";
//                    document.getElementById("item").style.display="none";
//                }
//                console.log(data);
//            }
//        });
//    });
</script>
</body>
</html>
