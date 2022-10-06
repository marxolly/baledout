<?php

/**
 * Contact controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class ContactUsController extends Controller
{
    /**
     * Generic Contact Us
     *
     */
    public function sendAMessage()
    {
        Config::setJsConfig('curPage', "send-a-message");
        Config::set('curPage', "send-a-messag");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/contacts/", Config::get('VIEWS_PATH') . 'contacts/sendAMessage.php',[
            'pht'           =>  ": Send Us a Message",
            'page_title'    =>  "Send Us A Message"
        ]);
    }

    public function isAuthorized(){
        return true;
    }
}