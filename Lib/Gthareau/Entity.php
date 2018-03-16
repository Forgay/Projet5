<?php


namespace Gthareau;


abstract class Entity implements \ArrayAccess
{
    protected $errors = [],$id;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function getIsNew()
    {
        return empty($this->id);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function offsetGet($var)
    {
        if(isset($this->$var) && is_callable([$this,$var]))
        {
            return $this->$var();
        }
    }

    public function offsetSet($var, $value)
    {
        $method ='set'.ucfirst($var);

        if(isset($this->$var) && is_callable([$this,$method]))
        {
            $this->$method($value);
        }
    }

    public function offsetExists($var)
    {
       return isset($this->$var) && is_callable([$this,$var]);
    }

    public function offsetUnset($var)
    {
     throw new Exception('impossible de supprimer une quelconque valeur');
    }
}