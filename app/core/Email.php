<?php

 /**
  * Email Class
  *
  * Sending emails via SMTP.
  * It uses PHPMailer library to send emails.
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>
  */
  use PHPMailer\PHPMailer\PHPMailer;

 class Email{
     /**
      * This is the constructor for Email object.
      *
      * @access private
      */
    private function __construct(){}

    public static function sendContactUsEmail($subject, $message)
    {
        $sender_id = Session::getUserId();
        $user = new User;
        $sender_details = $user->getProfileInfo($sender_id);
        //echo "<pre>",print_r($sender_details),"</pre>";die();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        try{
            $mail->Host = "smtp.office365.com";
            $mail->Port = Config::get('EMAIL_PORT');
            $mail->SMTPDebug  = 0;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = Config::get('EMAIL_UNAME');
            $mail->Password = Config::get('EMAIL_PWD');

            $body = file_get_contents(Config::get('EMAIL_TEMPLATES_PATH')."contactus.html");
            $replace_array = array("{SUBJECT}", "{FROM}", "{FROM_EMAIL}", "{MESSAGE}");
    		$replace_with_array = array($subject, $sender_details['name'], $sender_details['email'], $message);
    		$body = str_replace($replace_array, $replace_with_array, $body);

            $mail->SetFrom(Config::get('EMAIL_FROM'), Config::get('EMAIL_FROM_NAME'));

    		$mail->AddAddress('mark.solly@fsg.com.au', 'Mark Solly');

    		$mail->Subject = "Message From Contacte Form: $subject";

            $mail->AddEmbeddedImage(IMAGES."FSG_logo@130px.png", "emailfoot", "FSG_logo@130px.png");

    		$mail->MsgHTML($body);
            if(!$mail->Send())
            {
                Logger::log("Mail Error", print_r($mail->ErrorInfo, true), __FILE__, __LINE__);
                throw new Exception("Email couldn't be sent to ". $sender_details['name']);
                return false;
            }
        } catch (phpmailerException $e) {
            print_r($e->errorMessage());die();
        } catch (Exception $e) {
            print_r($e->getMessage());die();
        }
        //die('email');
        return true;
    }


    public static function sendDailyReport($filenames, $client_id)
    {
        $db = Database::openConnection();
        $mail = new PHPMailer();
        $today = date('d/m/Y', time());
        $body = file_get_contents(Config::get('EMAIL_TEMPLATES_PATH')."dispatchreport.html");

        $cd = $db->queryByID('clients', $client_id);
        $replace_array = array("{NAME}");
		$replace_with_array = array($cd['contact_name']);
        $body = str_replace($replace_array, $replace_with_array, $body);
        $mail->SetFrom(Config::get('EMAIL_FROM'), Config::get('EMAIL_FROM_NAME'));
		$mail->Subject = "Warehouse Reports For $today";
		$mail->MsgHTML($body);
        foreach($filenames as $f)
        {
            $mail->AddAttachment($f);
        }

        $mail->AddEmbeddedImage(IMAGES."FSG_logo@130px.png", "emailfoot", "FSG_logo@130px.png");

        if(SITE_LIVE)
        //if(Config::get("SITE_LIVE"))
        {
            $mail->AddAddress($cd['billing_email'], $cd['contact_name']);
            if($client_id == 6)
            {
                $mail->AddAddress($cd['inventory_email'], $cd['inventory_contact']);
                $mail->AddAddress('kimberly@thebigbottleco.com', 'Kimberly Lacsa');
            }
            $mail->AddBCC('mark.solly@fsg.com.au', 'Mark Solly');
        }
        else
        {
            $mail->AddAddress('mark.solly@fsg.com.au', 'Mark Solly');
        }

        $mail->Send();
    }

    public static function sendPasswordReset($user_id, $name, $email, $password_token)
    {
        $mail = new PHPMailer();
        //die("Reset URL: ".Config::get('EMAIL_FROM'));
        $body = file_get_contents(Config::get('EMAIL_TEMPLATES_PATH')."passwordreset.html");
        $replace_array = array("{LINK}", "{NAME}");
        $replace_with_array = array(Config::get('EMAIL_PASSWORD_RESET_URL') . "?id=" . urlencode(Encryption::encryptId($user_id)) . "&token=" . urlencode($password_token), $name);
        $body = str_replace($replace_array, $replace_with_array, $body);

        $mail->SetFrom(Config::get('EMAIL_FROM'), Config::get('EMAIL_FROM_NAME'));

        $mail->AddAddress($email, $name);

        $mail->Subject = "Reset your password for Baledout Web Portal";

        $mail->AddEmbeddedImage(IMAGES."email_logo.png", "emailfoot", "email_logo.png");

        $mail->MsgHTML($body);

        if($mail->Send())
        {
            return true;
        }
        else
        {
            echo "<pre>",print_r($mail->ErrorInfo),"</pre>"; die();
            Logger::log("Mail Error", print_r($mail->ErrorInfo, true), __FILE__, __LINE__);
            throw new Exception("Email couldn't be sent to ". $name);
        }
    }

    public static function sendCronError($e, $client)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        try{
            $mail->Host = "smtp.office365.com";
            $mail->Port = Config::get('EMAIL_PORT');
            $mail->SMTPDebug  = 0;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = Config::get('EMAIL_UNAME');
            $mail->Password = Config::get('EMAIL_PWD');
            $body = file_get_contents(Config::get('EMAIL_TEMPLATES_PATH')."cronerror.html");
            $replace_array = array("{CONTENT}", "{CLIENT}");
    		$replace_with_array = array(print_r($e, true), $client);
    		$body = str_replace($replace_array, $replace_with_array, $body);
            $mail->SetFrom(Config::get('EMAIL_FROM'), Config::get('EMAIL_FROM_NAME'));
            $mail->AddAddress('mark.solly@fsg.com.au', 'Mark Solly');
            $mail->Subject = "Cron Import Error";
            $mail->AddEmbeddedImage(IMAGES."FSG_logo@130px.png", "emailfoot", "email_logo.png");
            $mail->MsgHTML($body);
            if(!$mail->Send())
            {
                Logger::log("Mail Error", print_r($mail->ErrorInfo, true), __FILE__, __LINE__);
                throw new Exception("Email couldn't be sent ");
            }
        }
        catch (phpmailerException $e) {
            Logger::log("Mail Error: ", print_r($e->errorMessage(), true), __FILE__, __LINE__);
            throw new Exception("Email couldn't be sent ");
        } catch (Exception $e) {
            Logger::log("Mail Error: ", print_r($e->getMessage(), true), __FILE__, __LINE__);
            throw new Exception("Email couldn't be sent ");
        }

    }

    public static function sendNewUserEmail($name, $email)
    {
        $mail = new PHPMailer();
        try{
            $body = file_get_contents(Config::get('EMAIL_TEMPLATES_PATH')."new_user.html");
            $replace_array = array("{NAME}");
            $replace_with_array = array($name);
            $body = str_replace($replace_array, $replace_with_array, $body);
            $mail->AddEmbeddedImage(IMAGES."email_logo.png", "emailfoot", "email_logo.png");
            $mail->SetFrom(Config::get('EMAIL_FROM'), Config::get('EMAIL_FROM_NAME'));
            $mail->Subject = "Access Instructions For Baledout Web Portal";
            $mail->MsgHTML($body);
            $mail->addAttachment(Config::get('EMAIL_ATTACHMENTS_PATH')."Portal Instructions.pdf", 'portal_instructions.pdf');
            $mail->AddAddress($email, $name);
            $mail->AddBCC('mark@baledout.com.au', 'Mark Solly');
            if(!$mail->Send())
            {
                Logger::log("Mail Error", print_r($mail->ErrorInfo, true), __FILE__, __LINE__);
                //throw new Exception("Email couldn't be sent ");
            }
        }
        catch (phpmailerException $e) {
            Logger::log("Mail Error: ", print_r($e->errorMessage(), true), __FILE__, __LINE__);
            throw new Exception("Email couldn't be sent ");
        } catch (Exception $e) {
            Logger::log("Mail Error: ", print_r($e->getMessage(), true), __FILE__, __LINE__);
            throw new Exception("Email couldn't be sent ");
        }
    }

 }
	
