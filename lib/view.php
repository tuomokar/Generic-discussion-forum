<?php

class View{

    public static function make($view, $content = array()){
        $twig = self::get_twig();
        $twig->addExtension(new Twig_Extensions_Extension_Text());

        try{
            // set the message added at redirect
            self::set_flash_message($content);

            // set base_path variable to the views with the BASE_PATH constable defined in index.php
            $content['base_path'] = BASE_PATH;

            // set the logged in user to view if currentUser method is implemented in SessionController
            if(method_exists('SessionController', 'currentUser')){
                $content['currentUser'] = SessionController::currentUser();
            }

            // print out the view rendered by Twig
            echo $twig->render($view, $content);
        } catch (Exception $e){
            die('Virhe näkymän näyttämisessä: ' . $e->getMessage());
        }

        exit();
    }

    private static function get_twig(){
        Twig_Autoloader::register();

        $twig_loader = new Twig_Loader_Filesystem('app/views');

        return new Twig_Environment($twig_loader);
    }

    private static function set_flash_message(&$content){
        if(isset($_SESSION['flash_message'])){

            $flash = json_decode($_SESSION['flash_message']);

            foreach($flash as $key => $value){
                $content[$key] = $value;
            }

            unset($_SESSION['flash_message']);
        }
    }
}
