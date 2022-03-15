<?php


class Validations{

  function __construct(){
    function email_validation($str) {
      return (!preg_match(
        "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
      ? FALSE : TRUE;
    }
  }


  function dispCorrect(){


    if(!email_validation("adityadone9398@gmail.com")) {
      echo "Invalid email address.";
    }
    else {
      echo "Valid email address.";
    }
  }

  function dispEmail(){


    $email = "aditya.done@netcorecloud2.com";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo("$email is a valid email address");
    } 
    else {
      echo("$email is not a valid email address");
    }

  }


}

$call = new Validations();

//$call->dispCorrect();

//$call->dispEmail();








?>