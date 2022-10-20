<?php
//client_name is required
$client_name    = empty(Form::value('client_name'))?    $client['client_name']  : Form::value('client_name');
//is client active
$active = ( $client['active'] == 1 );
//delivery_address is not required
$daa = array();
if(!empty($client['da_string']))
{
    list($daa['address'], $daa['address2'],$daa['suburb'],$daa['state'],$daa['postcode']) = explode('|', $client['da_string']);
}
$deliveryaddress   = empty(Form::value('deliveryaddress'))?    isset($daa['address'])?  $daa['address']     : "" : Form::value('deliveryaddress');
$deliveryaddress2  = empty(Form::value('deliveryaddress2'))?   isset($daa['address2'])? $daa['address2']    : "" : Form::value('deliveryaddress2');
$deliverysuburb    = empty(Form::value('deliverysuburb'))?     isset($daa['suburb'])?   $daa['suburb']      : "" : Form::value('deliverysuburb');
$deliverystate     = empty(Form::value('deliverystate'))?      isset($daa['state'])?    $daa['state']       : "" : Form::value('deliverystate');
$deliverypostcode  = empty(Form::value('deliverypostcode'))?   isset($daa['postcode'])? $daa['postcode']    : "" : Form::value('deliverypostcode');
//postal_address is not required
$baa = array();
if(!empty($client['ba_string']))
{
    list($baa['address'], $baa['address2'],$baa['suburb'],$baa['state'],$baa['postcode']) = explode('|', $client['ba_string']);
}
$billingaddress   = empty(Form::value('billingaddress'))?    isset($baa['address'])?  $baa['address']     : "" : Form::value('billingaddress');
$billingaddress2  = empty(Form::value('billingaddress2'))?   isset($baa['address2'])? $baa['address2']    : "" : Form::value('billingaddress2');
$billingsuburb    = empty(Form::value('billingsuburb'))?     isset($baa['suburb'])?   $baa['suburb']      : "" : Form::value('billingsuburb');
$billingstate     = empty(Form::value('billingstate'))?      isset($baa['state'])?    $baa['state']       : "" : Form::value('billingstate');
$billingpostcode  = empty(Form::value('billingpostcode'))?   isset($baa['postcode'])? $baa['postcode']    : "" : Form::value('billingpostcode');
//other non required client info
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
$required = true;
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
        <?php //echo "<pre>",print_r($client),"</pre>";?>
        <form id="client_edit" method="post" enctype="multipart/form-data" action="/form/procClientEdit">
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
                        <div class="form-group row mb-3">
                            <label class="col-md-3 text-start d-none d-md-block" for="active">Active</label>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" <?php if($active) echo 'checked';?>>
                                    <label class="form-check-label d-md-none" for="active">Active</label>
                                </div>
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
                            <h3>Client Address</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="row">
                            <div class="col">
                                <h4>Delivery Address</h4>
                            </div>
                        </div>
                        <?php $prefix = "delivery"; include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="row">
                            <div class="col">
                                <h4>Billing Address</h4>
                                <p class="inst">If different to Delivery address</p>
                            </div>
                        </div>
                        <?php $prefix = "billing"; include(Config::get('VIEWS_PATH')."layout/page-includes/forms/address_nr.php");?>
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
                                <input type="hidden" name="client_id" value="<?php echo $client['id'];?>" >
                                <button type="submit" class="btn btn-outline-bo" id="submitter">Edit This Client</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>