<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="add-userrole"  method="post" enctype="multipart/form-data" action="/form/procUserRoleAdd">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Add New Role</h3>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <div class="col-md-4 offset-md-3">
                                <input type="text" class="form-control required" name="name" id="name" value="<?php echo Form::value('name');?>" />
                                <?php echo Form::displayError('name');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Add The Row</h3>
                        </div>
                   </div>
                   <div class="p-3 light-grey mb-3">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-3 text-center text-md-start">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Submit The Form</button>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12">
                <h2>Current User Roles</h2>
            </div>
        </div>
        <?php if(count($roles)):?>
            <div id="sortable">
                <?php foreach($roles as $r):?>
                    <form class="edit-userrole" action="/form/procUserRoleEdit" method="post">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="row">
                                    <label class="col-4">Name</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control required userrolename" name="name_<?php echo $r['id'];?>" id="name_<?php echo $r['id'];?>" value="<?php echo ucwords($r['name']);?>" />
                                    </div>
                                    <input type="hidden" name="currentname_<?php echo $r['id'];?>" value="<?php echo $r['name'];?>"/>
                                    <?php echo Form::displayError("name_{$r['id']}");?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="active_<?php echo $r['id'];?>" name="active_<?php echo $r['id'];?>" <?php if($r['active'] > 0) echo "checked";?> />
                                    <label class="custom-control-label" for="active_<?php echo $r['id'];?>">Active</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                                <input type="hidden" name="line_id" value="<?php echo $r['id'];?>" />
                                <button type="submit" class="btn btn-outline-secondary">Update</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach;?>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <h2><i class="fas fa-exclamation-triangle"></i> No User Roles Listed</h2>
                        <p>You will need to add some first</p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>