<?php

/**
 * Site Settings controller
 *

 * @author     Mark Solly <mark@baledout.com.au>
 */

class SiteSettingsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'site-settings-index');
        parent::displayIndex(get_class());
    }

    public function manageUsers()
    {
        //$client_users = $this->user->getAllUsers('client');
        //$admin_users = $this->user->getAllUsers('admin');
        $user_roles = $this->user->getUserRoles();
        $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        //render the page
        Config::setJsConfig('curPage', "manage-users");
        Config::set('curPage', "manage-users");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/sitesettings/", Config::get('VIEWS_PATH') . 'sitesettings/manageUsers.php',
        [
            'page_title'    =>  'Manage Users',
            'pht'           =>  ": Manage Users",
            'user_roles'    =>  $user_roles,
            'active'        =>  $active
        ]);
    }

    public function addUser()
    {
        $client_role_id = $this->user->getClientRoleId();
        //render the page
        Config::setJsConfig('curPage', "add-user");
        Config::set('curPage', "add-user");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/sitesettings/", Config::get('VIEWS_PATH') . 'sitesettings/addUser.php',
        [
            'page_title'        =>  'Add New User',
            'pht'               =>  ": Add New User",
            'client_role_id'    =>  $client_role_id
        ]);
    }

    public function userRoles()
    {
        $roles = $this->user->getUserRoles();
        //render the page
        Config::setJsConfig('curPage', "user-roles");
        Config::set('curPage', "user-roles");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/sitesettings/", Config::get('VIEWS_PATH') . 'sitesettings/userRoles.php',[
            'page_title'  =>  'Manage User Roles',
            'pht'         =>  ": Manage User Roles",
            'roles'       =>  $roles
        ]);
    }

    public function viewTypography()
    {
        $user_role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        //render the page
        Config::setJsConfig('curPage', "view-typography");
        Config::set('curPage', "view-typography");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/sitesettings/", Config::get('VIEWS_PATH') . 'sitesettings/viewTypography.php',[
            'page_title'    =>  'View Typography',
            'user_role'     =>  $user_role
        ]);
    }


    public function isAuthorized(){
        $role = Session::getUserRole();
        $action = $this->request->param('action');
        $resource = "sitesettings";
        // only for super admins
        Permission::allow('super admin', $resource, ['*']);
        // all other admins
        Permission::allow(['admin'], $resource, [
            'index',
            'viewTypography'
        ]);

        //echo "<pre>",print_r(Permission::$perms),"</pre>"; die();
        return Permission::check($role, $resource, $action);
    }

}//End Class
?>