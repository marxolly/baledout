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
            <?php echo "<pre>",print_r($drivers),"</pre>";die();?>
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