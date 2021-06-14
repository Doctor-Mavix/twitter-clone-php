<?php 

    Class Validation {

        public static function validate($req,$validation){
            $results =[];
            foreach ($validation as $field => $rules) {
                // echo $field;
                $rule =explode("|",$rules);

                foreach ($rule as $value) {
                    if(strpos($value,":")){
                        $value = explode(":",$value);
                        $method =$value[0];
                        $result =Validation::$method($field,$req[$field],$value[1]);
                        if($result){
                            $results[$field]=$result;
                            break;
                        }

                    }
                    else{
                        $result=Validation::$value($field,$req[$field]);
                        if($result){
                            $results[$field]=$result;
                            break;
                        }

                    }
                }
            }

            return $results;
        }


        public static function required($field,$value){
            if(empty($value)){
                return "The $field field is required";
            }
            
        }

        public static function string($field,$value){
            if(!is_string($value)){
                return "The $field field must be a string";
            }
            
        }
        public static function email($field,$value){
            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                return "This email is not valide";
            }
        }
        public static function alpha_numeric($field,$value){
            if(!preg_match('/^[0-9a-z_A-Z ]+$/',$value )){
                return "The $field field must contains letter and number";
            }
        }

        public static function min($field,$value,$min){
            if(strlen($value) < $min){
                return "The $field field must be at least $min ";
            }
            
        }
        public static function max($field,$value,$max){
            if(strlen($value) > $max){
                return "This $field field  may not be greater than $max ";
            }
            
        }
        
        
    }