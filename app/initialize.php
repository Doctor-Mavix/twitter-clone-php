<?php 
    session_start();
    ob_start();

    /***
     * Module required
     */
    require_once('config/config.php');

    require_once('core/Database.php');
    require_once("core/Controller.php");
    require_once('core/Router.php');

    require_once("helpers/function.php");
    require_once("helpers/Show.php");
    require_once("helpers/Validation.php");
    require_once("helpers/Auth.php");
    require_once("helpers/Upload.php");



    $db =new Database();

    $bdd= $db->get_db();
    
    
    