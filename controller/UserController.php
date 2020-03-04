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
        $user = new User();
        $user->id = $_POST['username'];
        $user->findById($user->id);

        $userDetails = new UserDetails();
        $userDetails->userid = $_POST['username'];
        $userDetails->findByUId($userDetails->userid);

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
        
        $errMsg;
        $encrypt=  md5($password);
        if ($encrypt!= $users[$username]['password']) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }
        if ($userDetails->status!=1) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }

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
        $passHash = md5($userData['password']);
        $user = new User();
        $user->id = $userData['username'];
        $user->password = trim($passHash);
        $userDetails = new UserDetails();
        $userDetails->userid = $userData['username'];
        $userDetails->fname = $userData['fName'];
        $userDetails->lname = $userData['lName'];
        $userDetails->mobile = $userData['mobile'];
        $userDetails->email = $userData['email'];
        $userDetails->picture = $userData['picture'];
        $userDetails->status = "0";
        $resUser = $user->save();
        $resUserDet = $userDetails->save();
        if ($resUser && $resUserDet) {
            $otp = OTPUtility::generate($userDetails->mobile);
            try {
                $mailer = new EMailer();
                $mailer->addTo($userDetails->email)
                        ->addSubject("Welcome to TopNotch")
                        ->addBody("Your activation code is " . $otp->value . ".")
                        ->send();
            } catch (Exception $e) {
            }

            MessageUtility::sendMessage($otp->mobileNumber, "Your OTP for phone number verification is " . $otp->value . ".");

            $result = array("success" => true, "message" => "Welcome " .
                $userDetails->fname . "!");
            echo json_encode($result);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updateUser(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $userData = $_POST["userData"];
        $userDetails = new UserDetails();
        $resUserDet = $userDetails->updateUser($userData['username']);
//        echo 'ok';
        echo json_encode($resUserDet);
        if (!$resUserDet) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function exists() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];
        $user = new User();
        $user->checkId($username);
    }

    public function userDetails() {
        $this->loadView();
    }

    public function UserList(){
        $this->loadView();
    }

    public function loadUsers() {
        $userDetails = new UserDetails();
        $res = $userDetails->findList();
    }
    
    public function Roles() {
        $this->loadView();
    }

    public function addRole() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $roleData = $_POST["roleData"];

        $role = new Roles();
        $role->description = $roleData['description'];
        $resRole = $role->save();
        if ($resRole) {
            echo json_encode($resRole);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function UserRoles() {
        $this->loadView();
    }

    public function loadName() {
        $userDetails = new UserDetails();
        $userDetails->loadName();
    }

    public function loadRoleDes() {
        $role = new Roles();
        $role->loadRoleDes();
    }

    public function addURole() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $uRoleData = $_POST["uRoleData"];

        $userRole = new UserRoles();
        $userRole->UserId = $uRoleData['user'];
        $userRole->roleId = $uRoleData['role'];
        $resRole = $userRole->save();
        if ($resRole) {
            echo json_encode($resRole);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function uExists() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $userDetails = new UserDetails();
        $userDetails->checkUsername();
    }

    public function uRExists() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $userDetails = new UserDetails();
        $userDetails->checkUserRole();
    }

    public function permission() {
        $userRoles = new UserRoles();
        $roles = $userRoles->getUserRoles();
        $description = $roles['description'];
        echo $roles;
    }

    public function UserActivate() {
        $this->loadView(null, true);
    }

    public function activate() {
        $actData = $_POST["actData"];
        echo json_encode($actData);
        $userDetails = new UserDetails();
        $userDetails->activateUser($actData['username']);
    }

    public function checkCode(){
        $userDetails=new UserDetails();
        $userDetails->checkCode();
    }
    
    public function ChangePassword(){
        $this->loadView();
    }
    
     public function passexists() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $user = new User();
        $user->checkPassword();
    }
    
    public function changePass(){
        $uData = $_POST["actData"];
        echo json_encode($uData);
        $pass=  md5($uData['password']);
        $user = new User();
        $user->changePass($pass);
    }
    
    public function pattern(){
        $number = $_POST["mobile"];
        if (is_string($number)) {
            echo 'false';
        }else{
            echo 'true';
        }
    }
}
