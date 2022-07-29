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