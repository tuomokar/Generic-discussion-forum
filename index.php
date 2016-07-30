<?php

  // set error messages to the view
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  // look up the location of index.php is
  $script_name = $_SERVER['SCRIPT_NAME'];
  $explode =  explode('/', $script_name);

  if($explode[1] == 'index.php'){
    $base_folder = '';
  } else {
    $base_folder = $explode[1];
  }

  // declare app's root to be in constant BASE_PATH
  define('BASE_PATH', '/' . $base_folder);

  // create new or return current session
  if(session_id() == '') {
    session_start();
  }

  // set the response's Content-Type header
  header('Content-Type: text/html; charset=utf-8');

  // take Composer into use
  require 'vendor/autoload.php';

  $routes = new \Slim\Slim();
  $routes->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });

  // take routes into use
  require 'config/routes.php';

  $routes->run();
