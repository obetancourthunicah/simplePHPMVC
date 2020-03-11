<?php

  function isEmpty($value){
      return preg_match('/^\s*$/', $value) ;
  }

  function isValidEmail($value){
      return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  function isValidPassword($value){
      return preg_match(
          '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*])([a-zA-Z0-9@#$%^&+=*.\-_]){8,}$/',
          $value
      );
  }

  function isValidText($value){
      return preg_match("/^[a-zA-Z 'áéíóúüÁÉÍÓÚÜÑñ0-9\-&:]*$/",$value);
  }
?>
