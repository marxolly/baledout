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
            'procClientAdd',
            'procClientEdit',
            'procDepotAdd',
            'procDepotEdit',
            'procForgotPassword',
            'procLogin',
            'procProfileUpdate',
            'procSendAMessage',
            'procUpdatePassword',
            'procUserAdd'
        ];
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
        $this->Security->requirePost($actions);
    }// End beforAction()

/********************************************************************************************************************
********************************************************************************************************************
                        Form processing Actions
********************************************************************************************************************
********************************************************************************************************************/

    public function procDepotAdd()
    {
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //echo "<pre>POST DATA",print_r($post_data),"</pre>"; die();
        $this->depotDataValidate($post_data);
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //echo "ALL GOOD<pre>POST DATA",print_r($post_data),"</pre>"; die();
            //all good, add details
            if($client_id = $this->depot->addDepot($post_data))
                Session::set('feedback', "$depot_name ($abbreviation) has been added to the system");
            else
                Session::set('errorfeedback', 'A database error has occurred. Please try again');
        }
        return $this->redirector->to(PUBLIC_ROOT."depots/add-depot/");
    }   //End procDepotAdd

    public function procDepotEdit()
    {
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //echo "<pre>POST DATA",print_r($post_data),"</pre>"; die();
        $this->depotDataValidate($post_data);
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //echo "ALL GOOD<pre>POST DATA",print_r($post_data),"</pre>"; die();
            //all good, add details
            if($this->depot->updateDepotInfo($post_data))
            {
                Session::set('feedback', "{$depot_name}'s details have been updated");
                //return $this->redirector->to(PUBLIC_ROOT."clients/edit-client/client=".$client_id);
            }
            else
            {
                Session::set('errorfeedback', 'A database error has occurred. Please try again');
            }
        }
        return $this->redirector->to(PUBLIC_ROOT."depots/edit-depot/depot=$depot_id");
    } //end procDepotEdit

    public function procClientEdit()
    {
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //echo "<pre>POST DATA",print_r($post_data),"</pre>"; die();
        if($image_name = $this->clientDataValidate($post_data))
            $post_data['image_name'] = $image_name;
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //all good, add details
            //echo "ALL GOOD<pre>POST DATA",print_r($post_data),"</pre>"; die();
            if($this->client->updateClientInfo($post_data))
            {
                Session::set('feedback', "{$client_name}'s details have been updated");
                //return $this->redirector->to(PUBLIC_ROOT."clients/edit-client/client=".$client_id);
            }
            else
            {
                Session::set('errorfeedback', 'A database error has occurred. Please try again');
            }

        }
        return $this->redirector->to(PUBLIC_ROOT."clients/edit-client/client=$client_id");


    }//End procClientEdit

    public function procClientAdd()
    {
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //echo "<pre>POST DATA",print_r($post_data),"</pre>"; die();
        //$this->clientDataValidate($post_data);
        if($image_name = $this->clientDataValidate($post_data))
            $post_data['image_name'] = $image_name;
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //all good, add details
            if($client_id = $this->client->addClient($post_data))
            {
                Session::set('feedback', "$client_name has been added to the system");
                //return $this->redirector->to(PUBLIC_ROOT."clients/edit-client/client=".$client_id);
            }
            else
            {
                Session::set('errorfeedback', 'A database error has occurred. Please try again');
            }
        }
        return $this->redirector->to(PUBLIC_ROOT."clients/add-client/");
    } // End procClientAdd()
/********************************************************************************************************************
********************************************************************************************************************/
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
                "is_driver_user"    => $this->user->isDriverUser($userId)
            ]);
            //set the cookie to remember the user
            Cookie::reset($userId);

            $this->login->resetFailedLogins($email);
            $this->login->resetPasswordToken($userId);
            $this->login->setCurrentLogTime($userId);
            $redirect = ltrim($redirect, "/");
            return $this->redirector->root($redirect);
        }
    }// End procLogin()
