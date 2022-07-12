<?php

/**
 * Form controller
 *
 * processes all forms on thee site
 * @author     Mark Solly <mark@baledout.com.au>
 */

class FormController extends Controller {

    /**
     * Initialization method.
     * load components, and optionally assign their $config
     *
     */
    public function initialize(){
        $action = $this->request->param('action');
        //die('action '.$action);
        if($action == "procLogin" || $action == "procForgotPassword" || $action == "procUpdatePassword")
        {
            //no auth component need for logging in
             $this->loadComponents([
                 'Security'
             ]);
        }
        else
        {
             $this->loadComponents([
                 'Auth' => [
                         'authenticate' => ['User']
                     ],
                 'Security'
             ]);
        }
    }//End initialise()

    public function beforeAction(){

        parent::beforeAction();
        $action = $this->request->param('action');
        $actions = [
            'procLogin'
        ];
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
        $this->Security->requirePost($actions);
    }// End beforAction()

    public function procLogin()
    {
        //echo "<pre>",print_r($this->request),"</pre>";die();
        $email      = $this->request->data('email');
        $password   = $this->request->data('password');
        $userIp     = $this->request->clientIp();
        $redirect   = $this->request->data("redirect");
        $userAgent  = $this->request->userAgent();
        if($this->login->isIpBlocked($userIp))
        {
            Form::setError("general","Your IP Address has been blocked");
        }
        if(!$this->dataSubbed($email))
        {
            Form::setError('email', 'Please enter your email address');
        }
        elseif(!$this->emailValid($email))
        {
            Form::setError('email', 'Please enter a valid email address');
        }
        elseif( !$this->user->isUserActive($email) )
        {
            Form::setError('general', 'Sorry, either your email address is not registered in our system, or your account has been deactivated');
        }
        elseif(!$this->login->isLoginAttemptAllowed($email))
        {
            Form::setError('general', "You exceeded number of possible attempts, please try again later after " .$this->login->getMinutesBeforeLogin($email) . " minutes");
        }
        else
        {
            $user = $this->user->getUserByEmail($email);
            $userId = isset($user["id"])? $user["id"]: null;
        }
        if(!$this->dataSubbed($password))
        {
            Form::setError('password', 'Please enter your password');
        }
        if(Form::$num_errors == 0):		/* No entry errors */
            if(password_verify($password, $user["hashed_password"]) === false)
            {
                Form::setError("general","Email and Password combination was not found");
                $this->login->handleIpFailedLogin($userIp, $email);
            }
        endif;
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
		{
		    Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
			return $this->redirector->login($redirect);
		}
        else
        {
            //echo "<pre>",print_r($this->request),"</pre>"; die();
            // reset session
            Session::reset([
                "user_id"           => $userId,
                "role"              => $this->user->getUserRoleName($user["role_id"]),
                "ip"                => $userIp,
                "user_agent"        => $userAgent,
                "users_name"        => $user['name'],
                "client_id"         => $user['client_id'],
                "is_admin_user"     => $this->user->isAdminUser($userId),
                "is_warehouse_user" => $this->user->isWarehouseUser($userId)
            ]);
            //set the cookie to remember the user
            Cookie::reset($userId);

            $this->login->resetFailedLogins($email);
            $this->login->resetPasswordToken($userId);
            $redirect = ltrim($redirect, "/");
            return $this->redirector->root($redirect);
        }
    }// End procLogin()


}// end class