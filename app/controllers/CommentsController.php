<?php  

class CommentsController extends  TweetsController{
    private $Tweet;
    private $User;
    public function __construct()
    {
     $this->Tweet  = $this->model("Tweet") ;
     $this->User  = $this->model("User") ;
     
    }

    public function update($id){
           
        $tweet =  $this->Tweet->get_comment($id);
   
        
        if($tweet->user_id != user()->id){
            errors("Something went wrong");
            redirect("home");
        }

        $req= $this->store($tweet->media);
        if($this->Tweet->update_comment($id,$req)){
            back_success("Tweet updated successfully");
        }
        else{
            back(["Can not update this tweet, try later"]);
        }
        
    }

    public function load_preview_tweet_for_comment($id){            
        $tweet =$this->Tweet->get($id);

        echo Show::preview_tweet_for_commment($tweet);

    }

    public function load_comment($id){
        $comments =$this->Tweet->get_comments($id); 
        $count = $this->Tweet->get_total_comment($id);
        foreach($comments as $comment){
            $user = $this->User->get($comment->user_id);
            $comment->like_class =$this->user_is_love_comment_class($comment->id) ?? $comment->like_class ="";  

            echo Show::show_comments($comment,$user);
       
        }

    }
    public function preview_edit($id){
        $tweet =$this->Tweet->get_comment($id);
        if($tweet){
            echo Show::preview_edit_comment($tweet);
        }
        // echo Show::preview_tweet_for_commment($tweet);
    }

    public function get_total_comment($id){
        return $this->Tweet->get_total_comment($id);
    }

    public function delete($id){
        $comment =  $this->Tweet->get_comment($id);
        if($comment->user_id != user()->id){
            errors("Something went wrong from here");
            redirect("home");
        }

        if($this->Tweet->delete_comment($id)){
            if(!empty($comment->media)){
                unlink(UPLOAD_ROOT."/tweet/$comment->media");
            }
            back_success("Comment deleted successfully");
        }
        else{
            back(["Can not delete this comment, try later"]);
        }

    }

    public function love($id){
        if($this->Tweet->is_love_comment($id)){
            $this->Tweet->dis_like_comment($id);
        }else{
            $this->Tweet->love_comment($id);
        }
       
    }

    public function user_is_love_comment_class($id){
        if($this->Tweet->user_love_comment($id)){
            return "testiaire";
        }

    }
    
}