/********************************************************************************************************************
********************************************************************************************************************/
    public function procForgotPassword()
    {
        //echo "<pre>",print_r($this->request),"</pre>"; //die();
        $email      = $this->request->data('email');
        $userIp     = $this->request->clientIp();
        $userAgent  = $this->request->userAgent();
        Session::set('display-form', 'forgot-password');
        $db = Database::openConnection();
        if(!$this->dataSubbed($email))
        {
            Form::setError('email', 'Please enter your email address');
        }
        elseif(!$this->emailValid($email))
        {
            Form::setError('email', 'Please enter a valid email address');
        }
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            if($db->fieldValueTaken('users', $email, 'email'))
            {
                //die('email found');
                //only do stuff if the email exists in the system
                $user     = $db->queryRow("SELECT * FROM users WHERE email = :email", array('email' => $email));
                //echo "<pre>",print_r($user),"<pre>";//die();
                $forgottenPassword = $db->queryRow("SELECT * FROM forgotten_passwords WHERE user_id = ".$user['id']);
                //echo "<pre>",print_r($forgottenPassword),"<pre>";die();
                $last_time = isset($forgottenPassword["password_last_reset"])? $forgottenPassword["password_last_reset"]: null;
                $count     = isset($forgottenPassword["forgotten_password_attempts"])? $forgottenPassword["forgotten_password_attempts"]: null;
                $block_time = (10 * 60);
                $time_elapsed = time() - $last_time;
                if ($count >= 5 && $time_elapsed < $block_time)
                {
                    Form::setError('toomanytimes', "You exceeded number of permissable attempts, please try again later after " .date("i", $block_time - $time_elapsed) . " minutes");
                    Session::set('value_array', $_POST);
                    Session::set('error_array', Form::getErrorArray());
                    return $this->redirector->login();
                }
                $newPasswordToken = $this->login->generateForgottenPasswordToken($user["id"], $forgottenPassword);
                //echo "<p>generated this token: $newPasswordToken</p>";die();
                if(!Email::sendPasswordReset($user['id'], $user['name'], $email, $newPasswordToken))
                {
                    die('mail error');
                }
            }
            Session::set('feedback', "<p>An email has been sent with a reset password link. This link will remain valid for 24 hours</p>");
        }
        return $this->redirector->login();
    }// End procForgotPassword()

/********************************************************************************************************************
********************************************************************************************************************/
    public function procProfileUpdate()
    {
        //echo "<pre>",print_r($this->request->data),"</pre>"; die();
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //echo "<pre>POST DATA",print_r($post_data),"</pre>"; die();
        if( !$this->dataSubbed($name) )
        {
            Form::setError('name', 'Your name is required');
        }
        //image uploads
        $field = "image";
        if($_FILES[$field]["size"] > 0)
        {
            if(getimagesize($this->request->data[$field]['tmp_name']) !== false)
            {
                $filename = pathinfo($this->request->data[$field]['name'], PATHINFO_FILENAME);
                $image_name = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);//strip out non alphanumeric characters
                $image_name = strtolower(str_replace(' ','_',$image_name));
                //main image
                $image_name = $this->uploadImage($field, 200, 200, $image_name, 'jpg', false, 'profile_pictures/');
                //thumbnail image
                //$this->uploadImage($field, 100, false, "tn_".$image_name, 'jpg', false, 'products/');
                $post_data['image_name'] = $image_name;
            }
            else
            {
                Form::setError($field, 'Only upload images here');
            }
        }
        elseif($_FILES[$field]['error']  !== UPLOAD_ERR_NO_FILE)
        {
            $error_message = $this->file_upload_error_message($_FILES[$field]['error']);
            Form::setError($field, $error_message);
        }
        if($this->dataSubbed($new_password))
        {
            if(!$this->dataSubbed($conf_new_password))
            {
                Form::setError('conf_new_password', 'Please retype new password for confirmation');
            }
            elseif($conf_new_password !== $new_password)
            {
                Form::setError('conf_new_password', 'Passwords do not match');
            }
            else
            {
                $post_data['hashed_password'] = password_hash($new_password, PASSWORD_DEFAULT, array('cost' => Config::get('HASH_COST_FACTOR')));
            }
        }
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
            //return $this->redirector->to(PUBLIC_ROOT . "/user/profile");
            //return $this->redirector->to(PUBLIC_ROOT . "login/resetPassword", ['id' => $this->request->data("id"), 'token' => $this->request->data("token")]);
        }
        else
        {
            $this->user->updateProfileInfo($post_data, Session::getUserId());
            //reset some session data
            Session::reset([
                "user_id"           => Session::getUserId(),
                "role"              => $this->user->getUserRoleName($role_id),
                "ip"                => $this->request->clientIp(),
                "user_agent"        => $this->request->userAgent(),
                "users_name"        => $name,
                "client_id"         => $client_id,
                "is_admin_user"     => $this->user->isAdminUser(),
                "is_driver_user"    => $this->user->isDriverUser(Session::getUserId())
            ]);
            //set the cookie to remember the user
            Cookie::reset(Session::getUserId());
            Session::set('feedback', "<p>Your details have been updated</p>");
        }
        return $this->redirector->to(PUBLIC_ROOT."user/profile");
    }
