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
            'addClientContact'
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
        $i = $this->request->data['i'];
        $data = array(
            'error'     =>  false,
            'feedback'  =>  '',
            'html'      =>  ''
        );
        $html = $this->view->render(Config::get('VIEWS_PATH') . 'layout/page-includes/forms/add_customer_contact.php', [
            'i'     =>  $i
        ]);
        $data['html'] = $html;
        $this->view->renderJson($data);
    }

    public function isAuthorized(){
        return true;
    }
}//end class
?>