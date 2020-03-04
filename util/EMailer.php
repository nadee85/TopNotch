<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 7/20/2019
 * Time: 2:51 PM
 */

class EMailer
{
    private $mailer;

    /**
     * BITMailer constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        //Server settings
        // Enable verbose debug output
//        $this->mailer->SMTPDebug = 2; 
        // Set mailer to use SMTP
        $this->mailer->isSMTP();
        // Specify main and backup SMTP servers
        $this->mailer->Host       = 'smtp.gmail.com';  
        // Enable SMTP authentication
        $this->mailer->SMTPAuth   = true;  
        // SMTP username
        $this->mailer->Username   = 'topnotchbitpro@gmail.com'; 
        // SMTP password
        $this->mailer->Password   = 'topnotch@bit'; 
        // Enable TLS encryption, `ssl` also accepted
        $this->mailer->SMTPSecure = 'tls';          
        // TCP port to connect to
        $this->mailer->Port       = 587;                                    
        $this->mailer->setFrom('topnotchbitpro@gmail.com', 'TopNotch');
        $this->mailer->addReplyTo('topnotchbitpro@gmail.com', 'Information');
    }
    
    public function addTo(...$recipients){
        foreach($recipients as $recipient){
            $this->mailer->addAddress($recipient);
        }
        return $this;
    }

    public function addSubject($subject){
        $this->mailer->Subject = $subject;
        return $this;
    }

    public function addBody($bodyText, $alternativeBody = null, $isHtml = true){
        $this->mailer->isHTML($isHtml);
        $this->mailer->Body = $bodyText;
        $this->mailer->AltBody = $alternativeBody;
        return $this;
    }

    public function send(){
        try {
            $this->mailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}