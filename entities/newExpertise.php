<?php

namespace entities;

/**
 * Abstract class for the extra expertises/more info
 */
abstract class NewExpertise
{
    protected $id;
    protected $account;
    protected $expertiseName;
    protected $info;
    
    /**
     * @param int $id
     * @param object $account
     * @param string $expertiseName
     * @param string $info
     */
    public function __construct($id, $account, $expertiseName, $info)
    {
        $this->id            = $id;
        $this->account       = $account;
        $this->expertiseName = $expertiseName;
        $this->info          = $info;
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
    public function getExpertiseName()
    {
        return $this->expertiseName;
    }
    
    /**
     * @param string $expertiseName
     * 
     * @return $this
     */
    public function setExpertiseName($expertiseName)
    {
        $this->expertiseName = $expertiseName;
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
