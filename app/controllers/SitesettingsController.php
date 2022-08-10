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