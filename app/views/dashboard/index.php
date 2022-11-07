<?php
$panel_classes = array(
    'primary',
    'info',
    'success',
    'warning',
    'danger'
);
$c = 1;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <p>USER ROLE: <?php echo $user_role;?></p>
        <?php if($user_role == "admin"):
            //---------------------------------------------------------------------------------------------------------
            //---------------------------------------     Warehouse Users     -----------------------------------------
            //--------------------------------------------------------------------------------------------------------
            //include(Config::get('VIEWS_PATH')."layout/page-includes/home_pages/warehouse_home.php");
            include(Config::get('VIEWS_PATH')."layout/page-includes/home_pages/admin_home.php");
        elseif($user_role == "driver"):
            //--------------------------------------------------------------------------------------------------------
            //---------------------------------------     Client Users     ------------------------------------------
            //-------------------------------------------------------------------------------------------------------
            include(Config::get('VIEWS_PATH')."layout/page-includes/home_pages/driver_home.php");
        elseif($user_role == "client"):
            //--------------------------------------------------------------------------------------------------------
            //---------------------------------------     Client Users     ------------------------------------------
            //-------------------------------------------------------------------------------------------------------
            include(Config::get('VIEWS_PATH')."layout/page-includes/home_pages/client_home.php");
        else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <div class="row">
                            <div class="col-lg-2" style="font-size:96px">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="col-lg-6">
                                <h2>User Classification Error</h2>
                                <p>Sorry, there has been an error determining your access priviledges</p>
                                <p><a href="/login/logout">Please click here to login again</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>