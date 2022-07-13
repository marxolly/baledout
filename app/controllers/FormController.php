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

    /********************************************************************************************************************************
    *   Helper functions below this
    *******************************************************************************************************************************/
    /*******************************************************************
    ** validates addresses
    ********************************************************************/
    public function validateAddress($address, $suburb, $state, $postcode, $country, $ignore_address_error, $prefix = "", $session_var = false)
    {
        if( !$this->dataSubbed($address) )
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'address', 'An address is required');
        }
        elseif( !$ignore_address_error )
        {
            if( (!preg_match("/(?:[A-Za-z].*?\d|\d.*?[A-Za-z])/i", $address)) && (!preg_match("/(?:care of)|(c\/o)|( co )/i", $address)) )
            {
                if($session_var)
                {
                    Session::set($session_var, true);
                }
                Form::setError($prefix.'address', 'The address must include both letters and numbers');
            }
        }
        if(!$this->dataSubbed($postcode))
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'postcode', "A delivery postcode is required");
        }
        if(!$this->dataSubbed($country))
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'country', "A delivery country is required");
        }
        elseif(strlen($country) > 2)
        {
            if($session_var)
            {
                Session::set($session_var, true);
            }
            Form::setError($prefix.'country', "Please use the two letter ISO code");
        }
        elseif($country == "AU")
        {
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