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
    
    /**
     * Get the swipe result from both companies according to the status
     * 
     * @param int $status
     * 
     * @return array
     */
    public function getSwipeResultsFromStatus($status)
    {
        // Get the swipe results according to the status
        switch ($status) {
            case -5:
                $result1 = "no";
                $result2 = "no";
                break;
            case -4:
                $result1 = "no";
                $result2 = null;
                break;                
            case -3:
                $result1 = "no";
                $result2 = "yes";
                break;                
            case -2:
                $result1 = null;
                $result2 = "no";
                break;                
            case -1:
                $result1 = "yes";
                $result2 = "no";
                break;                
            case 0:
                $result1 = null;
                $result2 = null;
                break;                
            case 1:
                $result1 = "yes";
                $result2 = null;
                break;                
            case 2:
                $result1 = null;
                $result2 = "yes";
                break;                
            case 3:
                $result1 = "yes";
                $result2 = "yes";
                break;                
            default:
                $result1 = null;
                $result2 = null;              
        }
        
        // Return the swipe resuls
        return [
            'swipeAccount1' => $result1,
            'swipeAccount2' => $result2
        ];  
    }
    
}