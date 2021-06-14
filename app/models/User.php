<?php 

class User {
    public function register($data){
        global $bdd;

        $req =$bdd->prepare('INSERT INTO users(username,email,fullname,password,birthday) VALUES(?,?,?,?,?)');
                                        
        $req->execute(array($data["username"],$data["email"],$data["fullname"],$data["password"],$data["birthday"]));
        
        $req=$bdd->prepare('SELECT id FROM users WHERE email =?');
        $req->execute(array($data["email"]));
        $user_id =$req->fetch();
        return $user_id;
    }

    public function update($data){
        global $bdd; 
        $req = $bdd->prepare("UPDATE users SET 
                                fullname = ? ,
                                bio = ? , 
                                location = ?, 
                                website = ?, 
                                profil_picture = ? ,
                                barners=? 
                                WHERE id = ? 
                            ");
        return $req->execute(array($data["fullname"],$data["bio"],$data["location"],$data["website"],$data["profil_picture"],$data["barners"] ,user()->id));
    }
    public function get($id){

        global $bdd;
        $req=$bdd->prepare('SELECT * FROM users  
                                WHERE id =?  OR username = ?');
        $req->execute(array($id,$id));
        
        $user =$req->fetch();
        $user->total_follower = count($this->list_followers($user->id)); //ceux qui me suivent
        $user->total_following = count($this->list_following($user->id));//ceux que je suis


        return $user;
    }

  
    public function find_email_or_username($email){
        global $bdd;
        $req=$bdd->prepare('SELECT * FROM users WHERE email =? || username =?');
        $req->execute(array($email,$email));
        return $req->fetch();
    }


    public function list_users(){
        global $bdd;
        $req=$bdd->prepare('SELECT * FROM users WHERE id <> ?');
        $req->execute([user()->id]);
        return $req->fetchAll();
    }



    public function follow($id){
        global $bdd;
        
        $req = $bdd->prepare("INSERT INTO follows(follower_id,following_id)
                                VALUES( ?,?)
                        ");
        
        return $req->execute(array($id,user()->id));
    }
    public function unfollow($id){
        global $bdd;
        
        $req = $bdd->prepare("DELETE FROM follows
                                WHERE follower_id = ?
                                AND following_id = ?
                                LIMIT 1
                        ");
        
       return $req->execute(array($id,user()->id));
    }


    public function is_follow($id){
        global $bdd;

        $req = $bdd->prepare("SELECT id  FROM  follows
                                WHERE follower_id = ? 
                                AND following_id = ?
                        ");
        
        $req->execute(array($id,user()->id));

        return $req->fetch();
    }

    public function list_followers($id=""){
        global $bdd;

        $req = $bdd->prepare("SELECT *  FROM  follows f
                                INNER JOIN users u 
                                ON u.id = f.following_id
                                WHERE f.follower_id = ?
                        ");
        !empty($id) ? $req->execute(array($id)) :$req->execute(array(user()->id));
        

        return $req->fetchAll();
    }
    public function list_unfollowers($id=""){
        global $bdd;

        $req = $bdd->prepare("SELECT *  FROM  follows f
                                INNER JOIN users u 
                                ON u.id = f.following_id
                                WHERE f.following_id <> ?
                        ");
        
        !empty($id) ? $req->execute(array($id)) :$req->execute(array(user()->id));

        return $req->fetchAll();
    }
    public function list_who_to_follow(){
        global $bdd;
        $users =$this->list_users();
        $followers =$this->list_following();
        $followers_id=[];
        $results=[];
        foreach ($followers as $follower ) {
            array_push($followers_id,$follower->follower_id);
        }

        foreach ($users as $user ) {
            if(!in_array($user->id,$followers_id)){
                array_push($results,$user);
            }
            if(sizeof($results)>2){
                break;
            }
        }
       return $results;

        

        dd(user()->id);
        // $req->execute(array(user()->id,user()->id));

        // return $req->fetchAll();
    }
    public function list_following($id=""){
        global $bdd;

        $req = $bdd->prepare("SELECT *  FROM  follows f
                                INNER JOIN users u 
                                ON u.id = f.following_id
                                WHERE f.following_id = ?
                                AND follower_id <> ?

                        ");
        
        !empty($id) ? $req->execute(array($id,$id)) :$req->execute(array(user()->id,user()->id));
        return $req->fetchAll();
    }



}