/********************************************************************************************************************
********************************************************************************************************************/
    public function procSendAMessage()
    {
        //echo "<pre>",print_r($this->request->data),"</pre>"; die();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }
        //robot catcher
        $load_time = time() - $loaded;
        if( $load_time < 10 && $this->dataSubbed($the_website) )
            return false;
        //end robot catcher
        if(!$this->dataSubbed($subject))
        {
            Form::setError('subject', "Please enter a subject");
        }
        if(!$this->dataSubbed($message))
        {
            Form::setError('message', "Please enter a message");
        }
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //echo "ALL GOOD<pre>",print_r($post_data),"</pre>"; die();
            //Session::set('feedback',"<h2><i class='far fa-check-circle'></i>The Job Delivery Details Have Been Updated</h2>");
            if(Email::sendContactUsEmail($subject,$message))
            //if(1 == 2)
            {
                Session::set('feedback',"<p>Your Message Has Been Sent</p><p>We will be in contact soon</p>");
            }
            else
            {
                Session::set('value_array', $_POST);
                Session::set('error_array', Form::getErrorArray());
                Session::set('errorfeedback',"<p>There has been error emailing your message</p>");
            }
        }
        return $this->redirector->to(PUBLIC_ROOT."contacts/send-a-message/");
    }// End proc sendAMessage
/********************************************************************************************************************
********************************************************************************************************************/
    public function procUpdatePassword()
    {
        //echo "<pre>",print_r($this->request),"</pre>";die();
        $password        = $this->request->data("password");
        $confirmPassword = $this->request->data("confirm_password");
        $userId          = Session::get("user_id_reset_password");

        if(!$this->dataSubbed($password))
        {
            Form::setError('password', 'A new password is required');
        }
        if(!$this->dataSubbed($confirmPassword))
        {
            Form::setError('confirm_password', 'Please retype you password');
        }
        elseif($password !== $confirmPassword)
        {
            Form::setError('confirm_password', 'Passwords do not match');
        }
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
            return $this->redirector->to(PUBLIC_ROOT . "login/resetPassword", ['id' => $this->request->data("id"), 'token' => $this->request->data("token")]);
        }
        else
        {
            //die('all good');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('HASH_COST_FACTOR')));
            $this->login->updatePassword($hashedPassword, $userId);
            $this->login->resetPasswordToken($userId);
            // logout, and clear any existing session and cookies
            Session::remove();
            Cookie::remove($userId);
            //return $this->redirector->to(PUBLIC_ROOT."login/passwordUpdated");
            $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/login/", Config::get('LOGIN_PATH') . 'passwordUpdated.php');
        }
    }// End procPasswordUpdate()
/********************************************************************************************************************
********************************************************************************************************************/
    public function procUserAdd()
    {
        //echo "<pre>",print_r($this->request->data),"</pre>"; die();
        $post_data = array();
        foreach($this->request->data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
                $post_data[$field] = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    $post_data[$field][$key] = $avalue;
                    ${$field}[$key] = $avalue;
                }
            }
        }

        if( !$this->dataSubbed($name) )
        {
            Form::setError('name', 'A name is required');
        }
        if(!$this->dataSubbed($email))
        {
            Form::setError('email', 'An email is required');
        }
        elseif( !$this->emailValid($email))
        {
            Form::setError('email', 'Please enter a valid email');
        }
        elseif( $this->user->emailTaken($email))
        {
            Form::setError('email', 'This email is already registered');
        }
        if($role_id == 0)
        {
            Form::setError('role_id', 'Please select a role');
        }
        elseif($role_id == $client_role_id)
        {
            if( $client_id == 0 )
            {
                Form::setError('client_id', 'Please select a client');
            }
        }
        if(Form::$num_errors > 0)		/* Errors exist, have user correct them */
        {
            Session::set('value_array', $_POST);
            Session::set('error_array', Form::getErrorArray());
        }
        else
        {
            //insert the user
            $this->user->addUser($post_data);
            Session::set('feedback', "<p>That user has been added to the system</p>");
            if(!isset($test_user))
            {
                //send the email
                Email::sendNewUserEmail($name, $email);
                $_SESSION['feedback'] .= "<p>password setup instructions have been emailed to $email</p>";
            }
        }
        return $this->redirector->to(PUBLIC_ROOT."portal-users/add-user");
    }// End procUserAdd()

