        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                'add-user':{
                    init: function(){
                        $('select#role_id').change(function(e){
                            if($(this).val() == $('#client_role_id').val())
                            {
                                $('#client_holder').slideDown();
                                $('#client_id').rules('add', 'notNone');
                            }
                            else
                            {
                                $('#client_holder').slideUp();
                                $('#client_id').rules('remove');
                            }
                            $(this).valid();
                        });
                        $('select#role_id, select#client_id').change(function(e){
                            $(this).valid();
                        });
                        $('form#add_user').submit(function(){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Adding user and sending email...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                    }
                },
                'manage-users': {
                    init: function(){

                    }
                },
                'user-roles': {
                    init: function(){
                        /*
                        $.validator.addClassRules("userrolename", {
                            uniqueUserRole : {
                                url: '/ajaxfunctions/checkRoleNames',
                                //data: { 'term': function(){ return $(this).val(); } }
                            }
                        });
                        */
                        $( "#sortable" ).sortable();
                        $('form#add-userrole').submit(function(){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Processing form...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                        $("form.edit-userrole").each(function(i,e){
                            $(this).submit(function(e){
                                if($(this).valid())
                                {
                                    $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Editing User Role...</h2></div>' });
                                }
                                else
                                {
                                    return false;
                                }
                            });
                        })
                    }
                },
                'view-typography':{
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