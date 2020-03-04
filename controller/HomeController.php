<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/2/2019
 * Time: 4:54 PM
 */

class HomeController extends BaseController
{
    public function index(){
        $this->loadView();
    }
    
    public function loadImage(){
        $user=new User();
        $user->loadImage();
    }
    
    public function sendMail() {
        $mailData=$_POST['mailData'];
        echo json_encode($mailData);
        try {
            $mailer = new EMailer();
            $mailer->addTo($mailData['emailto'])
                    ->addSubject($mailData['subject'])
                    ->addBody($mailData['message'])
                    ->send();
            //TODO: Verify email address using a link sent via the above email.
        } catch (Exception $e) {
            $e->getMessage();
            //TODO: Log error (Mailer error)
        }
    }
}