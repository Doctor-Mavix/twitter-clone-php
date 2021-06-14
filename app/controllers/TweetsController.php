<?php 

    class TweetsController extends Controller{
        private $Tweet;
        private $User;
        public function __construct()
        {
         $this->Tweet  = $this->model("Tweet") ;
         $this->User  = $this->model("User") ;
         
        }

        public function tweet(){
            $req= $this->store();
            if($this->Tweet->post($req)){
                back_success("Tweet posted successfully");
            }
            else{
                back(["Can not tweet, try later"]);
            }

        }
        public function preview_edit($id){
            $tweet =  $this->Tweet->get($id);
            if($tweet){
                echo Show::preview_edit_tweet($tweet);
            }
        }
        public function update($id){
           
            $tweet =  $this->Tweet->get($id);
       
            
            if($tweet->user_id != user()->id){
                errors("Something went wrong");
                redirect("home");
            }

            $req= $this->store($tweet->media);
            if($this->Tweet->update($id,$req)){
                back_success("Tweet updated successfully");
            }
            else{
                back(["Can not update this tweet, try later"]);
            }
            
        }

        
        public function delete($id){
            $tweet =  $this->Tweet->get($id);
            if($tweet->user_id != user()->id){
                errors("Something went wrong from here");
                redirect("home");
            }
           
            if($this->Tweet->delete($id)){
                if(!empty($tweet->media)){
                    unlink(UPLOAD_ROOT."/tweet/$tweet->media");
                }
                back_success("Tweet deleted successfully");
            }
            else{
                back(["Can not delete this tweet, try later"]);
            }

        }
        public function store($media =""){
            $req = [
                'body' => trim($_POST['body'])
              ];
            
            
            if(is_set($_FILES["media"]["name"])){
                $old_media = $media;
                $media = $_FILES["media"]["name"];
                $file =$_FILES["media"]["tmp_name"];
                $media = Upload::file($file,$media,UPLOAD_ROOT."/tweet/");
                if(!empty($old_media)){
                    unlink(UPLOAD_ROOT."/tweet/$old_media");

                }

            }
            else if(!empty($media)){
                unlink(UPLOAD_ROOT."/tweet/$media");
                $media ="";
            }

            if(empty($req["body"]) && empty($media)){
                back(["Media or text is required to tweet"]);
            }
            $req["media"]=$media;

            return $req;
        }

        public function home(){
            $tweets =$this->Tweet->get_home_tweets();
            return $this->view("tweet/home",$tweets);
        }

        public function show($req){
            if(isset($req)){
                $id = $req[0];
                $tweet =$this->Tweet->get($id);
                return $this->view("tweet/tweet",$tweet);
            }

        }

        public function get_profil(){
            $tweet =$this->Tweet->get_profil();
            $likes =$this->Tweet->get_profil_likes_tweet();
            $replys =$this->Tweet->get_profil_tweets_reply();
            $profil = new stdClass();
            $profil->tweets = $tweet;
            $profil->likes = $likes;
            $profil->replys = $replys;
            return $this->view("profil/profil",$profil);   
        }

        public function get_user_profil($username){
            $tweet =$this->Tweet->get_profil($username);
            $likes =$this->Tweet->get_profil_likes_tweet($username);
            $replys =$this->Tweet->get_profil_tweets_reply($username);
            $profil = new stdClass();
            $profil->tweets = $tweet;
            $profil->likes = $likes;
            $profil->replys = $replys;
            return $this->view("profil/profil",$profil);   
        }

        public function get_likes_tweet(){
            // $tweets =$this->Tweet->get_profil_likes_tweet();
            // foreach($tweets as $tweet){
            //     $template= Show::tweet($tweet);
            //     echo $template;
            // }
        }


        public function love($id){
            $love="";
            if($this->Tweet->is_love($id)){
                $love =$this->Tweet->dis_like($id);
            }else{
                $love =$this->Tweet->love($id);

            }
           
            echo $love;
        }
       

        public function user_is_love_class($id){
            if($this->Tweet->user_love_tweet($id)){
                return "testiaire";
            }
        }


        public function comment($id){
            $req= $this->store();
            $req["id"]=$id;
            if($this->Tweet->comment($req)){
                back_success("Comment add successfully");
            }
            else{
                back(["Can not add comment, try later"]);
            }


        }
        public function load_tweet($id){
            $tweet =$this->Tweet->get($id);
            if($tweet){
               $tweet->total_love >1 ? $tweet->like_text ="Likes" :$tweet->like_text ="Like";  
               $tweet->like_class =$this->user_is_love_class($id) ?? $tweet->like_class ="";  
               $tweet->total_comment >1 ? $tweet->comment_text ="Comments" :$tweet->comment_text ="Comment";  
               echo Show::tweet_page($tweet);
            }
            
        }

        public function load_reaction($id){
            $tweet =$this->Tweet->get($id);
            if($tweet){
               $tweet->total_love >1 ? $tweet->like_text ="Likes" :$tweet->like_text ="Like";  
               $tweet->like_class =$this->user_is_love_class($id) ?? $tweet->like_class ="";  
               $tweet->total_comment >1 ? $tweet->comment_text ="Comments" :$tweet->comment_text ="Comment";  
               echo Show::tweet_reaction($tweet);
            }
                        
        }

        public function get_total_comment($id){
            return $this->Tweet->get_total_comment($id);
        }
    }