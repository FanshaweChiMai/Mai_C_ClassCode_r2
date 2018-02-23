<?php

function createUser($fname, $username, $password, $email, $lvllist){
include('connect.php');

//Make the system generate the password randomly
$random = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+;:,.?";
$password = substr(str_shuffle($random),0,8);
//then encrypt it ( OMG I can't believe I actually figured the if out to actually make it work on the randomly generated password!)
if($password){
  $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
  $password = $encrypt_pass;
}


$userstring = "INSERT INTO tbl_user VALUES (NULL, '{$fname}', '{$username}', '{$password}', '{$email}', NULL, '{$lvllist}', 'no')";
$userquery = mysqli_query($link, $userstring);

//echo $userstring;

if($userquery){
  redirect_to('admin_index.php');
  //need to figure out the log in URL
  $to = $email;
  $subj = "Your account information - Please log in";
  $msg = "Your Username: ".$username."\n\nYour Password: ".$password."\n\nLog In Here: ".$login_link;
  mail($to,$subj,$msg);
  //echo $msg;

}else{
  $message = "Try again!";
  return $message;
}
mysqli_close($link);
}
?>
