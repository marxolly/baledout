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
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/depots/view-depots/" class="btn btn-outline-bo">Return to Depot List</a></p>
            </div>
        </div>
    </div>
</div>