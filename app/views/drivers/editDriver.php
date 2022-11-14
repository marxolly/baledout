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
    list($aa['address'], $aa['address2'],$aa['suburb'],$aa['state'],$aa['postcode']) = explode('|', $driver['a_string']);
}
$address   = empty(Form::value('address'))?    isset($aa['address'])?  $aa['address']     : "" : Form::value('address');
$address2  = empty(Form::value('address2'))?   isset($aa['address2'])? $aa['address2']    : "" : Form::value('address2');
$suburb    = empty(Form::value('suburb'))?     isset($aa['suburb'])?   $aa['suburb']      : "" : Form::value('suburb');
$state     = empty(Form::value('state'))?      isset($aa['state'])?    $aa['state']       : "" : Form::value('state');
$postcode  = empty(Form::value('postcode'))?   isset($aa['postcode'])? $aa['postcode']    : "" : Form::value('postcode');
//other non required driver info
$phone     = empty(Form::value('phone'))?   $driver['phone'] : Form::value('phone');
//non editable info
//$email = $driver['email'];
$ppp = DOC_ROOT.'/images/profile_pictures/'.$driver['profile_picture'];
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-end">
                <p><a href="/drivers/view-drivers/" class="btn btn-outline-bo has-spinner">Return to Driver List</a></p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php //echo "<pre>",print_r($driver),"</pre>";?>
        <form id="driver_edit" method="post" action="/form/procDriverEdit">
            <div class="row">
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Driver Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                            <p class="inst">Email is used as a username, so cannot be changed</p>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="name" id="name" value="<?php echo $name;?>" />
                                <?php echo Form::displayError('name');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                    <div class="row">
                        <div class="col">
                            <h3>Driver Business Details</h3>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/forms/required_fields.php");?>
                        </div>
                    </div>
                    <div class="p-3 light-grey mb-3">
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Company Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="company_name" id="company_name" value="<?php echo $company_name;?>" />
                                <?php echo Form::displayError('company_name');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> ABN</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control required" name="abn" id="abn" value="<?php echo $abn;?>" />
                                <?php echo Form::displayError('abn');?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone;?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>