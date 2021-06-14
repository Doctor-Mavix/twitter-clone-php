<?php 

    class SearchController extends Controller {
        private $User;
        private $Tweet;

        public function __construct()
        {   
         $this->User  = $this->model("User") ;
         $this->Tweet  = $this->model("Tweet") ;
        }

        public function search_all($expression){
            $query_exp = "%$expression%";
            $results = $this->query($query_exp);
            if(empty($results)){
                $keywords = explode(" ",$expression);
                $temp_result =[];
                foreach($keywords as $keyword){
                    $result = $this->query("%".$keyword ."%");
                    !empty($result) ?array_push($temp_result,$result):"";

                }
                if(!empty($temp_result)){
                    foreach($temp_result as $result){
                        $results=array_merge($results,$result) ;
    
                    }
                    // dd($results);
                }
            }
            return $this->view("tweet/search",$results); 
        }

        public function query($expression){
            global $bdd ;

            $req= $bdd->prepare("SELECT body,media,username,fullname ,tweets.id ,user_id ,profil_picture ,tweets.created_at
            FROM tweets 
            INNER JOIN users ON tweets.user_id = users.id 
            WHERE body LIKE ? 
            OR username LIKE ?
            OR fullname LIKE ?
            ORDER BY tweets.created_at DESC
        ");
        $req->execute([$expression,$expression,$expression]);

        $tweets= $req->fetchAll();
        return $this->Tweet->getReaction($tweets);
          

        }

    }