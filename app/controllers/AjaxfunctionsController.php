<?php
/**
 * Ajax Functions controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class ajaxfunctionsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $action = $this->request->param('action');
        $actions = [
            'addClientContact',
            'editClientContact',
            'getSuburbs'
        ];
        $form_actions = [];
        if(!in_array($action, $form_actions))
            $this->Security->config("validateForm", false);
        else
            $this->Security->config("form", [ 'fields' => ['csrf_token']]);
        $this->Security->requireAjax($actions);
    }

    public function addClientContact()
    {
        //echo "<pre>",print_r($this->request->data),"</pre>";die();
        $i = $this->request->data['i'];
        $required = (bool)$this->request->data['required'];
        $data = array(
            'error'     =>  false,
            'feedback'  =>  '',
            'html'      =>  ''
        );
        $html = $this->view->render(Config::get('VIEWS_PATH') . 'layout/page-includes/forms/add_customer_contact.php', [
            'i'         =>  $i,
            'required'  => $required
        ]);
        $data['html'] = $html;
        $this->view->renderJson($data);
    }

    public function editClientContact()
    {
        echo "<pre>",print_r($this->request->data),"</pre>";die();
        $i = $this->request->data['i'];
        $required = (bool)$this->request->data['required'];
        $data = array(
            'error'     =>  false,
            'feedback'  =>  '',
            'html'      =>  ''
        );
        $html = $this->view->render(Config::get('VIEWS_PATH') . 'layout/page-includes/forms/edit_customer_contact.php', [
            'i'         =>  $i,
            'required'  => $required
        ]);
        $data['html'] = $html;
        $this->view->renderJson($data);
    }

    public function getSuburbs()
    {
        //echo "<pre>",print_r($this->request),"</pre>";
        $data = $this->Postcode->getAutocompleteSuburb($this->request->query['term']);
        $this->view->renderJson($data);
    }

/***********************************************************************************************************
 ***********************************************************************************************************
 Form validator functions
 ***********************************************************************************************************
 **********************************************************************************************************/
   public function checkDepotAbbrevs()
    {
        //echo "<pre>",print_r($this->request),"</pre>";die();
        $request = trim($this->request->query['abbreviation']);
        $current_abbrev = isset($this->request->query['current_abbrev'])? trim($this->request->query['current_abbrev']) : "";
        $this->view->renderBoolean($this->depot->checkDepotAbbrevs($request, $current_abbrev));
    }
/***********************************************************************************************************
 ***********************************************************************************************************
 Form validator functions
 ***********************************************************************************************************
 **********************************************************************************************************/
    public function isAuthorized(){
        return true;
    }
}//end class
?>