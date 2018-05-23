<?php

namespace App\Services;

use Src\Domain\Models\Admins;

class AdminsBuilder
{
    /**
     * @var Admins
     */
    private $admins;

    /**
     * @param string $pseudo
     * @param string $email
     * @param string $password
     * @param string $role
     * @param string $token
     */
    public function build(
        string $pseudo,
        string $email,
        string $password,
        string $role,
        string $token
    )
    {
        $this->admins = new Admins($pseudo, $email, $password, $role, $token);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function buildForSession(array $data)
    {
        $this->admins = new Admins($data['pseudo'], $data['email'], '',$data['role'],$token='');

        return $this;
    }

    /**
     * @param $pseudo
     * @param $email
     * @return $this
     */
    public function buildForReset($pseudo,$email)
    {
        $this->admins = new Admins($pseudo,$email,'','','');

        return $this;
    }

    /**
     * @return Admins
     */
    public function getAdmins()
    {
        return $this->admins;
    }
}
