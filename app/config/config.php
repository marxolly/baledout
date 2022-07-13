<?php

 /**
  * This file contains configuration for the application.
  * It will be used by app/core/Config.php
  *
  * @author     Mark Solly <mark.solly@fsg.com.au>
  */

return array(
    /**
     * Configuration for: Paths
     * Paths from App directory
     */
    "VIEWS_PATH"            => APP . "views/",
    "ERRORS_PATH"           => APP . "views/errors/",
    "LOGIN_PATH"            => APP . "views/login/",
    "ADMIN_VIEWS_PATH"      => APP . "views/admin/",
    "EMAIL_TEMPLATES_PATH"  => APP . "email_templates/",
    "EMAIL_ATTACHMENTS_PATH"  => APP . "email_attachments/",

    /**
     * Configuration for: Cookies
     *
     * COOKIE_RUNTIME: How long should a cookie be valid by seconds.
     *      - 1209600 means 2 weeks
     *      - 604800 means 1 week
     * COOKIE_DOMAIN: The domain where the cookie is valid for.
     *      COOKIE_DOMAIN mightn't work with "localhost", ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
     *      @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
     *      @see http://php.net/manual/en/function.setcookie.php#73107
     *
     * COOKIE_PATH: The path where the cookie is valid for. If set to '/', the cookie will be available within the entire COOKIE_DOMAIN.
     * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection
     * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
     * COOKIE_SECRET_KEY: A random value to make the cookie more secure. Now Stored in database
     *
     */
    "COOKIE_EXPIRY"         => 1209600,
    "SESSION_COOKIE_EXPIRY" => 604800,
    "COOKIE_DOMAIN"         => '',
    "COOKIE_PATH"           => '/',
    "COOKIE_SECURE"         => true,
    "COOKIE_HTTP"           => true,

    /**
     * Configuration for Email
     *
     */
    "EMAIL_FROM"        => "no-reply@baledout.com.au",
    "EMAIL_FROM_NAME"   => "Baledout Pty Ltd",
    "EMAIL_REPLY_TO"    => "no-reply@baledout.com.au",

    "EMAIL_PASSWORD_RESET_URL" => PUBLIC_ROOT . "login/resetPassword",


    /**
     * Configuration for: Hashing strength
     *
     * It defines the strength of the password hashing/salting. "10" is the default value by PHP.
     * @see http://php.net/manual/en/function.password-hash.php
     *
     */
    "HASH_COST_FACTOR" => "10",

    /**
     * Configuration for: Pagination
     *
     */
    "PAGINATION_DEFAULT_LIMIT" => 10,

    /*************************************************************************
    * Max Shipping Price Allowed Without Checking
    **************************************************************************/
    'MAX_SHIPPING_CHARGE' => 80,

    /*************************************************************************
    * Baledout Address
    **************************************************************************/
    "BALEDOUT_ADDRESS" => array(
      	'address'	=>	'',
		'address_2'	=>	'',
		'suburb'	=>	'',
		'city'		=>	'',
		'state'		=>	'SA',
		'country'	=>	'AU',
		'postcode'	=>	''
	)

    
    /**
    * Order status
    *
    */

);
