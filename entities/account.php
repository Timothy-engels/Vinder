<?php

namespace entities;

/* 
 * Class Account
 * 
 * Hold the properties of the account
 */
class Account
{
    protected $id;
    protected $name;
    protected $contactPerson;
    protected $email;
    protected $password;
    protected $confirmed;
    protected $administrator;
    
    /**
     * @param string $name
     * @param string $contactPerson
     * @param string $email
     * @param string $password
     * @param int $confirmed
     * @param int $administrator
     */
    protected function __construct(
        $name,
        $contactPerson,
        $email,
        $password,
        $confirmed = 0,
        $administrator = 0
    ) {
        $this->name          = $name;
        $this->contactPerson = $contactPerson;
        $this->email         = $email;
        $this->password      = $password;
        $this->confirmed     = $confirmed;
        $this->administrator = $administrator;
    }
    
    /**
     * @return int
     */
    protected function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string;
     */
    protected function getName()
    {
        return $this->string;
    }
    
    /**
     * @param string $name
     * 
     * @return object
     */
    protected function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    protected function getContactPerson()
    {
        return $this->contactPerson;
    }
    
    /**
     * @param string $contactPerson
     * 
     * @return object
     */
    protected function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }
    
    /**
     * @return string
     */
    protected function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     * 
     * @return object
     */
    protected function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * @return string
     */
    protected function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     */
    protected function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * @return int
     */
    protected function getConfirmed()
    {
        return $this->confirmed;
    }
    
    /**
     * @param int $confirmed
     * 
     * @return $this
     */
    protected function setConfirmed($confirmed) 
    {
        $this->confirmed = $confirmed;
        return $this;
    }
    
    /**
     * @return int
     */
    protected function getAdministrator()
    {
        return $this->administrator;
    }
    
    /**
     * @param $administrator
     * 
     * @return $this
     */
    protected function setAdministrator($administrator)
    {
        $this->administrator = $administrator;
        return $this;
    }
    
}
