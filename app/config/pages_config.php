<?php
    /**
     * The pages for the app
     * Pages must be listed here or a 404 error will be thrown
     * @format
     * user_access  => array(
     *      controller   => array(
     *                  page-name   => array(
     *                      display-in-menu => boolean  (true/false)
     *                      icon-to-display => string   (fontawesone class)
     *              (
     *       )
     * )
     * @author     Mark Solly <mark.solly@fsg.com.au>
    */
include(APP."/config/icons.php");

$admin = array(
    /*
   'orders' => array(
        'orders-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => $fontastic_icons['orders']['default']
        )
    ),
    */
    'jobs'      => array(
        'jobs-index'    => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => $fontastic_icons['jobs']['default']
        ),
    ),
    'deliveries'    => array(
        'deliveries-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-truck fa-2x"></i>'
        ),
    ),
    'clients'	=> array(
        'clients-index' => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-user-tie fa-2x"></i>'
        )
    ),
    'financials'    => array(
        'financials-index'  => true,
        'default-icon'      => array(
            'display'   => false,
            'icon'      => $fontastic_icons['financials']['default']
        ),
    ),
    'reports'   => array(
        'reports-index' => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-chart-bar fa-2x"></i>'
        )
    ),
    'data-entry'    =>  array(
        'data-entry-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-indent fa-2x"></i>'
        )
    ),
    'site-settings'		=> array(
        'site-settings-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-cog fa-2x"></i>'
        ),/**/
        'manage-users'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-users"></i></div>'
        ),
        'user-roles'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-users-cog"></i></div>'
        ),
        'edit-user-profile'    => array(
            'display'   => false,
            'icon'      => ''
        ),
        'add-user'    => array(
            'display'   => false,
            'icon'      => ''
        ),
        'drivers'   => array(
            'display'   => true,
            //'icon'      => '<span class="fa-layers fa-fw fa-3x align-middle"><i class="fal fa-user"></i><i class="fad fa-steering-wheel" data-fa-transform="shrink-6 down-6"></i></span>'
            'icon'      => '<span class="fa-3x align-middle"><i class="fad fa-steering-wheel" data-fa-transform="shrink-6 down-6" data-fa-mask="fad fa-user"></i></span>'
        )
    ),
    'downloads' => array(
        'downloads-index'   => true,
        'super_admin_only'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-download fa-2x"></i>'
        )
    ),
    'admin-only'    => array(
        'admin-only-index'  => true,
        'super_admin_only'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-lock-alt fa-2x"></i>'
        )
    )
);
$client = array(
    'deliveries'    => array(
        'delivery-clients'  => true,
        'deliveries-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-truck fa-2x"></i>'
        )
    ),
    'orders'			=>	array(
        'delivery-clients'  => false,
        'orders-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-truck fa-2x"></i>'
        ),
        'client-orders' =>  array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-th-list"></i></div>'
        ),
        'order-detail'    => array(
            'display'   => false,
            'icon'      => ''
        ),
        'order-tracking'    => array(
            'display'   => false,
            'icon'      => ''
        ),
        'add-order' =>  array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-shipping-fast"></i></div>'
        ),
        'bulk-upload-orders' =>  array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-upload"></i></div>'
        )
    ),
    'inventory'			=>	array(
        'inventory-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-warehouse-alt fa-2x"></i>'
        ),
    ),
    'reports'           =>  array(
        'reports-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-chart-bar fa-2x"></i>'
        )
    )
);

//merge and tidy page arrays


//add the errors pages
//echo "<pre>",print_r($admin),"</pre>";die();
//return the pages
return array(
    "ADMIN_PAGES"                     => $admin ,
    'CLIENT_PAGES'                    => $client
)
?>