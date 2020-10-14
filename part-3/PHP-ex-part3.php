<?php
    function isPalindrome($str){
        $strreverse = strrev($str);
        if ($str === $strreverse){
            echo $str . " is a Palindrome";
        }
        else{
            echo $str . " is not a Palindrome";
        }
    }
?> 