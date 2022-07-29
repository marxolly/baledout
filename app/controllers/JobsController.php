<?php

/**
 * Jobs controller
 *

 Manages Production Jobs

 * @author     Mark Solly <mark@baledout.com.au>
 */

class JobsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'jobs-index');
        parent::displayIndex(get_class());
    }

    public function addJob()
    {
        Config::setJsConfig('curPage', "add-job");
        Config::set('curPage', "add-job");
        return parent::comingSoon('jobs');
    }

    public function editJob()
    {
        Config::setJsConfig('curPage', "edit-job");
        Config::set('curPage', "edit-job");
        return parent::comingSoon('jobs');
    }

    public function searchJobs()
    {
        Config::setJsConfig('curPage', "search-jobs");
        Config::set('curPage', "search-jobs");
        return parent::comingSoon('jobs');
    }

    public function viewJobs()
    {
        Config::setJsConfig('curPage', "view-jobs");
        Config::set('curPage', "view-jobs");
        return parent::comingSoon('jobs');
    }

    public function isAuthorized()
    {
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "jobs";
        //only for admin
        Permission::allow(['admin', 'super admin'], $resource, "*");
        return Permission::check($role, $resource, $action);
    }
}