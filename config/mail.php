<?php
$mail = $_POST['id'];


$num =  rand(11111,99999);
$to = $mail;
$subject = "My subject";
$txt = $num;
$headers = "hammadhabib0317@gmail.com";

mail($to,$subject,$txt,$headers);

echo $num;
// X|h>BK!^sRT$IUj6
?>