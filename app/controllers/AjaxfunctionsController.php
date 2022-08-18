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
}//end class
?>