        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        autoCompleter.addressAutoComplete($('#deliveryaddress'), "delivery");
                        autoCompleter.suburbAutoComplete($('#deliverysuburb'), "delivery");

                        autoCompleter.addressAutoComplete($('#billingaddress'), "billing");
                        autoCompleter.suburbAutoComplete($('#billingsuburb'), "billing");
                    }
                },
                'view-depots': {
                    init: function(){
                        var dt_options = {
                            "columnDefs": [
                                { "orderable": false, "targets": [1,2,3] },
                                { "searchable": false, "targets": [3]}
                            ],
                            "order": [],
                            "mark": true
                        }
                        var table = dataTable.init($('table#depot_list_table'), dt_options );
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>