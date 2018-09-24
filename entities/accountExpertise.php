<?php

namespace entities;

/**
 * Hold the information of an account expertise
 */
class AccountExpertise
{
    private $id;
    private $account;
    private $expertise;
    private $info;
    
    private static $idMap = [];
    
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
     * @param int $id
     * @param object $account
     * @param object $expertise
     * @param string $info
     * 
     * @return object
     */
    public static function create($id, $account, $expertise, $info)
    {
        if (!isset($idMap[$id])) {
           self::$idMap[$id] = new AccountExpertise (
               $id,
               $account,
               $expertise,
               $info               
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
