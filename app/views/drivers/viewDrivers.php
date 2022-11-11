<?php
    $link_text = (!$active)? "<a href='/drivers/view-drivers' class='btn btn-outline-bo has-spinner'>View Active Drivers</a>" : "<a href='/drivers/view-drivers/active=0' class='btn btn-outline-bo has-spinner'>View Inactive Drivers</a>";
    $i = 1;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col">
                <p class="text-right"><?php echo $link_text;?></p>
            </div>
        </div>
        <?php if(count($drivers)):?>
            <?php //echo "<pre>",print_r($drivers),"</pre>";die();?>
            <div id="waiting" class="row">
                <div class="col-lg-12 text-center">
                    <h2>Drawing Table..</h2>
                    <p>May take a few moments</p>
                    <img class='loading' src='/images/preloader.gif' alt='loading...' />
                </div>
            </div>
            <div class="row" id="table_holder" style="display:none">
                <div class="col-12">
                    <table id="driver_list_table" class="table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Current Job</th>
                                <th>Login Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($drivers as $d):
                                $at = "<h5>".$d['company_name']."<h5>";
                                if(!empty($d['phone'])) $at .= "<br>".$d['phone'];
                                if($d['address'] > 0)
                                {
                                    list($a_array['address'],$a_array['address_2'],$a_array['suburb']$a_array['state'],$a_array['postcode']) = explode("|", $d['a_string']);
                                    $at .= "<br>".Utility::formatAddressWeb($a_array);
                                }
                                ?>

                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
         <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <h2>No Drivers Listed</h2>
                        <p>You might want to <a href="/drivers/add-driver/">add one</a></p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>