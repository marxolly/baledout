<?php
$name = (empty(Form::value('name')))? $info['name'] : Form::value('name');
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="profile_update" method="post" enctype="multipart/form-data" action="/form/procProfileUpdate">
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
                                <input type="text" class="form-control required" name="name" id="name" value="<?php echo $name;?>" />
                                <?php echo Form::displayError('name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control disabled" name="email" id="email" value="<?php echo $info['email'];?>" disabled />
                                <span class="inst">Email addresses cannot be changed. If you need to update yours, please contact us</span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Profile Image</label>
                            <div class="col-md-4">
                                <input type="file" name="image" id="image" />
                                <?php echo Form::displayError('image');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Current Image</label>
                            <div class="col-md-4">
                                <div class="col-md-4">
                                    <img src="<?php echo $info['image'];?>" class="thumbnail profile-thumb" />
                                </div>
                                <div class="col-md-6 checkbox checkbox-default">
                                    <input class="form-check-input styled" type="checkbox" id="delete_image" name="delete_image" />
                                    <label for="delete_image"><small><em>Revert to default</em></small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Log In Details</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">New Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="new_password" id="new_password" value="" />
                                <span class="inst">Leave blank if you don't want to change your password</span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Confirm New Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="conf_new_password" id="conf_new_password" value="" />
                                <span class="inst">If you wish to change your password, please retype your new password here</span>
                                <?php echo Form::displayError('conf_new_password');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Save Changes</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <input type="hidden" name="client_id" value="<?php echo $info['client_id'];?>" />
                                <input type="hidden" name="role_id" value="<?php echo $info['role_id'];?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Submit The Form</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
