<?php 

/**
 * This controller will manage every thing in my app
 */

 class Controller {
    
    public function __construct()
    {
        
    }

    public function model($model)
    {
        require_once(APP_ROOT."/models/$model.php");

        return new $model;
    }

    public function view($url,$data=[]){

       if(file_exists(VIEW_ROOT ."/$url.php" )){
        //     if($data){
                    
        //  }
        require_once(VIEW_ROOT ."/$url.php");
        // dump($data);
       }
       else{
           die( "This route does not exist");
       }
    }
 }