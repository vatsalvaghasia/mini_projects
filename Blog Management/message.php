<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$email_from = "BlogManagement.com";

$email_subject = "Got Contacted by Someone!!";

$email_body = "User Name: $name.\n"."User Email: $email.\n"."User Message: $message.\n";

$to = "vaghasia84@gmail.com";

$headers = "FROM: $email_from \r\n";
$headers .= "Reply-to: $email \r\n";
mail($to,$email_subject,$email_body,$headers);


 ?>