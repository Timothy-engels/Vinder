<?php

namespace entities;

require_once("entities/existingExpertise.php");

/**
 * Hold the information of an account more info
 */
class AccountMoreInfo extends ExistingExpertise
{
    private static $idMap = [];
    
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
           self::$idMap[$id] = new AccountMoreInfo (
               $id,
               $account,
               $expertise,
               $info               
           );
        }
        
        return self::$idMap[$id];
    }
}
