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
     * @return array
     */
    public function validator(array $data, array $contraints): array
    {
        if(empty($data)) {return $violations =[];}

        foreach ($data as $key =>$value){
            foreach($contraints as $key =>$const){
                switch ($const){
                    case 'is_string':
                        $this->violations['string'] = is_string($value) == true ? '' : 'cette chaîne de caratère n\'est pas valide !';
                        break;
                    case 'email':
                        $this->violations['email'] = filter_var($value, FILTER_VALIDATE_EMAIL ) ? : 'cet emal n\'est pas valide';
                        break;
                    case 'empty':
                        $this->violations['empty'] = empty($value) == true ? '' : 'un champ n\'est pas rempli';
                }
            }
        }
        return $this->violations;
    }
}
