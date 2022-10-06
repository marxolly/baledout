<?php
$client_name    = empty(Form::value('client_name'))?    $client['client_name']  : Form::value('client_name');
$address        = empty(Form::value('address'))?        $client['address']      : Form::value('address');
$address2       = empty(Form::value('address2'))?       $client['address_2']    : Form::value('address2');
$suburb         = empty(Form::value('suburb'))?         $client['suburb']       : Form::value('suburb');
$state          = empty(Form::value('state'))?          $client['state']        : Form::value('state');
$postcode       = empty(Form::value('postcode'))?       $client['postcode']     : Form::value('postcode');

$phone          = empty(Form::value('phone'))?          $client['phone']        : Form::value('phone');
$email          = empty(Form::value('email'))?          $client['email']        : Form::value('email');
$website        = empty(Form::value('website'))?        $client['website']      : Form::value('website');

//create the contacts array
$contacts       = empty(Form::value('contacts'))?       $client['contacts']     : Form::value('contacts');
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
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/clients/view-clients/" class="btn btn-outline-bo">Return to Client List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php echo "<pre>",print_r($client),"</pre>";?>
        <form id="client_add" method="post" enctype="multipart/form-data" action="/form/procClientEdit">
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
                                <input type="text" class="form-control required" name="client_name" id="client_name" value="<?php echo $client_name;?>" />
                                <?php echo Form::displayError('client_name');?>
                            </div>
                        </div>
                        <?php if( !is_null($client['logo']) && !empty($client['logo']) ) :?>
                            <div class="form-group row">
                                <label class="col-md-3">Current Logo</label>
                                <div class="col-md-4">
                                    <img src="/images/client_logos/tn_<?php echo $client['logo'];?>" />
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 text-start d-none d-md-block" for="delete_logo">Delete Current Logo</label>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="delete_logo" name="delete_logo" <?php if(!empty(Form::value('delete_logo'))) echo 'checked';?>>
                                        <label class="form-check-label d-md-none" for="delete_logo">Delete Current Logo</label>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
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
                        <div class="col-md-6">
                            <h3>Client Contacts</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                            <p class="inst">At least one contact name is required</p>
                        </div>
                        <div class="col-md-3">
                            <a class="add-contact" style="cursor:pointer" title="Add Another Contact"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                        </div>
                        <div class="col-md-3">
                            <a class="remove-all-contacts" style="cursor:pointer" title="Leave Only First"><h4><i class="fad fa-times-square text-danger"></i> Leave only one contact</a></h4>
                        </div>
                    </div>
                    <div id="contacts_holder" class="p-3 light-grey mb-3">
                        <?php //echo "<pre>", var_dump($contact_array) ,"</pre>";//die(); ?>
                        <?php
                        if(!empty($contact_array)):
                            foreach($contact_array as $i => $d)
                            {
                                include(Config::get('VIEWS_PATH')."layout/page-includes/forms/add_customer_contact.php");
                            }
                        else:
                            include(Config::get('VIEWS_PATH')."layout/page-includes/forms/add_customer_contact.php");
                        endif;?>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Client Address</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>