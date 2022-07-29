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
            'icon'      => '<i class="fa-duotone fa-truck-container fa-2x"></i>',
            'menu-icon' => '<i class="fa-duotone fa-truck-container d-lg-none"></i>'
        ),
        'add-job'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-5 right-10"></i></span></div>'
        ],
        'search-jobs'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-binoculars" data-fa-transform="shrink-10 up-7 right-8 rotate-30"></i></span></div>'
        ],
        'view-jobs' => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-search" data-fa-transform="shrink-4 up-1 right-4"></i></span></div>'
        ]
    ),
    'clients'	=> array(
        'clients-index' => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-user-tie fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-user-tie d-lg-none"></i>'
        )
    ),
    'depots'    => array(
        'depots-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fa-duotone fa-warehouse-full fa-2x"></i>',
            'menu-icon' => '<i class="fa-duotone fa-warehouse-full d-lg-none"></i>'
        )
    ),
    'financials'    => array(
        'financials-index'  => true,
        'default-icon'      => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-usd-circle fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-usd-circle d-lg-none"></i>'
        ),
    ),
    'reports'   => array(
        'reports-index' => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-chart-bar fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-chart-bar d-lg-none"></i>'
        )
    ),
    'data-entry'    =>  array(
        'data-entry-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-indent fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-indent d-lg-none"></i>'
        )
    ),
    'site-settings'		=> array(
        'site-settings-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-cog fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-cog d-lg-none"></i>'
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
        'view-typography'   => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fa-light fa-kerning"></i></div>'
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
            'icon'      => '<i class="fad fa-download fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-download d-lg-none"></i>'
        )
    ),
    'admin-only'    => array(
        'admin-only-index'  => true,
        'super_admin_only'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-lock-alt fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-lock-alt d-lg-none"></i>'
        )
    )
);
$client = array(
    'deliveries'    => array(
        'delivery-clients'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-truck d-lg-none"></i>'
        )
    ),
    'orders'			=>	array(
        'delivery-clients'  => false,
        'orders-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-truck d-lg-none"></i>'
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
            'icon'      => '<i class="fad fa-warehouse-alt d-lg-none"></i>'
        ),
    ),
    'reports'           =>  array(
        'reports-index'   => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-chart-bar d-lg-none"></i>'
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