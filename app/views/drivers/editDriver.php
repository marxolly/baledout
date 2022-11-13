<?php
//name, compay_name, abn are required
$name           = empty(Form::value('name'))?           $driver['name']         : Form::value('name');
$company_name   = empty(Form::value('company_name'))?   $driver['company_name'] : Form::value('company_name');
$abn            = empty(Form::value('abn'))?            $driver['abn']          : Form::value('company_name');
//is driver active
$active = ( $driver['active'] == 1 );
//address is not required
$aa = array();
if(!empty($driver['a_string']))
{
    list($aa['address'], $aa['address2'],$aa['suburb'],$aa['state'],$aa['postcode']) = explode('|', $driver['da_string']);
}
$address   = empty(Form::value('address'))?    isset($aa['address'])?  $aa['address']     : "" : Form::value('address');
$address2  = empty(Form::value('address2'))?   isset($aa['address2'])? $aa['address2']    : "" : Form::value('address2');
$suburb    = empty(Form::value('suburb'))?     isset($aa['suburb'])?   $aa['suburb']      : "" : Form::value('suburb');
$state     = empty(Form::value('state'))?      isset($aa['state'])?    $aa['state']       : "" : Form::value('state');
$postcode  = empty(Form::value('postcode'))?   isset($aa['postcode'])? $aa['postcode']    : "" : Form::value('postcode');
//other non required driver info
$phone     = empty(Form::value('phone'))?   $driver['phone'] : Form::value('phone');
//non editable info
$email = $driver['email'];
$ppp = DOC_ROOT.'/images/profile_pictures/'.$driver['profile_picture'];
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/clients/view-clients/" class="btn btn-outline-bo has-spinner">Return to Client List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php echo "<pre>",print_r($driver),"</pre>";?>
    </div>
</div>