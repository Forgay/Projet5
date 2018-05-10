<?php

namespace App\Services;

use Src\Domain\Models\Admins;

class AdminsBuilder
{
    private $admins;

    public function build(string $pseudo,
                          string $email,
                          string $password,
                          string $role

    )
    {
        $this->admins = new Admins($pseudo, $email, $password,$role );
    }

    public function buildForSession(array $data)
    {
        $this->admins = new Admins($data['pseudo'], $data['email'], '',$data['role']);

        return $this;
    }

    public function buildForReset($pseudo,$email)
    {
        $this->admins = new Admins($pseudo,$email,'','');

        return $this;
    }
    public function getAdmins()
    {
        return $this->admins;
    }
}
