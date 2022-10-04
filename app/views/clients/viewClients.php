<?php
    $link_text = (!$active)? "<a href='/clients/view-clients' class='btn btn-outline-bo'>View Active Clients</a>" : "<a href='/clients/view-clients/active=0' class='btn btn-outline-bo'>View Inactive Clients</a>";
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
        <?php if(!count($clients)):?>

        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <h2>No Clients Listed</h2>
                        <p>You might want to <a href="/clients/add-client/">add one</a></p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>