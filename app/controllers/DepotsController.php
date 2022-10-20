<?php

/**
 * Depots controller
 *

 Manages Depots For hire and DeHire

 * @author     Mark Solly <mark@baledout.com.au>
 */

class DepotsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'depots-index');
        parent::displayIndex(get_class());
    }

    public function addDepot()
    {
        Config::setJsConfig('curPage', "add-depot");
        Config::set('curPage', "add-depot");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/depots/", Config::get('VIEWS_PATH') . 'depots/addDepot.php', [
            'page_title'    =>  "Add Depot",
            'pht'           =>  ": Add Depot"
        ]);
    }

    public function viewDepots()
    {
        Config::setJsConfig('curPage', "view-depots");
        Config::set('curPage', "view-depots");
        $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        $depots = $this->depot->getDepotsDetails($active);
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/depots/", Config::get('VIEWS_PATH') . 'depots/viewDepots.php',
        [
            'active'        =>  $active,
            'pht'           =>  ": View Depots",
            'depots'       =>  $depots,
            'page_title'    =>  "View Depots"
        ]);
    }

    public function editDepot()
    {
        //echo "<pre>",print_r($this->request->params),"</pre>";die();
        Config::setJsConfig('curPage', "edit-depot");
        Config::set('curPage', "edit-depot");
        if(!isset($this->request->params['args']['depot']))
        {
            //no depot id to update
            (new SiteErrorsController())->siteError("noDepotId")->send();
            return;
        }
        $depot_id = $this->request->params['args']['depot'];
        $depot = $this->depot->getDepotsDetails(-1, $depot_id);
        //echo "<pre>",print_r($depot),"</pre>";die();
        if(empty($depot))
        {
            //no deopt data found
            (new SiteErrorsController())->siteError("noDepotFound")->send();
            return;
        }
        //render the page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/depots/", Config::get('VIEWS_PATH') . 'depots/editDepot.php', [
            'pht'           =>  ": Edit Depot",
            'page_title'    =>  "Edit Depot: ".ucwords($depot['depot_name'])."(".strtoupper($depot['abbreviation']).")",
            'depot'        =>  $depot
        ]);
    }

    public function isAuthorized()
    {
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "depots";
        //only for admin
        Permission::allow(['admin', 'super admin'], $resource, "*");



        return Permission::check($role, $resource, $action);
    }
}