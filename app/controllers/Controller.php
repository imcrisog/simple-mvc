<?php

namespace App\Controllers;

class Controller {

    public function view($path, $data = [])
    {
        extract($data);

        $path = str_replace('.', '/', $path);

        if (file_exists("../resources/views/{$path}.php")) {

            ob_start();
            $child = "../resources/views/{$path}.php";
            include "../resources/views/Layouts/app.php";
            $view = ob_get_clean();

            return $view;
        }

        else {
            return die("La vista PHP no se encontro");
        }
    }

    public function validator(array $camps) 
    {
        foreach ($camps as $camp) {
            if (!isset($_POST[$camp]) || $_POST[$camp] == "") {
                return "Falta el campo " . ucfirst($camp);
            }
        }

        return false;
    }

    public function backWithError(string $route, string $msg)
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);  
        session_start();
        $_SESSION['msg'] = [$msg, "e", true];
        return header("Location: " . LOCALHOST . $route);
    }

    public function errormsg(string $msg)
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);  
        session_start();
        $_SESSION['msg'] = [$msg, "e", false];
    }

    public function successmsg(string $msg)
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);  
        session_start();
        $_SESSION['msg'] = [$msg, "s", false];
    }

    public function warningmsg(string $msg)
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);  
        session_start();
        $_SESSION['msg'] = [$msg, "w", false];
    }

    public function redirect(string $route)
    {
        return header("Location: " . LOCALHOST . $route);
    }

}