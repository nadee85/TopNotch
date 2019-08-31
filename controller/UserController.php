<?php

/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/9/2019
 * Time: 5:29 PM
 */
class UserController extends BaseController {

    public $errMsg;

    public function login($postBack = null) {
        if (isset($_SESSION["user"]["name"])) {
            $url = APPROOT . "/home/index";
            header("location:$url");
        }
        $data = array("postBack" => $postBack, "pageTitle" => "Login");

        $this->loadView($data, true);
    }

    public function authenticate() {
        $users = array(
            "nadee" => array(
                "username" => "nadee",
                "password" => "123",
                "roles" => ["ROLE_ROOT", "ROLE_CREATE_REPORT"]
            ),
            "anuruddha" => array(
                "username" => "anuruddha",
                "password" => "Pass123@",
                "roles" => ["ROLE_VIEW_REPORT"]
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
//        if(isset($_SESSION["user"]["name"])) {
//            $url = APPROOT . "/home/index";
//            header("location:$url");
//        }

        $this->loadView(null, true);
    }

    public function doRegistration() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        if (isset($_POST['submitsave'])) {
            $user = new User();
            $user->setUserId($_POST['txtUName']);
            $user->setFName($_POST['txtFName']);
            $user->setLName($_POST['txtLName']);
            $user->setEmail($_POST['txtEmail']);
            $user->setPassword($_POST['txtPW']);

            $res = $user->save();
            if ($res) {
                $url = APPROOT . "/home/index";
                header("location:$url");
            }
        }
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

}