/********************************************************************************************************************
********************************************************************************************************************
                        Helper Functions
********************************************************************************************************************
********************************************************************************************************************/
    /*******************************************************************
    ** validates data entered for depots
    ********************************************************************/
    private function depotDataValidate($post_data = [])
    {
        foreach($post_data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    ${$field}[$key] = $avalue;
                }
            }
        }
        if( !$this->dataSubbed($depot_name) )
        {
            Form::setError('depot_name', 'A depot name is required');
        }
        if( $this->dataSubbed($email) )
        {
            if( !$this->emailValid($email) )
            {
                Form::setError('email', 'Please enter a valid email address');
            }
        }
        if( !$this->dataSubbed($abbreviation) )
        {
            Form::setError('abbreviation', 'An abbreviation is required');
        }
        else
        {
            $current_abbrev = ( isset($current_abbreviation) )? $current_abbreviation : false;
            if($this->depot->depotAbbreviationTaken($abbreviation,$current_abbrev))
                Form::setError('abbreviation', 'This abbreviation is already in use.<br>Abbreviations must be unique');
        }
        foreach($contacts as $ind => $cd)
        {
            if(isset($cd['deactivate']))
                continue;
            if(!$this->dataSubbed($cd['name']))
                continue;
            if($this->dataSubbed($cd['email']))
            {
                if(!$this->emailValid($cd['email']))
                {
                    Form::setError('contactemail_'.$ind, 'The email is not valid');
                }
            }
        }
        if(!empty($address) || !empty($suburb) || !empty($state) || !empty($postcode) )
        {
            $this->validateAddress($address, $suburb, $state, $postcode );
        }
    }
    /*******************************************************************
    ** validates data entered for clients
    ********************************************************************/
    private function clientDataValidate($post_data = [])
    {
        foreach($post_data as $field => $value)
        {
            if(!is_array($value))
            {
                ${$field} = $value;
            }
            else
            {
                foreach($value as $key => $avalue)
                {
                    ${$field}[$key] = $avalue;
                }
            }
        }
        $image_name = false;
        if( !$this->dataSubbed($client_name) )
        {
            Form::setError('client_name', 'A client name is required');
        }
        if( $this->dataSubbed($email) )
        {
            if( !$this->emailValid($email) )
            {
                Form::setError('email', 'Please enter a valid email address');
            }
        }
        if( $this->dataSubbed($website) )
        {
            if ( filter_var($website, FILTER_VALIDATE_URL) === false )
            {
                Form::setError('website', 'Please enter a valid URL');
            }
        }
        foreach($contacts as $ind => $cd)
        {
            if(isset($cd['deactivate']))
                continue;
            if(!$this->dataSubbed($cd['name']))
            {
                Form::setError('contactname_'.$ind, 'A contact name is required');
            }
            if($this->dataSubbed($cd['email']))
            {
                if(!$this->emailValid($cd['email']))
                {
                    Form::setError('contactemail_'.$ind, 'The email is not valid');
                }
            }
        }
        if(!empty($deliveryaddress) || !empty($deliverysuburb) || !empty($deliverystate) || !empty($deliverypostcode) )
        {
            $this->validateAddress($deliveryaddress, $deliverysuburb, $deliverystate, $deliverypostcode, "delivery" );
        }
        if(!empty($billingaddress) || !empty($billingsuburb) || !empty($billingstate) || !empty($billingpostcode) )
        {
            $this->validateAddress($billingaddress, $billingsuburb, $billingstate, $billingpostcode, "billing" );
        }
        //image uploads
        $field = "client_logo";
        if($this->request->data[$field]["size"] > 0)
        {
            if(getimagesize($this->request->data[$field]['tmp_name']) !== false)
            {
                $filename = pathinfo($this->request->data[$field]['name'], PATHINFO_FILENAME);
                $image_name = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);//strip out non alphanumeric characters
                $image_name = strtolower(str_replace(' ','_',$image_name));
                //main image
                $image_name = $this->uploadImage($field, 180, 100, $image_name, 'jpg', false, 'client_logos/');
                //thumbnail image
                $this->uploadImage($field, 100, false, "tn_".$image_name, 'jpg', false, 'client_logos/');
                //$post_data['image_name'] = $image_name;
            }
            else
            {
                Form::setError($field, 'Only upload images here');
            }
        }
        elseif($_FILES[$field]['error']  !== UPLOAD_ERR_NO_FILE)
        {
            $error_message = $this->file_upload_error_message($_FILES[$field]['error']);
            Form::setError($field, $error_message);
        }
        return $image_name;
    }
    /*******************************************************************
    ** validates addresses
    ********************************************************************/
    public function validateAddress($address, $suburb, $state, $postcode, $prefix = "", $session_var = false)
    {
        if( !$this->dataSubbed($address) )
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'address', 'An address is required');
        }
        if(!$this->dataSubbed($postcode))
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'postcode', "A delivery postcode is required");
        }
        if(!$this->dataSubbed($suburb))
		{
		    if($session_var)
            {
                Session::set($session_var, true);
            }
			Form::setError($prefix.'suburb', "A delivery suburb is required for Australian addresses");
		}
		if(!$this->dataSubbed($state))
		{
		    if($session_var)
            {
                Session::set($session_var, true);
            }
			Form::setError($prefix.'state', "A delivery state is required for Australian addresses");
		}
        $aResponse = $this->Postcode->validateSuburb($suburb, $state, str_pad($postcode,4,'0',STR_PAD_LEFT));
        $error_string = "";
        if(isset($aResponse['errors']))
        {
            foreach($aResponse['errors'] as $e)
            {
                $error_string .= $e['message']." ";
            }
        }
        elseif($aResponse['found'] === false)
        {
            $error_string .= "Postcode does not match suburb or state";
        }
        if(strlen($error_string))
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'postcode', $error_string);
        }
    }

    /*******************************************************************
    ** validates empty data fields
    ********************************************************************/
	public function dataSubbed($data)
	{
		if(!$data || strlen($data = trim($data)) == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}//end dataSubbed()

    /*******************************************************************
   ** validates email addresses
   ********************************************************************/
	public function emailValid($email)
	{
		if(!$email || strlen($email = trim($email)) == 0)
		{
         	return false;
      	}
      	else
		{
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        	 /* Check if valid email address
         	$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
         	if(!preg_match($regex,$email))
			{
            	return false;
         	}
         	else
			{
				return true;
			}
            */
      	}
	}//end emailValid()

    /*******************************************************************
   ** Returns human readable errors for file uploads
   ********************************************************************/
	private function file_upload_error_message($error_code) {
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the maximum upload size allowed by the server';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the maximum upload size allowed by the server';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was selected for uploading';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'File upload stopped by extension';
            default:
                return 'Unknown upload error';
        	}
	}



    private function uploadImage($field, $width, $height = false, $picturename = "image", $format = 'jpg', $overwrite = false, $dir = '/images/uploads/')
    {
        //namespace Verot\Upload;
        if ($_FILES[$field]['error']  === UPLOAD_ERR_OK)
        {//////////////////////////////////////////////////////////////////////only if entered?
                //$handle = new Upload($_FILES[$field]);
                $handle = new \Verot\Upload\Upload($_FILES[$field]);
                //$handle->log;
                if($handle->uploaded)
                {
                    //file uploaded.
                    //die($field);
                        //Image settings
                        $handle->image_resize = true;
                        $handle->image_ratio = true;
                        $handle->file_auto_rename = !$overwrite;
                        $handle->file_overwrite = $overwrite;
                        $handle->image_x = $width;
                        if($height)
                        {
                            $handle->image_y = $height;
                            $handle->image_ratio = true;
                        }
                        else
                        {
                            $handle->image_ratio_y = true;
                        }
                        $handle->file_new_name_body = $picturename;
                        $handle->image_convert = $format;
                        $handle->Process(IMAGES.$dir);
                        if(!$handle->processed)
                        {
                            Form::setError($field, $handle->error);
                        }
                        return $handle->file_dst_name_body;
                }
                else
                {
                    //error uploading file
                    Form::setError($field, $handle->error);
                }
        }///end if picture uploaded
        else
        {
            //error uploading file
            $error_message = $this->file_upload_error_message($_FILES[$field]['error']);
            Form::setError($field, $error_message);
        }
    }//end function

}// end class