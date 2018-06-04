<?php

namespace App\Services;

final class ValidatorService
{
    /**
     * @var array
     */
    private $violations = [];

    /**
     * @param array $data
     * @param array $contraints
     *
     * @return array
     */
    public function validate(array $data, array $constraints): array
    {

        foreach ($data as $key => $value) {
            foreach ($constraints as $keys => $const) {
                switch ($const) {
                    case 'is_string':
                         is_string($value) == true ?: $this->violations[$key]['string'] = 'Cette chaîne de caractère n\'est pas valide !';
                        break;
                    case 'empty':
                       empty($value) == false ?:   $this->violations[$key]['empty'] =  'le champ est vide !';
                        break;
                    case 'email':
                        !filter_var($value, FILTER_VALIDATE_EMAIL) ?: $this->violations[$key]['email'] =  'Cet email n\'est pas valide';
                    default:

                }
            }
        }

        return $this->violations;
    }
}
