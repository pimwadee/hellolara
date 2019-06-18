<?php
namespace App;

class PasswordValidator
{
    public function check($password, $isAdmin=false){
        
        // Invalud 1 thru 8
        if ($password == '12345678') {
            return false;
        }

        if ($isAdmin==true) {
            return strlen($password) >= 10;
        }

        // password should be > 8 characters and at least 1 digit
        return strlen($password) >= 8 && (preg_match_all('/[0-9]/', $password) > 0) 
        // at least 1 uppercase and at least 1 lowercase
        && (preg_match_all('/[A-Z]/', $password) > 0) && (preg_match_all('/[a-z]/', $password) > 0);
        
        
    }

}