<?php
$client_name    = empty(Form::value('client_name'))?    $client['client_name']      : Form::value('client_name');
$address        = empty(Form::value('address'))?    $client['address']      : Form::value('address');
$address2   = empty(Form::value('address2'))?   $client['address_2']    : Form::value('address2');
$suburb     = empty(Form::value('suburb'))?     $client['suburb']       : Form::value('suburb');
$state      = empty(Form::value('state'))?      $client['state']        : Form::value('state');
$postcode   = empty(Form::value('postcode'))?   $client['postcode']     : Form::value('postcode');  
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
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>