<?php 
    class Database {
        private $host =DB_HOST;
        private $db_name =DB_NAME;
        private $user= DB_USER;
        private $password= DB_PASS;
        
        private $db;
        public function __construct()
        {
            $this->db=new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->user,$this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        }
        
        public function get_db(){
            if($this->db instanceof PDO){
                return $this->db;
            }
        }
    }