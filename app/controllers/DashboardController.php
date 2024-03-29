<?php

/**
 * Dashboard controller
 *

 * @author     Mark Solly <mark@baledout.com.au>
 */

class DashboardController extends Controller
{
    /**
     * show dashboard page
     *
     */
    public function index()
    {
        //die('index controller');
        $jobs = array();
        $client_id = 0;
        $clients = array();
        $user_role = (Session::isAdminUser())? 'admin' : Session::getUserRole();;
        Config::setJsConfig('curPage', "dashboard");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/dashboard/", Config::get('VIEWS_PATH') . 'dashboard/index.php',[
            'pht'       =>  ": Home Page",
            'client_id' =>  $client_id,
            'jobs'      =>  $jobs,
            'clients'   =>  $clients,
            'user_role' =>  $user_role
        ]);
    }

    public function isAuthorized(){
        return true;
    }
}