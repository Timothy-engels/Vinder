<?php

namespace entities;

/**
 * Abstract class for the extra expertises/more info
 */
abstract class NewExpertise
{
    protected $id;
    protected $account;
    protected $name;
    protected $info;
    
    /**
     * @param int $id
     * @param object $account
     * @param string $name
     * @param string $info
     */
    public function __construct($id, $account, $name, $info)
    {
        $this->id      = $id;
        $this->account = $account;
        $this->name    = $name;
        $this->info    = $info;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return object
     */
    public function getAccount()
    {
        return $this->account;
    }
    
    /**
     * @param object $account
     * 
     * @return $this
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * 
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * 
     * @return $this
     */
    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }

}
