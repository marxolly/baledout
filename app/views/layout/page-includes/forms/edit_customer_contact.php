<?php
$i = (isset($i))? $i : 0;
$details['c_id'] = isset($d['contact_id'])? $d['contact_id']:0;
$details['name'] = isset($d['name'])? $d['name']:"";
$details['role'] = isset($d['role'])? $d['role']:"";
$details['email'] = isset($d['email'])? $d['email']:"";
$details['phone'] = isset($d['phone'])? $d['phone']:"";
?>
<div class="p-3 light-grey mb-3 acontact">
    <div class="form-group row mb-3">
        <label class="col-md-2 text-start d-none d-md-block" for="contacts_<?php echo $i;?>_deactivate">Deactivate Contact</label>
        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="contacts_<?php echo $i;?>_deactivate" name="contacts[<?php echo $i;?>][Deactivate]" <?php if(!empty(Form::value('delete_logo'))) echo 'checked';?>>
                <label class="form-check-label d-md-none" for="contacts_<?php echo $i;?>_deactivate">Deactivate Contact</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 mb-3">Name</label>
        <div class="col-md-4 mb-3">
            <input type="text" class="form-control required" name="contacts[<?php echo $i;?>][name]" value="<?php echo $details['name'];?>" >
            <?php echo Form::displayError('contactname_'.$i);?>
        </div>
        <label class="col-md-2 mb-3">Role</label>
        <div class="col-md-4 mb-3">
            <input type="text" class="form-control" name="contacts[<?php echo $i;?>][role]" value="<?php echo $details['role'];?>" >
        </div>
        <label class="col-md-2 mb-3">Email</label>
        <div class="col-md-4 mb-3">
            <input type="text" class="form-control email" name="contacts[<?php echo $i;?>][email]" value="<?php echo $details['email'];?>" >
            <?php echo Form::displayError('contactemail_'.$i);?>
        </div>
        <label class="col-md-2 mb-3">Phone</label>
        <div class="col-md-4 mb-3">
            <input type="text" class="form-control" name="contacts[<?php echo $i;?>][phone]" value="<?php echo $details['phone'];?>" >
        </div>
        <input type="hidden" name="contacts[<?php echo $i;?>][contact_id]" value="<?php echo $details['c_id'];?>" >
    </div>
</div>