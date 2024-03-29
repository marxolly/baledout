<?php
if(!isset($prefix))
    $prefix = "";
?>
<div class="form-group row mb-3">
    <label class="col-md-3">Address Line 1</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="<?php echo $prefix;?>address" id="<?php echo $prefix;?>address" value="<?php echo ${$prefix."address"};?>" />
        <?php echo Form::displayError($prefix.'address');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">Address Line 2</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="<?php echo $prefix;?>address2" id="<?php echo $prefix;?>address2" value="<?php echo ${$prefix."address2"};?>" />
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">Suburb/Town</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="<?php echo $prefix;?>suburb" id="<?php echo $prefix;?>suburb" value="<?php echo ${$prefix."suburb"};?>" />
        <?php echo Form::displayError($prefix.'suburb');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">State</label>
    <div class="col-md-4">
        <select id="<?php echo $prefix;?>state" name="<?php echo $prefix;?>state" class="form-control selectpicker" data-style="btn-outline-bo"><option value="0">--Select One--</option><?php echo Utility::getStateSelect(${$prefix."state"});?></select>
        <?php echo Form::displayError($prefix.'state');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3 ">Postcode</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="<?php echo $prefix;?>postcode" id="<?php echo $prefix;?>postcode" value="<?php echo ${$prefix."postcode"};?>" />
        <?php echo Form::displayError($prefix.'postcode');?>
    </div>
</div>