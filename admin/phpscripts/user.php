<?php

function createUser($fname, $username, $password, $email, $lvllist){
include('connect.php');

$random = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+;:,.?";
$password = substr(str_shuffle($random),0,8);
if($password){
  $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
  $password = $encrypt_pass;
}


$userstring = "INSERT INTO tbl_user (user_id, user_fname, user_name, user_pass, user_email, user_date, user_level, user_ip) VALUES (NULL, '{$fname}', '{$username}', '{$password}', '{$email}', NULL, '{$lvllist}', 'no')";
$userquery = mysqli_query($link, $userstring);

//echo $userstring;

if($userquery){
  redirect_to('admin_index.php');
  $to = $email;
  $subj = "Your account information - Please log in";
  $msg = "Your Username: ".$username."\n\nYour Password: ".$password."\n\nLog In Here: ".$url;
  mail($to,$subj,$msg);
  //echo $msg;

}else{
  $message = "Try again!";
  return $message;
}
mysqli_close($link);
}
?>
