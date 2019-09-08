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
        $user->find($user->id);
//        $passHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $users = array(
            $user->id => array(
                "username" => $user->id,
                "password" => $user->password
            )
        );
//        $users = array(
//            "nadee" => array(
//                "username" => "nadee",
//                "password" => "123",
//                "roles" => ["ROLE_ROOT", "ROLE_CREATE_REPORT"]
//            ),
//            "anuruddha" => array(
//                "username" => "anuruddha",
//                "password" => "Pass123@",
//                "roles" => ["ROLE_VIEW_REPORT"]
//            )
//        );


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

        if (!password_verify($password, $users[$username]["password"])) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }
//        if ($password !== $users[$username]["password"]) {
//            
//        }

        $_SESSION["user"]["name"] = $users[$username];
        $loggedUser = $users[$username];
        unset($loggedUser["password"]);

        $loggedUser["postBack"] = "/home/index";
        if (isset($postBack)) {
            $loggedUser["postBack"] = urldecode(urldecode(urldecode($postBack)));
        }
        echo json_encode($loggedUser);
//        }
    }

    public function userreg() {
        if (isset($_SESSION["user"]["name"])) {
            $url = APPROOT . "/home/index";
            header("location:$url");
        }

        $this->loadView(null, true);
    }

    public function doRegistration() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
//        if (isset($_POST['submitsave'])) {
        $userData = $_POST["userData"];
        $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);

        $user = new User();
        $user->id = $userData['username'];
        $user->fname = $userData['fName'];
        $user->lname = $userData['lName'];
        $user->email = $userData['email'];
        $user->password = $passHash;

        $res = $user->save();
        if ($res) {
//                try {
//                    $mailer = new EMailer();
//                    $mailer->addTo($user->email)
//                            ->addSubject("Welcome to TopNotch")
//                            ->addBody("Your registration with the TopNotch has been successfully completed!")
//                            ->send();
//                } catch (Exception $e) {
//                    //TODO: Log the mailer error!
//                }
//                $otp = OTPUtility::generate();
//                MessageUtility::sendMessage('127.0.0.1', '9710', 'admin', '123', '+94718124812', "Your OTP for phone number verification is 1");
            //
                $result = array("success" => true, "message" => "Welcome " . $user->fname . "!");
            echo json_encode($result);

//                $url = APPROOT . "/user/login";
//                header("location:$url");
        } else {
            header("HTTP/1.1 500 Internal Server Error");
        }
//        }
    }

    public function exists() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];

        if ($username === "admin") {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function userDetails() {
        $this->loadView();
    }

}
