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
        $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        $clients = $this->client->getClientsDetails($active);
        //return parent::comingSoon('clients');
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/clients/", Config::get('VIEWS_PATH') . 'clients/viewClients.php',
        [
            'active'        =>  $active,
            'pht'           =>  ": View Clients",
            'clients'       =>  $clients,
            'page_title'    =>  "View Clients"
        ]);
    }

    public function editClient()
    {
        Config::setJsConfig('curPage', "edit-client");
        Config::set('curPage', "edit-client");
        if(!isset($this->request->params['args']['client']))
        {
            //no client id to update
            (new SiteErrorsController())->siteError("noClientId")->send();
            return;
        }
        $client_id = $this->request->params['args']['client'];
        $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        $client = $this->client->getClientsDetails($active, $client_id);
        if(empty($client))
        {
            //no client data found
            (new SiteErrorsController())->siteError("noClientFound")->send();
            return;
        }
        echo "<pre>",print_r($client),"</pre>";die();
        //return parent::comingSoon('clients');
        //render the page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/clients/", Config::get('VIEWS_PATH') . 'clients/editClient.php', [
            'pht'           =>  ": Edit Client",
            'page_title'    =>  "Edit Client: ".ucwords($client['client_name']),
            'client'        =>  $client
        ]);
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