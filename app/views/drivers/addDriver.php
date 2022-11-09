<?php
$address = Form::value('address');
$address2 = Form::value('address2');
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');

$required = true;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/drivers/view-drivers/" class="btn btn-outline-bo has-spinner">Return to Driver List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="driver_add" method="post" action="/form/procDriverAdd">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Driver Login Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="name" id="name" value="<?php echo Form::value('name');?>" />
                                <?php echo Form::displayError('name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required email" name="email" id="email" value="<?php echo Form::value('email');?>" placeholder="They will use this to login" >
                                <?php echo Form::displayError('email');?>
                            </div>
                        </div>
                        <?php if(Session::getUserRole() == "super admin"):?>
                             <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label text-end d-none d-md-block" for="test_user">Test User</label>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="test_user" name="test_user" <?php if(!empty(Form::value('test_user'))) echo 'checked';?>>
                                        <label class="form-check-label d-md-none" for="test_user">Test User</label>
                                    </div>
                                </div>
                             </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Driver Business Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Company Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="company_name" id="company_name" value="<?php echo Form::value('company_name');?>" />
                                <?php echo Form::displayError('company_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> ABN</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="abn" id="abn" value="<?php echo Form::value('abn');?>" />
                                <?php echo Form::displayError('abn');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo Form::value('phone');?>" />
                            </div>
                        </div>
                        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Add The Driver</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Submit Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>