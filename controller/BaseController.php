<?php

/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/2/2019
 * Time: 5:07 PM
 */
class BaseController {

    protected function loadView($vars = null, $plain = false, $main = false) {
        $backtrace = debug_backtrace();
        $lastCaller = end($backtrace);
        $controller = strtolower(str_replace("Controller", "", $lastCaller["class"]));
        $action = $lastCaller["function"];

        if (isset($vars)) {
            extract($vars);
        }

        $header = "header";
        $footer = "footer";

        if ($plain === true) {
            $header = "header-plain";
            $footer = "footer-plain";
        }

        if ($main === true) {
//            $header = "header-main";
//            $footer = "footer-main";
            require_once (ROOT . "view/$controller/$action.php");
        } 
        else {
            require_once(ROOT . "view/template/$header.php");
            require_once (ROOT . "view/$controller/$action.php");
            require_once(ROOT . "view/template/$footer.php");
        }
    }

}
