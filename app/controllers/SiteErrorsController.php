<?php

/**
 * Site Errors controller
 *
 * Used for App Errors generated by non supplied or bad database IDS
 *
 * Site Errors controller can be only accessed from within the application itself,
 * So, any request that has errors as controller will be considered as invalid
 *
 * @see App::isControllerValid()
 *

 * @author     Mark Solly <mark@baledout.com.au>
 */

class SiteErrorsController extends Controller{

    /**
     * Initialization method.
     *
     */
    public function initialize(){
    }

    public function noClientId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noClientId.php', [
            'pht'   => ": No Client ID"
        ]);
    }

    public function noClientFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noClientFound.php', [
            'pht'   => ": No Client Found"
        ]);
    }

    public function noDepotId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noDepotId.php', [
            'pht'   => ": No Depot ID"
        ]);
    }

    public function noDepotFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noDepotFound.php', [
            'pht'   => ": No Depot Found"
        ]);
    }

    public function noJobId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noJobId.php', [
            'pht'   => ": No Job ID"
        ]);
    }

    public function noJobFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noJobFound.php', [
            'pht'   => ": No Job Found"
        ]);
    }

}
