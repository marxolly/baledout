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
                    addContact: function(edit){
                        if(edit === undefined) {
                            edit = false;
                        }
                        var url = (edit)? "/ajaxfunctions/editClientContact" : "/ajaxfunctions/addClientContact"
                        $("a.add-contact").click(function(e){
                            e.preventDefault();
                            var contact_count = $("div#contacts_holder div.acontact").length;
                            //console.log('packages: '+contact_count);
                            var data = {
                                i: contact_count,
                                required: false
                            }
                            $.post(url, data, function(d){
                                $('div#contacts_holder').append(d.html);
                                //actions.common.deactivateContact();
                            });
                        });
                        $("a.remove-all-contacts").click(function(e){
                            e.preventDefault();
                            $('div#contacts_holder div.acontact').not(':first').remove().find('input').each(function(i,e){
                                $(this).val('');
                            });
                        });

                    }
                },
                'add-depot': {
                    init: function(){
                        actions.common.init();
                        actions.common.addContact();
                        $('form#depot_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Adding Depot...</h2></div>' });
                            }
                        });
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