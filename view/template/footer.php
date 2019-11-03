
<footer class="main-footer">

</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<!--<script src="<?= RESOURCES ?>plugins/jQuery/jquery-3.4.1.min.js"></script>-->
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
</script>
</body>
</html>
