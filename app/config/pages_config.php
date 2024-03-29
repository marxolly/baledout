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
        'view-jobs'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-binoculars" data-fa-transform="shrink-10 up-3 left-3 rotate-30"></i></span></div>'
        ],
        'search-jobs' => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-search" data-fa-transform="shrink-10 up-3 left-3"></i></span></div>'
        ],
        'edit-job'  => [
            'display'   => false,
            'icon'      => ''
        ]
    ),
    'clients'	=> array(
        'clients-index' => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-user-tie fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-user-tie d-lg-none"></i>'
        ),
        'add-client'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-user-tie"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-5 right-8"></i></span></div>'
        ],
        'view-clients'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-user-tie"></i><i class="fa-solid fa-binoculars" data-fa-transform="shrink-10 up-3 right-6 rotate-30"></i></span></div>'
        ],
        'edit-client'   => [
            'display'   => false,
            'icon'      => ''
        ]
    ),
    'depots'    => array(
        'depots-index'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fa-duotone fa-warehouse-full fa-2x"></i>',
            'menu-icon' => '<i class="fa-duotone fa-warehouse-full d-lg-none"></i>'
        ),
        'add-depot'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-warehouse-full"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-6 right-12"></i></span></div>'
        ],
        'view-depots'   => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-warehouse-full"></i><i class="fa-solid fa-binoculars" data-fa-transform="shrink-10 down-2 right-1 rotate-30"></i></span></div>'
        ],
        'edit-depot'  => [
            'display'   => false,
            'icon'      => ''
        ]
    ),
    'drivers'   => array(
        'drivers-index' => true,
        'default-icon'  => array(
            'display'   => false,
            //'icon'      => '<span class="fa-2x align-middle"><i class="fa-regular fa-steering-wheel" data-fa-transform="shrink-6 down-4" data-fa-mask="fa-solid fa-user"></i></span>',
            'icon'      => '<span class="fa-stack fa-2x"><i class="fa-duotone fa-user fa-stack-1x"></i><i class="fa-regular fa-stack-1x fa-steering-wheel fa-inverse" data-fa-transform="shrink-6 down-4"></i></span>',
            'menu-icon' => '<span class="align-middle d-lg-none"><i class="fa-regular fa-steering-wheel" data-fa-transform="shrink-6 down-4" data-fa-mask="fa-solid fa-user"></i></span>'
        ),
        'add-driver'    => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-regular fa-steering-wheel" data-fa-transform="shrink-6 down-4" data-fa-mask="fa-duotone fa-user"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-6 right-8"></i></span></div>'
        ],
        'edit-driver'   => [
            'display'   => false,
            'icon'      => ''
        ],
        'view-drivers'    => [
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-regular fa-steering-wheel" data-fa-transform="shrink-6 down-4" data-fa-mask="fa-duotone fa-user"></i><i class="fa-solid fa-binoculars" data-fa-transform="shrink-10 up-6 right-8 rotate-30"></i></span></div>'
        ]
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
        'data-entry-index'  => false,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-indent fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-indent d-lg-none"></i>'
        )
    ),
    'portal-users'  => array(
        'portal-users-index'    => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fa-duotone fa-people-group fa-2x"></i>',
            'menu-icon' => '<i class="fa-duotone fa-people-group d-lg-none"></i>'
        ),
        'manage-users'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-people-line"></i></div>'
        ),
        'user-roles'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fad fa-users-cog"></i></div>'
        ),
        'add-user'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><span class="fa-layers fa-fw"><i class="fa-duotone fa-user"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-5 right-8"></i></span></div>'
        )
    ),
    'site-settings'		=> array(
        'site-settings-index'   => false,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-cog fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-cog d-lg-none"></i>'
        ),/**/
        'view-typography'   => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fa-light fa-kerning"></i></div>'
        ),
        'drivers'   => array(
            'display'   => false,
            //'icon'      => '<span class="fa-layers fa-fw fa-3x align-middle"><i class="fal fa-user"></i><i class="fad fa-steering-wheel" data-fa-transform="shrink-6 down-6"></i></span>'
            'icon'      => '<span class="fa-3x align-middle"><i class="fad fa-steering-wheel" data-fa-transform="shrink-6 down-6" data-fa-mask="fad fa-user"></i></span>'
        )
    ),
    'downloads' => array(
        'downloads-index'   => false,
        'super_admin_only'  => true,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fad fa-download fa-2x"></i>',
            'menu-icon' => '<i class="fad fa-download d-lg-none"></i>'
        )
    ),
    'contact-us'  => array(
        'contact-us-index'    => false,
        'default-icon'  => array(
            'display'   => false,
            'icon'      => '<i class="fa-duotone fa-envelopes-bulk fa-2x"></i>',
            'menu-icon' => '<i class="fa-duotone fa-envelopes-bulk d-lg-none"></i>'
        ),
        'send-a-message'    => array(
            'display'   => true,
            'icon'      => '<div class="fa-3x"><i class="fa-duotone fa-envelope-open-text"></i></div>'
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

//userpages to allow breadcrumbs to appear
$user =  array(
    'user-index'    => true,
    'default-icon'  => array(
        'display'   => false,
        'icon'      => '',
        'menu-icon' => ''
    ),
    'profile'   => array(
        'display'   => false,
        'icon'      => ''
    )
);
//$admin['user'] = $user;
//$client['user'] = $user;
//merge and tidy page arrays


//add the errors pages
//echo "<pre>",print_r($admin),"</pre>";die();
//return the pages
return array(
    "ADMIN_PAGES"                     => $admin ,
    'CLIENT_PAGES'                    => $client
)
?>