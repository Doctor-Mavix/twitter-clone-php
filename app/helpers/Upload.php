<?php 
    class Upload {
        


        // create picture and copie it in $location_photo emplacement
        public static function image($fichier,$image,$location_photo){
           
            $name_image=explode('.', $image);
            $extension_image= end($name_image);
            $name_image=uniqid().uniqid().'.'.$extension_image;
            $location_photo =$location_photo.$name_image;
            move_uploaded_file($fichier, $location_photo);
            // echo ($name_image);
            return $name_image;
        }
        public static function file($fichier,$image,$location_photo){
           
            $name_image=explode('.', $image);
            $extension_image= end($name_image);
            $name_image=uniqid().uniqid().'.'.$extension_image;
            $location_photo =$location_photo.$name_image;
            move_uploaded_file($fichier, $location_photo);
            // echo ($name_image);
            return $name_image;
        }
    }