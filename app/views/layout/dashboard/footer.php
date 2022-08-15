
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                'create_calendar' : function(options){
                    const container = document.getElementById('calendar');
                    const opts = {
                        usageStatistics: false,
                        defaultView: 'week',
                        week: {
                            workweek: true,
                        },
                        timezone: {
                            zones: [
                                {
                                    timezoneName: 'Australia/Adelaide',
                                    displayLabel: 'Adelaide',
                                }
                            ],
                        },
                        calendars: [
                            {
                                id: 'all_drivers',
                                name: 'All Drivers',
                                backgroundColor: '#03bd9e',
                            }
                        ],
                    };
                    $.extend( opts, options );
                    const calendar = new tui.Calendar(container, opts);
                },
                admin: {
                    init: function(){
                        actions.common.init();
                        actions['create_calendar']();
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