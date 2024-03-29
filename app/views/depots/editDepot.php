<?php
//depot name and abbreviation is required
$depot_name    = empty(Form::value('depot_name'))?    $depot['depot_name']  : Form::value('depot_name');
$abbreviation  = empty(Form::value('abbreviation'))?  $depot['abbreviation']: Form::value('abbreviation');
//is depot active
$active = ( $depot['active'] == 1 );
//address is not required
$aa = array();
if(!empty($depot['a_string']))
{
    list($aa['address'], $aa['address2'],$aa['suburb'],$aa['state'],$aa['postcode']) = explode('|', $depot['a_string']);
}
$address   = empty(Form::value('address'))?    isset($aa['address'])?  $aa['address']     : "" : Form::value('address');
$address2  = empty(Form::value('address2'))?   isset($aa['address2'])? $aa['address2']    : "" : Form::value('address2');
$suburb    = empty(Form::value('suburb'))?     isset($aa['suburb'])?   $aa['suburb']      : "" : Form::value('suburb');
$state     = empty(Form::value('state'))?      isset($aa['state'])?    $aa['state']       : "" : Form::value('state');
$postcode  = empty(Form::value('postcode'))?   isset($aa['postcode'])? $aa['postcode']    : "" : Form::value('postcode');
//other non required depot info
$phone     = empty(Form::value('phone'))?      $depot['phone']        : Form::value('phone');
$email     = empty(Form::value('email'))?      $depot['email']        : Form::value('email');
$website   = empty(Form::value('website'))?    $depot['website']      : Form::value('website');
//create the contacts array
$contacts  = empty(Form::value('contacts'))?   $depot['contacts']     : Form::value('contacts');
if(!is_array($contacts))
{
    $contact_array = array();
    if(!empty($contacts))
    {
        $ca = explode("~", $contacts);
        foreach($ca as $c)
        {
            list($a['contact_id'], $a['name'],$a['role'],$a['email'],$a['phone']) = explode('|', $c);
            $contact_array[] = $a;
        }
    }
}
else
{
    $contact_array = $contacts;
}
$required = false;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/depots/view-depots/" class="btn btn-outline-bo has-spinner">Return to Depot List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php //echo "<pre>",print_r($depot),"</pre>";?>
        <form id="depot_edit" method="post" action="/form/procDepotEdit">
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
                                <input type="text" class="form-control required" name="depot_name" id="depot_name" value="<?php echo $depot_name;?>" />
                                <?php echo Form::displayError('depot_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup>Depot Abbreviation<br><span class="inst">abbreviations must be unique</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="abbreviation" id="abbreviation" value="<?php echo $abbreviation;?>" />
                                <?php echo Form::displayError('abbreviation');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 text-start d-none d-md-block" for="active">Active</label>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" <?php if($active) echo 'checked';?>>
                                    <label class="form-check-label d-md-none" for="active">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone;?>" />
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control email" name="email" id="email" value="<?php echo $email;?>" />
                                <?php echo Form::displayError('email');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Website</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="website" id="website" value="<?php echo $website;?>" />
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
                        </div>
                        <div class="col-md-3">
                            <a class="add-contact" style="cursor:pointer" title="Add Another Contact"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                        </div>
                    </div>
                    <div id="contacts_holder" class="p-3 light-grey mb-3">
                        <?php //echo "<pre>", var_dump($contact_array) ,"</pre>";//die(); ?>
                        <?php
                        if(!empty($contact_array)):
                            foreach($contact_array as $i => $d)
                            {
                                include(Config::get('VIEWS_PATH')."layout/page-includes/forms/edit_customer_contact.php");
                            }
                        else:
                            include(Config::get('VIEWS_PATH')."layout/page-includes/forms/edit_customer_contact.php");
                        endif;?>
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
                                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" >
                                <input type="hidden" name="depot_id" value="<?php echo $depot['id'];?>" >
                                <input type="hidden" name="current_abbreviation" id="current_abbreviation" value="<?php echo $depot['abbreviation']; ?>" >
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Edit This Depot</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
