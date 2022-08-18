<?php

/**
 * Clients controller
 *

 Manages Clients

 * @author     Mark Solly <mark@baledout.com.au>
 */

class ClientsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'clients-index');
        parent::displayIndex(get_class());
    }

    public function addClient()
    {
        Config::setJsConfig('curPage', "add-client");
        Config::set('curPage', "add-client");
        //return parent::comingSoon('clients');
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/clients/", Config::get('VIEWS_PATH') . 'clients/addClient.php', [
            'page_title'    =>  "Add Client",
            'pht'           =>  ": Add Client"
        ]);
    }

    public function viewClients()
    {
        Config::setJsConfig('curPage', "view-clients");
        Config::set('curPage', "view-clients");
        return parent::comingSoon('clients');
    }

    public function editClient()
    {
        Config::setJsConfig('curPage', "edit-clients");
        Config::set('curPage', "edit-clients");
        return parent::comingSoon('clients');
    }

    public function isAuthorized()
    {
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "clients";
        //only for admin
        Permission::allow(['admin', 'super admin'], $resource, "*");



        return Permission::check($role, $resource, $action);
    }
}