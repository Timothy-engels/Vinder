<?php
namespace entities;

/**
 * Class Match
 *
 * Hold the properties of the Match
 */
class Match
{
    private $id;
    private $account1;
    private $account2;
    private $status;
    
    private static $idMap = [];
    
    /**
     * @param int $id
     * @param object $account1 (Account Object)
     * @param object $account2 (Account Object)
     * @param int $status
     */
    public function __construct($id, $account1, $account2, $status)
    {
        $this->id       = $id;
        $this->account1 = $account1;
        $this->account2 = $account2;
        $this->status   = $status;
    }
    
    /**
     * @param int $id
     * @param object $account1 (Account Object)
     * @param object $account2 (Account Object)
     * @param int $status
     * 
     * @return object (Match object)
     */
    public static function create($id, $account1, $account2, $status)
    {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Match($id, $account1, $account2, $status);
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
    public function getAccount1()
    {
        return $this->account1;
    }
    
    /**
     * @param object $account
     * 
     * @return object
     */
    public function setAccount1($account)
    {
        $this->account1 = $account;
        return $this;
    }

    /**
     * @return object
     */
    public function getAccount2()
    {
        return $this->account2;
    }
    
    /**
     * @param object $account
     * 
     * @return object
     */
    public function setAccount2($account)
    {
        $this->account2 = $account;
        return $this;
    }      
    
    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param int $status
     * 
     * @return object
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }        
}
