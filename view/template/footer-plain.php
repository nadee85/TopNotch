
       <script src="<?= RESOURCES ?>plugins/jQuery/jQuery-3.4.1.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= RESOURCES ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?= RESOURCES ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>