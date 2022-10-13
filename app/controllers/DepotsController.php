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
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/depots/", Config::get('VIEWS_PATH') . 'clients/addDepot.php', [
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