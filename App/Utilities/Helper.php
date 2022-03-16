<?php
//takes a path
//checks if the user is logged in
//if its not
namespace App\Utilities;

class Helper
{

    static function redirect($redirectionLocation)
    {
        header("Location:$redirectionLocation");
    }
    static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefABCDEF';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

//TODO: on top of each page needing the redirect
