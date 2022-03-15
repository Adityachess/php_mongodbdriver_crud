<?php

echo "Enter mobile number <br> ";

$input = trim(fgets(STDIN, 1024));

echo "\n" ,$input , "\n";


function valid_phone($input)
{
    return preg_match("/^([+]{1}[1-9]{2,3}\\s{0,1}[1-9]{1}[0-9]{9})$/", $input);
}

if(valid_phone($input)){
    echo "\n", "Your phone number is valid." , "\n";
}else{
    echo "\n", "Sorry, Your phone number is invalid." , "\n";
}


























/**

function validateMobileNumber($mobile) {
  if (!empty($mobile)) {
    $isMobileNmberValid = TRUE;
    $mobileDigitsLength = strlen($mobile);
    if ($mobileDigitsLength < 10 || $mobileDigitsLength > 15) {
      $isMobileNmberValid = FALSE;
    } else {
      if (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $mobile)) {
        $isMobileNmberValid = FALSE;
      }
    }
    return $isMobileNmberValid;
  } else {
    return false;
  }
}





function valid_email($str) {
return (!preg_match("/^([+]{1}[1-9]{1,3}\\s{0,1}[1-9]{1}[0-9]{9})$/", $str)) ? FALSE : TRUE;
}

if(!valid_email("+126 7758057848")){
echo "Invalid email address.";
}else{
echo "Valid email address.";
}


*/




?>
