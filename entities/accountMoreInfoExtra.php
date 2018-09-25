<?php

namespace entities;

require_once("entities/newExpertise.php");

/**
 * Hold the information of an account expertise
 */
class AccountMoreInfoExtra extends NewExpertise
{
    private static $idMap = [];
    
    /**
     * @param int $id
     * @param object $account
     * @param string $name
     * @param string $info
     * 
     * @return object
     */
    public static function create($id, $account, $name, $info)
    {
        if (!isset($idMap[$id])) {
           self::$idMap[$id] = new AccountMoreInfoExtra (
               $id,
               $account,
               $name,
               $info               
           );
        }
        
        return self::$idMap[$id];
    }
    
}