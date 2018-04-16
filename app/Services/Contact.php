<?php


namespace App\Services;
require('/../vendor/swiftmailer /swiftmailer/lib/swift_required.php');

class Contact
{


    function addContact($firstname, $lastname, $email, $message)
    {

        $firstname = htmlspecialchars($firstname);
        $lastname = htmlspecialchars($lastname);
        $email = htmlspecialchars($email);
        $message = htmlspecialchars($message);

        $_SESSION['errors'] = [];
        if (empty($nom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message))
            if (empty($nom)) {
                $_SESSION['errors'] = ['nom' => "Votre nom n'est pas rempli"];
            } elseif (empty($email)) {
                $_SESSION['errors'] = ['email' => "Votre email n'est pas rempli"];
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors'] = ['emailInvalid' => "Votre email est invalide"];
            } else {

                $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 25);

                $mailer = Swift_Mailer::newInstance($transport);

                $demande = Swift_Message::newInstance('Contact')
                    ->setFrom(array($email))
                    ->setTo(array('gthareau1@gmail.com'))
                    ->setBody('<h4> Demande de ' . $nom . '</h4>
                        <p>' . nl2br($message) . '</p>', 'text/html');

                $result = $mailer->send($demande);

            }
    }


}