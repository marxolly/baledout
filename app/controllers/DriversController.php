<?php

/**
 * Drivers controller
 *

 Manages Subcontracted Drivers

 * @author     Mark Solly <mark@baledout.com.au>
 */

class DriversController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'drivers-index');
        parent::displayIndex(get_class());
    }

    public function addDriver()
    {
        Config::setJsConfig('curPage', "add-driver");
        Config::set('curPage', "add-driver");
        return parent::comingSoon('drivers');
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/clients/", Config::get('VIEWS_PATH') . 'clients/addClient.php', [
            'page_title'    =>  "Add Client",
            'pht'           =>  ": Add Client"
        ]);
    }

    public function editDriver()
    {
        echo "<pre>",print_r($this->request->params),"</pre>";die();
        Config::setJsConfig('curPage', "edit-driver");
        Config::set('curPage', "edit-driver");
        if(!isset($this->request->params['args']['driver']))
        {
            //no driver id to update
            (new SiteErrorsController())->siteError("noDriverId")->send();
            return;
        }
        $driver_id = $this->request->params['args']['driver'];
        $driver = $this->driver->getDriverDetails(-1, $driver_id);
        //echo "<pre>",print_r($driver),"</pre>";die();
        if(empty($driver))
        {
            //no driver data found
            (new SiteErrorsController())->siteError("noDriverFound")->send();
            return;
        }
        //render the page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/depots/", Config::get('VIEWS_PATH') . 'depots/editDepot.php', [
            'pht'           =>  ": Edit Driver",
            'page_title'    =>  "Edit Driver: ".ucwords($driver['name']),
            'driver'        =>  $driver
        ]);
    }

    public function viewDrivers()
    {
        Config::setJsConfig('curPage', "view-drivers");
        Config::set('curPage', "view-drivers");
        $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        //$clients = $this->client->getClientsDetails($active);
        return parent::comingSoon('drivers');
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/clients/", Config::get('VIEWS_PATH') . 'clients/viewClients.php',
        [
            'active'        =>  $active,
            'pht'           =>  ": View Clients",
            'clients'       =>  $clients,
            'page_title'    =>  "View Clients"
        ]);
    }

    public function isAuthorized()
    {
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "drivers";
        //only for admin
        Permission::allow(['admin', 'super admin'], $resource, "*");



        return Permission::check($role, $resource, $action);
    }
}//end class