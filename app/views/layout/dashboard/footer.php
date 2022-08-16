
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>
        <!--script src="/scripts/calendar_app.js"></script-->
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
                            hourStart: 3,
                            hourEnd: 18,
                            eventView: ['time'],
                            taskView: false
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
                    var cal = new tui.Calendar(container, opts);
                    var todayButton = $('#today');
                    var prevButton = $('#prev');
                    var nextButton = $('#next');
                    var range = $('.navbar--range');

                    function displayEvents() {
                        var events = generateRandomEvents(
                            cal.getViewName(),
                            cal.getDateRangeStart(),
                            cal.getDateRangeEnd()
                        );
                        cal.clear();
                        cal.createEvents(events);
                    }

                    function displayRenderRange() {
                        var viewName = cal.getViewName();

                        range.textContent = getNavbarRange(
                            cal.getDateRangeStart(),
                            cal.getDateRangeEnd(),
                            viewName
                        );
                    }

                    todayButton.on('click', function () {
                        cal.today();
                        //displayEvents();
                        displayRenderRange();
                    });
                    prevButton.on('click', function () {
                        cal.prev();
                        //displayEvents();
                        displayRenderRange();
                    });
                    nextButton.on('click', function () {
                        cal.next();
                        //displayEvents();
                        displayRenderRange();
                    });

                    //displayEvents();
                    displayRenderRange();
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