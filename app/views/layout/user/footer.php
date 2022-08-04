        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>
        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                profile:{
                    init: function(){
                        $('form#profile_update').submit(function(){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Processing form...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>