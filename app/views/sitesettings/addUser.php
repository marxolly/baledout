<?php
$display = (!empty(Form::value('role_id')) && Form::value('role_id') == $client_role_id)? "block" : "none";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row errorbox">
            <div class="col">
                <p class="text-danger">Drivers cannot be added here.<br>
                To add a Driver User, click <a href="/drivers/add-driver">this link</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="add_user" method="post" action="/form/procUserAdd">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>User Details</h3>
                            <p class="inst">fields marked <sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> are required</p>

                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="name" id="name" value="<?php echo Form::value('name');?>" />
                                <?php echo Form::displayError('name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required email" name="email" id="email" value="<?php echo Form::value('email');?>" />
                                <?php echo Form::displayError('email');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Role</label>
                            <div class="col-md-4">
                                <select id="role_id" name="role_id" class="form-control selectpicker" data-style="btn-outline-secondary"><option value="0">--Select One--</option><?php echo $this->controller->user->getSelectUserRoles(Form::value('role_id'), ['driver']);?></select>
                                <?php echo Form::displayError('role_id');?>
                            </div>
                        </div>
                        <div id="client_holder" style="display: <?php echo $display;?>">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Client</label>
                                <div class="col-md-4">
                                    <select id="client_id" name="client_id" class="form-control selectpicker" data-style="btn-outline-secondary"><option value="0">--Select One--</option><option>list clients here</option></select>
                                    <?php echo Form::displayError('client_id');?>
                                </div>
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
                            <h3>Add The User</h3>
                        </div>
                   </div>
                   <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <input type="hidden" name="client_role_id" id="client_role_id" value="<?php echo $client_role_id;?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Submit The Form</button>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </form>
    </div>
</div>