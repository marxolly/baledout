<div class="form-group row mb-3">
    <label class="col-md-3">Address Line 1</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" />
        <?php echo Form::displayError('address');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">Address Line 2</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $address2;?>" />
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">Suburb/Town</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="suburb" id="suburb" value="<?php echo $suburb;?>" />
        <?php echo Form::displayError('suburb');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3">State</label>
    <div class="col-md-4">
        <select id="state" name="state" class="form-control selectpicker" data-style="btn-outline-bo"><option value="0">--Select One--</option><?php echo Utility::getStateSelect($state);?></select>
        <?php echo Form::displayError('state');?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-md-3 ">Postcode</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $postcode;?>" />
        <?php echo Form::displayError('postcode');?>
    </div>
</div>