        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        autoCompleter.addressAutoComplete($('#address'));
                        autoCompleter.suburbAutoComplete($('#suburb'));
                    },
                    'format-abn': function(value){
                        value = value.split(" ").join("");
                        return [
                            value.slice(0, 2),
                            value.slice(2, 5),
                            value.slice(5, 8),
                            value.slice(8, 11)
                        ].join(" ").trim();
                    }
                },
                'add-driver': {
                    init: function(){
                        actions.common.init();
                        $('input#abn').on('keyup keypress blur change', function(ev){
                            var abn = $(this).val();
                            $(this).val(actions.common['format-abn'](abn));
                        })
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
                        var abn = $('input#abn').val()
                        $('input#abn').val(actions.common['format-abn'](abn));
                        $('input#abn').on('keyup keypress blur change', function(ev){
                            abn = $(this).val();
                            $(this).val(actions.common['format-abn'](abn));
                        });
                        $('form#driver_edit').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Updating Driver Details...</h2></div>' });
                            }
                        });
                    }
                },
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