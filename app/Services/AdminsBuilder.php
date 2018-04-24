<?php

namespace App\Services;

use Src\Domain\Models\Admins;

class AdminsBuilder
{
    private $admins;

    public function build(string $pseudo,
                          string $email,
                          string $password
    )
    {
        $this->admins = new Admins($pseudo, $email, $password);
    }

    public function getAdmins()
    {
        return $this->admins;
    }
}
