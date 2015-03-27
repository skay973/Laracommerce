<?php
    //get the first name
    $fullname = Input::get('fullname');
    $email = Input::get ('email');
    $subject = Input::get ('subject');
    $message = Input::get ('message');
    $date_time = date("F j, Y, g:i a");
    $userIpAddress = Request::getClientIp();
?>

<h1>Un  message à été envoyé via le formulaire de contact de votre site internet.... </h1>

<p>
    Nom Raison sociale : <?php echo ($fullname); ?> <br>
    Adresse email : <?php echo ($email);?> <br>
    Objet du message : <?php echo ($subject); ?><br>
    Message: <?php echo ($message);?><br>
    Date: <?php echo($date_time);?><br>
    Adresse IP : <?php echo($userIpAddress);?><br>
</p>
