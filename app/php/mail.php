<?php

  $success = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = Trim(stripslashes($_POST['name'])); 
    $Email = Trim(stripslashes($_POST['email'])); 
    $Subject = Trim(stripslashes($_POST['subject'])); 
    $Message = Trim(stripslashes($_POST['message'])); 

    $EmailFrom = $Email;
    $EmailTo = "sarah@stickyricetravel.com";

    $Body = "Name: $Name\n";
    $Body .= "Email: $Email\n\n";
    $Body .= "Message:\n$Message\n";

    if($Email != "") {
      $success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");
    }

    if ($success == 1) {echo "sent";} else {echo "mail_not_sent";}

  } else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
  }
?>