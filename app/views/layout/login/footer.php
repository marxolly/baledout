        <!-- Jquery JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <!-- Validation JavaScript -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js" ></script>
        <script src="/scripts/form_validators.js" ></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <!-- DataTables JavaScript -->
        <script language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script language="javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
        <script src="/scripts/dataTables.bootstrap.min.js"></script>
        <!-- Block UI JavaScript -->
        <script src="/scripts/jquery.blockUI.js"></script>
        <!-- WMS JavaScript -->
        <script src="/scripts/common.js"></script>

        <!-- Assign CSRF Token to JS variable -->
        <?php echo "Gonna set ".Session::generateCsrfToken();?>
        <?php Config::setJsConfig('csrfToken', Session::generateCsrfToken()); ?>
        <!-- Assign all configuration variables -->
        <script>config = <?php echo json_encode(Config::getJsConfig()); ?>;</script>
        <script>
            $(document).ready(function(e){
                $('button#link-forgot-password').click(function(e){
                    e.preventDefault();
                    $('form#form-login').slideToggle('slow');
                    $('form#form-forgot-password').slideToggle('slow');
                });

                $('button#link-login').click(function(e){
                    e.preventDefault();
                    $('form#form-login').slideToggle('slow');
                    $('form#form-forgot-password').slideToggle('slow');
                });

                $('form#form-forgot-password').submit(function(e){
                    if($(this).valid())
                    {
                        $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Generating password reset link</h2></div>' });
                    }
                });
            });
        </script>
		<?php Database::closeConnection(); ?>
	</body>
</html>
