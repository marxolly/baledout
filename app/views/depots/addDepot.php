<?php
$address = Form::value('address');
$address2 = Form::value('address2');
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');

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
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup>Depot Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="depot_name" id="depot_name" value="<?php echo Form::value('depot_name');?>" />
                                <?php echo Form::displayError('depot_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup>Depot Abbreviation<br><span class="inst">abbreviations must be unique</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="abbreviation" id="abbreviation" value="<?php echo Form::value('abbreviation');?>" />
                                <?php echo Form::displayError('abbreviation');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>