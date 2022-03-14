<?php
//takes a path
//checks if the user is logged in
//if its not
namespace App\Utilities;
class Helper{

    static function redirect($redirectionLocation){
        header("Location:$redirectionLocation");
    }
}

//TODO: on top of each page needing the redirect

