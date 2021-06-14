<?php 

function dump($array){
    echo "<pre>";
        var_dump($array);
    echo "</pre>";

    // die();
}
function dd($array){
    echo "<pre>";
        var_dump($array);
    echo "</pre>";

    die();
}

function errors($errors){
    $_SESSION["errors"] = $errors;
}
function success($success){
    $_SESSION["success"] = $success;
}

function show_errors(){
    if(isset($_SESSION["errors"])){
        $errors =$_SESSION["errors"];
        if(is_array($errors)){
            echo "<ul class='bg-red-100 py-3 px-3 flash my-3'>";
            foreach ($errors as $error ) {
                str_replace("_"," ",$error);
                echo "<li class='text-sm style text-red-600 my-2'> $error </li>";
            }
            echo "</ul>";
        }
       unset( $_SESSION["errors"] );

    }
}

function show_success(){
        
    if(isset($_SESSION["success"])){
            $success =$_SESSION["success"];
            echo "<ul class='bg-green-100 py-3 px-3  my-3 flash'>";
                str_replace("_"," ",$success);
                echo "<li class='text-sm style text-black my-2'> $success </li>";
            echo "</ul>";
    }
    unset($_SESSION["success"] );

}
function get_success(){
    if(isset($_SESSION["success"])){
        $success =$_SESSION["success"];
        $template ="<ul class='bg-green-100 py-3 px-3  my-3'>";
            str_replace("_"," ",$success);
          $template .= "<li class='text-sm style text-black my-2'> $success </li>";
        $template .= "</ul>";
        unset($_SESSION["success"] );
        return $template;
}

}


function redirect ($path){
    header("Location:".URL_ROOT ."$path");
    exit ;
}

function back($errors =[]){
    if(sizeof($errors)>0){
        errors($errors);
    }
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit ;
}
function back_success($success =[]){
    if(sizeof($success)>0){
        success($success);
    }
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit ;
}

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
  
  function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}
  
  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}


function user(){
    return $_SESSION["user"];
}

function show($text,$else){
    if(strlen($text)>0){
        echo $text;
    }
    else{
        echo $else;
    }
}

function is_set($variable){
    return  isset($variable) && !empty($variable);
}


function human_date($date){
    return date("F j, Y",strtotime($date));
}
function joined_date($date){
    return date("F  Y",strtotime($date));
}



