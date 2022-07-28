<?php

/**
 * Admin Only controller
 *

 * @author     Mark Solly <mark@baledout.com.au>
 */

class AdminOnlyController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }


    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'admin-only-index');
        parent::displayIndex(get_class());
    }

    public function isAuthorized(){
        $role = Session::getUserRole();
        $action = $this->request->param('action');
        $resource = "adminonly";
        // only for super admins
        Permission::allow('super admin', $resource, ['*']);
        return Permission::check($role, $resource, $action);
    }
}