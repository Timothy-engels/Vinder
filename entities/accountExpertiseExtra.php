<?php

namespace entities;

require_once("entities/newExpertise.php");

/**
 * Hold the information of an account expertise
 */
class AccountExpertiseExtra extends NewExpertise
{
    private static $idMap = [];
    
    /**
     * @param int $id
     * @param object $account
     * @param string $expertiseName
     * @param string $info
     * 
     * @return object
     */
    public static function create($id, $account, $expertiseName, $info)
    {
        if (!isset($idMap[$id])) {
           self::$idMap[$id] = new AccountExpertiseExtra (
               $id,
               $account,
               $expertiseName,
               $info               
           );
        }
        
        return self::$idMap[$id];
    }
    
}