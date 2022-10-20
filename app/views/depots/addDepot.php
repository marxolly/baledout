<?php
$address = Form::value('address');
$address2 = Form::value('address2');
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');
$required = false;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/depots/view-depots/" class="btn btn-outline-bo">Return to Depot List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="depot_add" method="post" action="/form/procDepotAdd">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Depot Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Depot Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="depot_name" id="depot_name" value="<?php echo Form::value('depot_name');?>" />
                                <?php echo Form::displayError('depot_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Depot Abbreviation<br><span class="inst">abbreviations must be unique</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="abbreviation" id="abbreviation" value="<?php echo Form::value('abbreviation');?>" />
                                <?php echo Form::displayError('abbreviation');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo Form::value('phone');?>" />
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control email" name="email" id="email" value="<?php echo Form::value('email');?>" />
                                <?php echo Form::displayError('email');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Depot Address</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Depot Contacts</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                        <div class="col-md-3">
                            <a class="add-contact" style="cursor:pointer" title="Add Another Contact"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                        </div>
                        <div class="col-md-3">
                            <a class="remove-all-contacts" style="cursor:pointer" title="Remove All Contacts"><h4><i class="fad fa-times-square text-danger"></i> Remove All Contacts</a></h4>
                        </div>
                    </div>
                    <div id="contacts_holder" class="p-3 light-grey mb-3">
                        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/add_customer_contact.php");?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Save Depot</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Add This Depot</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>