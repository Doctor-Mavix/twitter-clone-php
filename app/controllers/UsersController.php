<?php 
    class UsersController extends Controller {
        private $User;
        private $Tweet;
        public function __construct()
        {
         $this->User  = $this->model("User") ;
         $this->Tweet  = $this->model("Tweet") ;
         
        }

        public function welcome ($url)
        {

            $this->view($url);
            
        }

        public function register ()
        {
            $req = [
                'fullname' => trim($_POST['fullname']),
                'email' => trim($_POST['email']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'birthday' => trim($_POST['birthday']),
                
              ];
              
            $rules =[
                "fullname"=>"required|alpha_numeric|min:2|max:25",
                "email"=>"required|email|min:2|max:25",
                "password"=>"required|string|min:5|max:25",
            ];

           $errors= Validation::validate($req,$rules);
           if( $errors ){
               back($errors);
           }
                $req['password'] = password_hash($req['password'], PASSWORD_DEFAULT);
                
                // check if the email or the username already exist 
                $user =$this->User->find_email_or_username($req["email"]);
                if($user){ 
                    back(["This email already exist"]);
                }  

                $user =$this->User->find_email_or_username($req["email"]);
                if($user){ 
                    back(["This username already exist"]);
                } 

                // register and login
                $register = $this->User->register($req);
                if($register) {
                    Auth::login($register);
                    redirect('users');
                } else {  
                    die('Something went wrong');
                }


              
        }

        public function login(){
            $req = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
              ];
            $rules =[
                "email"=>"required",
                "password"=>"required"
            ];
            $errors= Validation::validate($req,$rules);
            if( $errors ){
                back($errors);
            }

             $user =$this->User->find_email_or_username($req["email"]);

             if($user){
                if(password_verify($req['password'], $user->password)) {
                    Auth::login($user->id);
                    redirect("home");
                  } 
             }
             
            back(["Invalid login"]);

             
        }

        public function logout (){
            Auth::logout();
            redirect("login");
            
        }


        public function get_user(){
            if(Auth::is_login()){
                $id = $_SESSION["user_id"];
                if(is_object($id)){
                    $id = $id->id;
                }
                $user = $this->User->get($id);
                $_SESSION["user"] =$user;
            }

            
        }
        public function get_visite_user($username){
            
            
            $user = $this->User->get($username);
           
            if(!$user){
                errors(["can't find this user"]);
                redirect("home");
            }
            $tweet =$this->Tweet->get_profil($user->id);
            $likes =$this->Tweet->get_profil_likes_tweet($user->id);
            $replys =$this->Tweet->get_profil_tweets_reply($user->id);
            $profil = new stdClass();
            $profil->user = $user;
            $profil->tweets = $tweet;
            $profil->likes = $likes;
            $profil->replys = $replys;
            $this->User->is_follow($user->id) ? $profil->status ="following": $profil->status ="follow";

            return $this->view("profil/visite-profil",$profil); 
            
        }

        public function update_profil(){
            
            $req = [
                'fullname' => trim($_POST['fullname']),
                'bio' => trim($_POST['bio']),
                'location' => trim($_POST['location']),
                'website' => trim($_POST['website']),
              ];
            $rules =[
                "fullname"=>"required|alpha_numeric|min:2|max:25",
                "bio"=>"string|max:255",
                "location"=>"string|max:30",
                "website"=>"string|max:30",
            ];
           
            $errors= Validation::validate($req,$rules);
            if( $errors ){
                back($errors);
            }   
           $media = user()->profil_picture;
           $barners = user()->barners;
           $old_profil_picture = user()->profil_picture;
        //    check if image and create image 
           if(is_set($_FILES["profil_picture"]["name"])){
                $media = $_FILES["profil_picture"]["name"];
                $file =$_FILES["profil_picture"]["tmp_name"];
                $media = Upload::file($file,$media,UPLOAD_ROOT."/profil/");
                if($old_profil_picture !== "image.png"){
                    unlink(UPLOAD_ROOT."/profil/$old_profil_picture");
                }
            }
           if(is_set($_FILES["barners"]["name"])){
                $barners = $_FILES["barners"]["name"];
                $file =$_FILES["barners"]["tmp_name"];
                $barners = Upload::file($file,$media,UPLOAD_ROOT."/barners/");
                
                unlink(UPLOAD_ROOT."/barners/".user()->barners);
            }
           
           
          $req["profil_picture"]=$media;
          $req["barners"]=$barners;

          
            if($this->User->update($req)){
                
                back_success("Profil updating successfully");
            }
            else{
                back(["Can not updated , try later"]);
            }
           
        }
    }