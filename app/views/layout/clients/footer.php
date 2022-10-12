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
                                i: contact_count
                            }
                            $.post(url, data, function(d){
                                $('div#contacts_holder').append(d.html);
                                actions.common.deactivateContact();
                            });
                        });
                        $("a.remove-all-contacts").click(function(e){
                            e.preventDefault();
                            $('div#contacts_holder div.acontact').not(':first').remove();
                        });
                    },
                    deactivateContact: function(){
                        $('input.deactivate').each(function(i,e){
                            //console.log("no click yet "+this.id);
                            $(this).off('change').change(function(ev){
                                //console.log("Is checked: "+this.checked);
                                var ind = this.id.split("_")[1];
                                console.log("inf: "+ind);
                            })
                        });
                    }
                },
                'add-client': {
                    init: function(){
                        actions.common.init();
                        actions.common.addContact();
                        $('form#client_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Adding Client...</h2></div>' });
                            }
                        });
                    }
                },
                'edit-client':{
                    init: function(){
                        actions.common.init();
                        actions.common.addContact(true);
                        actions.common.deactivateContact();
                        $('form#client_edit').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Updating Client Details...</h2></div>' });
                            }
                        });
                    }
                },
                'view-clients': {
                    init: function(){
                        var dt_options = {
                            "columnDefs": [
                                { "orderable": false, "targets": [1,2,3] },
                                { "searchable": false, "targets": [3]}
                            ],
                            "order": [],
                            "mark": true
                        }
                        var table = dataTable.init($('table#client_list_table'), dt_options );
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>