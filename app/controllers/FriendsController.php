<?php 

    class FriendsController extends UsersController{
        private $User;
        private $Tweet;

        public function __construct()
        {   
         $this->User  = $this->model("User") ;
         $this->Tweet  = $this->model("Tweet") ;

        }

        public function list_user(){
            $users = $this->User->list_users();
            foreach ($users as $user ) {
                $this->User->is_follow($user->id) ? $status ="following": $status ="follow";
                echo Show::user($user,$status);
            }
        }
        public function who_to_follow(){
            $users = $this->User->list_who_to_follow();
            foreach ($users as $user ) {
                $this->User->is_follow($user->id) ? $status ="following": $status ="follow";
                echo Show::user($user,$status);
            }
        }

        public function follow($id){
            // $users = $this->User->follow(); 
            if($this->User->is_follow($id)){
                $this->User->unfollow($id);
            }else{
                $this->User->follow($id);
            }
        }

        public function list_followers(){
            $users = $this->User->list_followers();
            if(!empty($users)){
                foreach ($users as $user ) {
                    $this->User->is_follow($user->id) ? $status ="following": $status ="follow";
                    echo Show::user($user,$status);
                }
            }else{
                echo Show::empty("You does'nt have a followers yet");
            }
        }

        public function show_follow_visite_btn($id){

            $this->User->is_follow($id) ? $status ="following": $status ="follow";
            echo Show::profil_follow_btn($id,$status);

        }


    }