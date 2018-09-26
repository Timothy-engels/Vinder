<?php

namespace entities;

/**
 * Abstract class for the existing expertises/more info
 */
abstract class ExistingExpertise
{
    protected $id;
    protected $account;
    protected $expertise;
    protected $info;
    
    /**
     * @param int $id
     * @param object $account
     * @param object $expertise
     * @param string $info
     */
    public function __construct($id, $account, $expertise, $info)
    {
        $this->id        = $id;
        $this->account   = $account;
        $this->expertise = $expertise;
        $this->info      = $info;
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
     * @return object
     */
    public function getExpertise()
    {
        return $this->expertise;
    }
    
    /**
     * @param object $expertise
     * 
     * @return $this
     */
    public function setExpertise($expertise)
    {
        $this->expertise = $expertise;
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
