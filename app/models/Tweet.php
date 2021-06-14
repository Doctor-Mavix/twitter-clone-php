<?php 
    class Tweet {
        public function post($data){
            global $bdd;
            $req =$bdd->prepare('INSERT INTO tweets(body,media,user_id) VALUES(?,?,?)');
                                        
            return $req->execute(array($data["body"],$data["media"],user()->id));
        }

        public function update($id , $data){
            global $bdd;
            $req =$bdd->prepare('UPDATE tweets SET
                                    body =? ,
                                    media = ? 
                                    WHERE id=?
                                ');
                                        
            return $req->execute(array($data["body"],$data["media"],$id));
        }

        public function delete($id ){
            global $bdd;
            $req =$bdd->prepare('DELETE FROM tweets 
                                    WHERE id =? 
                                    LIMIT 1
                                ');
                                        
            return $req->execute(array($id));
        }

       
        public function get_home_tweets(){
            global $bdd ;
            $req= $bdd->prepare("SELECT body,media,username,fullname ,tweets.id ,user_id ,profil_picture ,tweets.created_at
                                    FROM tweets 
                                    INNER JOIN users ON tweets.user_id = users.id 
                                    ORDER BY tweets.created_at DESC
                                ");
            $req->execute();
            
            $tweets= $req->fetchAll();
            return $this->getReaction($tweets);

        }

       
        public function get($id){
            global $bdd ;
            $req= $bdd->prepare("SELECT body,media,username,fullname ,tweets.id ,user_id ,profil_picture ,verified,tweets.created_at
                                    FROM tweets 
                                    INNER JOIN users ON tweets.user_id = users.id
                                    WHERE tweets.id = ?
                                ");
            $req->execute(array($id));

            $tweet =$req->fetch();
            if($tweet){
                return $this->getReaction($tweet);
            }else{
                errors(["Cant find this tweet "]);
                redirect("home");
            }

        }

        public function get_profil($id=""){
            global $bdd ;
            $req= $bdd->prepare("SELECT body,media,username,fullname ,tweets.id ,tweets.user_id ,profil_picture ,tweets.created_at
                                    FROM tweets 
                                    INNER JOIN users ON tweets.user_id = users.id 
                                    -- INNER JOIN likes ON tweets.id = likes.tweet_id 
                                    WHERE tweets.user_id = ?
                                    ORDER BY tweets.created_at DESC
                                ");
            !empty($id) ? $req->execute(array($id)) :$req->execute(array(user()->id));
            

            $tweets =  $req->fetchAll();
            if($tweets){
                return $this->getReaction($tweets);
            }
        }   
        
        public function get_profil_likes_tweet($id=""){
            global $bdd ;
            $req= $bdd->prepare("SELECT body,media,username,fullname ,tweets.id ,tweets.user_id ,profil_picture ,tweets.created_at
                                    FROM tweets 
                                    INNER JOIN users ON tweets.user_id = users.id 
                                    INNER JOIN likes ON tweets.id = likes.tweet_id 
                                    WHERE likes.user_id = ?
                                    ORDER BY tweets.created_at DESC
                                ");
            !empty($id) ? $req->execute(array($id)) :$req->execute(array(user()->id));


            $tweets =  $req->fetchAll();
            return $this->getReaction($tweets);

        }
        public function get_profil_tweets_reply($id=""){
            global $bdd ;
            $req= $bdd->prepare("SELECT DISTINCT tweets.created_at, tweets.body,tweets.media,username,fullname ,tweets.id ,tweets.user_id ,profil_picture 
                                    FROM tweets 
                                    INNER JOIN users ON tweets.user_id = users.id 
                                    INNER JOIN comments ON tweets.id = comments.tweet_id 
                                    WHERE comments.user_id = ?
                                    ORDER BY tweets.created_at DESC
                                ");
            !empty($id) ? $req->execute(array($id)) :$req->execute(array(user()->id));

            $tweets =  $req->fetchAll();
            return $this->getReaction($tweets);

        }
        
        public function getReaction($tweets){
            if(is_array($tweets)){
                foreach ($tweets as $tweet) {
                    $tweet->total_love =$this->get_loves($tweet->id);
                    $tweet->total_comment =$this->get_total_comment($tweet->id);
                }
            }
            else{
                $tweets->total_love =$this->get_loves($tweets->id);
                $tweets->total_comment =$this->get_total_comment($tweets->id);

            }
            return $tweets;
        }

        public function love($id){
            global $bdd;
            
            $req = $bdd->prepare("INSERT INTO likes(tweet_id,user_id)
                                    VALUES( ?,?)
                            ");
            
            $req->execute(array($id,user()->id));
            return $this->get_loves($id);
        }
        public function dis_like($id){
            global $bdd;
            
            $req = $bdd->prepare("DELETE FROM likes
                                    WHERE tweet_id = ?
                                    AND user_id = ?
                                    LIMIT 1
                            ");
            
            $req->execute(array($id,user()->id));
            return $this->get_loves($id);
        }


        public function is_love($id){
            global $bdd;

            $req = $bdd->prepare("SELECT id as total FROM likes
                                    WHERE tweet_id = ? 
                                    AND user_id = ?
                            ");
            
            $req->execute(array($id,user()->id));

            return $req->fetch();
        }

        public function get_loves($id){
            global $bdd;

            $req = $bdd->prepare("SELECT COUNT(id) as total FROM likes
                                    WHERE tweet_id = ?
                            ");
            
            $req->execute(array($id));
            return $req->fetch()->total;
        }
         
        public function user_love_tweet($id){
            global $bdd;

            $req = $bdd->prepare("SELECT id  FROM likes
                                    WHERE tweet_id = ? 
                                    AND user_id = ?
                            ");
            
            $req->execute(array($id,user()->id));
            return $req->fetch();
        }
        

        public function comment($data){
            global $bdd;
            $req =$bdd->prepare('INSERT INTO comments(body,media,tweet_id,user_id) VALUES(?,?,?,?)');
                                        
            return $req->execute(array($data["body"],$data["media"],$data["id"],user()->id));
        }

        public function get_comments($id){
            global $bdd;

            $req = $bdd->prepare("SELECT c.id,c.body ,c.media ,c.user_id ,u.username  ,c.tweet_id,c.created_at
                                    FROM comments c,tweets t,users u
                                    WHERE t.id = c.tweet_id
                                    AND t.user_id = u.id
                                    AND tweet_id = ? 
                                    ORDER BY c.created_at DESC
                            ");
            
            $req->execute(array($id));
            $comments= $req->fetchAll();
            return $this->get_comment_reaction($comments);
         
        }
        public function get_comment($id){
            global $bdd;

            $req = $bdd->prepare("SELECT c.id,c.body ,c.media ,c.user_id ,u.username  ,c.tweet_id
                                    FROM comments c,tweets t,users u
                                    WHERE t.id = c.tweet_id
                                    AND t.user_id = u.id
                                    AND c.id = ? 
                                    ORDER BY c.updated_at DESC
                            ");
            
            $req->execute(array($id));
         
            return $req->fetch();
        }

        public function get_total_comment($id){
            global $bdd; 
            
            $req = $bdd->prepare("SELECT COUNT(id) as total FROM comments
                                    WHERE tweet_id = ?
                            ");
            
            $req->execute(array($id));
            return $req->fetch()->total;
        }

        public function update_comment($id , $data){
            global $bdd;
            $req =$bdd->prepare('UPDATE comments SET
                                    body =? ,
                                    media = ? 
                                    WHERE id=?
                                ');
                                        
            return $req->execute(array($data["body"],$data["media"],$id));
        }

        public function delete_comment($id ){
            global $bdd;
            $req =$bdd->prepare('DELETE FROM comments 
                                    WHERE id =? 
                                    LIMIT 1
                                ');
                                        
            return $req->execute(array($id));
        }


        public function love_comment($id){
            global $bdd;
            
            $req = $bdd->prepare("INSERT INTO comment_likes(comment_id,user_id)
                                    VALUES( ?,?)
                            ");
            
            $req->execute(array($id,user()->id));
            return $this->get_loves($id);
        }
        public function dis_like_comment($id){
            global $bdd;
            
            $req = $bdd->prepare("DELETE FROM comment_likes
                                    WHERE comment_id = ?
                                    AND user_id = ?
                                    LIMIT 1
                            ");
            
            $req->execute(array($id,user()->id));
            return $this->get_loves($id);
        }


        public function is_love_comment($id){
            global $bdd;

            $req = $bdd->prepare("SELECT id as total FROM comment_likes
                                    WHERE comment_id = ? 
                                    AND user_id = ?
                            ");
            
            $req->execute(array($id,user()->id));

            return $req->fetch();
        }
        
        public function get_comment_loves($id){
            global $bdd;

            $req = $bdd->prepare("SELECT COUNT(id) as total FROM comment_likes
                                    WHERE comment_id = ?
                            ");
            
            $req->execute(array($id));
            return $req->fetch()->total;
        }
         

        public function get_comment_reaction($comments){
            if(is_array($comments)){
                foreach ($comments as $comment) {
                    $comment->total_love =$this->get_comment_loves($comment->id);
                    // $comment->total_comment =$this->get_total_comment($comment->id);
                }
            }
            else{
                $comments->total_love =$this->get_comment_loves($comments->id);
                // $comments->total_comment =$this->get_total_comment($comments->id);

            }
            return $comments;
        }


        public function user_love_comment($id){
            global $bdd;
            $req = $bdd->prepare("SELECT id  FROM comment_likes
                                    WHERE comment_id = ? 
                                    AND user_id = ?
                            ");
            
            $req->execute(array($id,user()->id));
            return $req->fetch();
        }
       
    }