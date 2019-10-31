<?php

/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/9/2019
 * Time: 5:29 PM
 */
class UserController extends BaseController {

    public function login($postBack = null) {
        if (isset($_SESSION["user"]["name"])) {
            $url = APPROOT . "/home/index";
            header("location:$url");
        }
        $data = array("postBack" => $postBack, "pageTitle" => "Login");

        $this->loadView($data, true);
    }

    public function authenticate() {
//        if (isset($_POST['loginuser'])) {
        $user = new User();
        $user->id = $_POST['username'];
        $user->findById($user->id);

        $users = array(
            $user->id => array(
                "username" => $user->id,
                "password" => $user->password
            )
        );

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];
        $postBack = $_POST["postBack"];

        if (!array_key_exists($username, $users)) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }

        if ($password !== $users[$username]["password"]) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }

//        if (!password_verify($password, $users[$username]['password'])) {
//            header("HTTP/1.1 403 FORBIDDEN");
//            return;
//        }

        $_SESSION["user"]["name"] = $users[$username];
        $loggedUser = $users[$username];
        unset($loggedUser["password"]);

        $loggedUser["postBack"] = "/home/index";
        if (isset($postBack)) {
            $loggedUser["postBack"] = urldecode(urldecode(urldecode($postBack)));
        }
        echo json_encode($loggedUser);
    }

    public function userreg() {
//        if (isset($_SESSION["user"]["name"])) {
//            $url = APPROOT . "/home/index";
//            header("location:$url");
//        }

        $this->loadView(null, true);
    }

    public function logoff() {
        unset($_SESSION["user"]["name"]);
        session_destroy();
        $url = APPROOT . "/user/login";
        header("location:$url");
    }

    public function doRegistration() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $userData = $_POST["userData"];
        $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);

        $user = new User();
        $user->id = $userData['username'];
        $user->password = $passHash;

        $userDetails = new UserDetails();
        $userDetails->userid = $userData['username'];
        $userDetails->fname = $userData['fName'];
        $userDetails->lname = $userData['lName'];
        $userDetails->mobile = $userData['mobile'];
        $userDetails->email = $userData['email'];
        $userDetails->picture = $userData['picture'];
        $userDetails->status = 1;

        $resUser = $user->save();
        $resUserDet = $userDetails->save();

        if ($resUser && $resUserDet) {
//                try {
//                    $mailer = new EMailer();
//                    $mailer->addTo($user->email)
//                            ->addSubject("Welcome to TopNotch")
//                            ->addBody("Your registration with the TopNotch has been successfully completed!")
//                            ->send();
//                } catch (Exception $e) {
//                    //TODO: Log the mailer error!
//                }
//            $otp = OTPUtility::generate($user->mobile);
//            MessageUtility::sendMessage($otp->mobileNumber, "Your OTP for phone number verification is 1");

            $result = array("success" => true, "message" => "Welcome " . $userDetails->fname . "!");
            echo json_encode($result);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function exists() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];

//        if ($username === "admin") {
//            echo "false";
//        } else {
//            echo "true";
//        }
        $user = new User();
        $user->checkId($username);
    }

    public function userDetails() {
        $this->loadView();
    }

    public function uExists() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $userDetails = new UserDetails();
        $userDetails->checkUsername();
    }

}
