<?php

// index.php
session_start();

// load and initialize any global libraries
/* require_once 'model.php';
require_once 'controllers.php'; */
spl_autoload_register(function ($class_name) {
    require_once './' . $class_name . '.php';
});



// route the request internally
//TODO: Get request path from php super global $_SERVER 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$controller = new controllers();

if ('/user/' == $uri) {
    
    /* if(empty($_SESSION['user_id'])) {
        header('Location: http://blog/user/Login');
    } */

    //TODO: list action
    $controller->list_action();
    
    //login();
} 
elseif ('/user/Login' == $uri) {
    
    //show login template
    $controller->loginTemplate();
}
elseif ('/user/show' == $uri && isset($_GET['id'])) {
    
    //TODO: show action
    $x = $_SESSION['user_id'];
    $controller->show_action($_GET['id']);
} 
elseif ('/user/register' == $uri) {
    
    //TODO: resgister
    $controller->register();    
} 
elseif ('/user/register_action' == $uri) {
    
    //TODO: resgister
     $controller->RegisterAction();    
}
elseif ('/user/login_action' == $uri) {
    
    //TODO: resgister
    $controller->LoginAction($_POST['name'], $_POST['password']);  
}
elseif ('/user/comment_action' == $uri) {
    
    //TODO: resgister
    $controller->comment_action();  
}
elseif ('/user/logout' == $uri) {
    
    //logout
    $controller->logout();
}
else {
   
    //TODO: page not found message with proper http header.
    include 'templates/pagenotfound.php';
}
