<?php
    $link_text = (!$active)? "<a href='/clients/view-clients' class='btn btn-outline-bo'>View Active Clients</a>" : "<a href='/clients/view-clients/active=0' class='btn btn-outline-bo'>View Inactive Clients</a>";
    $i = 1;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
    </div>
</div>