<?php

namespace App\Services;

use Src\Domain\Models\Admins;

class AdminsBuilder
{
    private $admins;

    public function build(string $id,
                          string $pseudo,
                          string $email,
                          string $password,
                          string $passwordVerif,
                          string $dateInscription
    )
    {
        $this->admins = new Admins($id, $pseudo, $email, $password, $passwordVerif, $dateInscription);
    }

    public function getAdmins()
    {
        return $this->admins;
    }

}