        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        autoCompleter.addressAutoComplete($('#address'));
                        autoCompleter.suburbAutoComplete($('#suburb'));
                    }
                },
                'add-driver': {
                    init: function(){
                        actions.common.init();
                        $('form#driver_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Adding Driver and Sending Welcome Email...</h2></div>' });
                            }
                        });
                    }
                },
                'edit-driver': {
                    init: function(){
                        actions.common.init();
                    }
                }
                'view-drivers': {
                    init: function(){
                        var dt_options = {
                            "columnDefs": [
                                { "orderable": false, "targets": [2,3,4] },
                                { "searchable": false, "targets": [4]}
                            ],
                            "order": [],
                            "mark": true
                        }
                        var table = dataTable.init($('table#driver_list_table'), dt_options );
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>