<?php
$deliveryaddress = Form::value('deliveryaddress');
$deliveryaddress2 = Form::value('deliveryaddress2');
$deliverysuburb = Form::value('deliverysuburb');
$deliverystate = Form::value('deliverystate');
$deliverypostcode = Form::value('deliverypostcode');

$billingaddress = Form::value('billingaddress');
$billingaddress2 = Form::value('billingaddress2');
$billingsuburb = Form::value('billingsuburb');
$billingstate = Form::value('billingstate');
$billingpostcode = Form::value('billingpostcode');

$required = true;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/clients/view-clients/" class="btn btn-outline-bo has-spinner">Return to Client List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="client_add" method="post" enctype="multipart/form-data" action="/form/procClientAdd">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Client Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup>Client Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="client_name" id="client_name" value="<?php echo Form::value('client_name');?>" />
                                <?php echo Form::displayError('client_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Logo</label>
                            <div class="col-md-4">
                                <input type="file" name="client_logo" id="client_logo" />
                                <?php echo Form::displayError('client_logo');?>
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
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Website</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="website" id="website" value="<?php echo Form::value('website');?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Client Contacts</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                            <p class="inst">At least one contact is required</p>
                        </div>
                        <div class="col-md-3">
                            <a class="add-contact" style="cursor:pointer" title="Add Another Contact"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                        </div>
                        <div class="col-md-3">
                            <a class="remove-all-contacts" style="cursor:pointer" title="Leave Only First"><h4><i class="fad fa-times-square text-danger"></i> Leave only one contact</a></h4>
                        </div>
                    </div>
                    <div id="contacts_holder" class="p-3 light-grey mb-3">
                        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/add_customer_contact.php");?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Client Addresses</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="row">
                            <div class="col">
                                <h4>Delivery Address</h4>
                            </div>
                        </div>
                        <?php $prefix = "delivery"; include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="row">
                            <div class="col">
                                <h4>Billing Address</h4>
                                <p class="inst">If different to Delivery address</p>
                            </div>
                        </div>
                        <?php $prefix = "billing"; include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Save Client</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Add This Client</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>