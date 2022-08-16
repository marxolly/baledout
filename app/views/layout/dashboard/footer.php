
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script src="/scripts/calendar_app.js"></script>
        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                admin: {
                    init: function(){
                        actions.common.init();
                    }
                },
                driver: {
                    init: function(){

                    }
                },
                client: {
                    init: function(){

                    }
                },
                'dashboard':{
                    init: function(){
                        actions['<?php echo $user_role;?>'].init();
                    }

                },
                'comingsoon':{
                    init: function(){
                        
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>