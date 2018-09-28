<?php
// business/matchingService.php

require_once ('data/matchingDAO.php');

class matchingService {
    
    public function matchMetVdab (
        $id1,
        $id2,
        $status
    )
    {
        $matchDAO = new matchings();
        $match = $matchDAO -> Insert($id1, $id2, $status);
    }
    
    /**
     * Delete all the matchings from the database
     * 
     * @return void
     */
    public function deleteAll()
    {
        $matchDAO = new matchings();
        $matchDAO->deleteAll();
    }

    /**
     * Delete all the matchings of specific user
     *
     * @return void
     */
    public function deleteByUserId($id)
    {
        $matchDAO = new matchings();
        $matchDAO->deleteByUserId($id);
    }
    
    /**
     * Get the match defined by 2 companies
     * 
     * @param object $account1
     * @param object $account2
     * 
     * @return object|null
     */    
    public function getMatch($account1, $account2)
    {
        $matchingDAO = new matchings();
        $match       = $matchingDAO->getMatch($account1, $account2);
        
        return $match;
    }
    
}