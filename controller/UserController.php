<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/9/2019
 * Time: 5:29 PM
 */

class UserController extends BaseController
{
    public function login($postBack = null)
    {
        if(isset($_SESSION["user"]["name"])){
            $url = APPROOT . "/home/index";
            header("location:$url");
        }
        $data = array("postBack"=>$postBack);
        $this->loadView($data);
    }

    public function authenticate()
    {
        $users = array(
            "esoft" => array(
                "username" => "esoft",
                "password" => "Pass123@",
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
        if(isset($postBack)){
            $loggedUser["postBack"] = urldecode(urldecode(urldecode($postBack)));
        }
        echo json_encode($loggedUser);
    }
    
    public function userReg(){
        $this->loadView();
    }
}