<?php
//entities/account.php

namespace entities;

/* 
 * Class Account
 * 
 * Hold the properties of the account
 */
class Account
{
    private static $idMap = array();
    
    private $id;
    private $name;
    private $contactPerson;
    private $email;
    private $password;
    private $confirmed;
    private $website;
    private $logo;
    private $info;
    private $administrator;

    /**
     * @param int $id
     * @param string $name
     * @param string $contactPerson
     * @param string $email
     * @param string $password
     * @param int $confirmed
     * @param string|null $website
     * @param string|null $logo
     * @param string|null $info
     * @param int $administrator
     */
    public function __construct(
        $id,
        $name,
        $contactPerson,
        $email,
        $password,
        $confirmed = 0,
        $website = null,
        $logo = null,
        $info = null,
        $administrator = 0
    ) {
        $this->id            = $id;
        $this->name          = $name;
        $this->contactPerson = $contactPerson;
        $this->email         = $email;
        $this->password      = $password;
        $this->confirmed     = $confirmed;
        $this->website       = $website;
        $this->logo          = $logo;
        $this->info          = $info;
        $this->administrator = $administrator;
    }
    
    /**
     * @param int $id
     * @param string $name
     * @param string $contactPerson
     * @param string $email
     * @param string $password
     * @param int $confirmed
     * @param string|null $website
     * @param string|null $logo
     * @param string|null $info
     * @param int $administrator
     * 
     * @return object
     */
    public static function create(
        $id,
        $name,
        $contactPerson,
        $email,
        $password,
        $confirmed = 0,
        $website = null,
        $logo = null,
        $info = null,
        $administrator = 0
    ) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Account(
                $id,
                $name,
                $contactPerson,
                $email,
                $password,
                $confirmed,
                $website,
                $logo,
                $info,
                $administrator
            );
        }
        
        return self::$idMap[$id];
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string;
     */
    public function getName()
    {
        return $this->string;
    }
    
    /**
     * @param string $name
     * 
     * @return object
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }
    
    /**
     * @param string $contactPerson
     * 
     * @return object
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     * 
     * @return object
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * @return int
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }
    
    /**
     * @param int $confirmed
     * 
     * @return $this
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string|null $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }
    
    /**
     * @param int $administrator
     * 
     * @return $this
     */
    public function setAdministrator($administrator)
    {
        $this->administrator = $administrator;
        return $this;
    }
    
}
