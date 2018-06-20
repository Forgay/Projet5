<?php

namespace App\Services;

use Src\Domain\Managers\AdminsManager;
use Src\Domain\Models\Contact;
use Swift_Mailer;
use Swift_Message;
use Src\Domain\Models\Admins;

class ResetContactService
{
    /**
     * @var Admins
     */
    private $admins;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var AdminsManager
     */
    private $adminsManager;

    /**
     * @var array
     */
    private $config = [];

    public function __construct(Admins $admins)
    {
        $this->adminsManager = new AdminsManager();
        $this->admins = $admins;
        $this->loadConfig();
    }

    public function loadConfig()
    {
        $this->config = require __DIR__ . './../../Config/mailer.php';
    }

    public function sendMail()

    {

        $transport = (new \Swift_SmtpTransport($this->config['host'], $this->config['port']))
            ->setUsername($this->config['username'])
            ->setPassword($this->config['password']);
        //
        $this->mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Reinitialisation mot de passe'))
            ->setFrom('gthareau1@gmail.com')
            ->setTo($this->admins->getEmail())
            ->setBody(
                TwigService::getTwig()->render('ResetPassMail.html.twig', [
                    'pseudo' => $this->admins->getPseudo(),
                    'token' => $this->adminsManager->getToken($this->admins)
                ])
            );
        return $this->mailer->send($message);
    }
}