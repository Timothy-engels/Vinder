<?php
// business/matchingService.php

require_once ('data/matchingDAO.php');

class matchingService {
    
    /**
     * Insert a new match
     * 
     * @param int $accountID1
     * @param int $accountID2
     * @param int $status
     * 
     * @return void
     */
    public function insert($accountID1, $accountID2, $status)
    {
        $matchDAO = new matchings();
        $matchDAO->Insert($accountID1, $accountID2, $status);
    }
    
    /**
     * Update an existing match
     * 
     * @param object $match
     * 
     * @return void
     */
    public function update($match)
    {
        $matchDAO = new matchings();
        $matchDAO->update($match);
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
    
    /**
     * Get the status from the match according to the swipe results
     * 
     * @param string|null $result1
     * @param string|null $result2
     * 
     * @return int
     */
    public function getStatusFromSwipingResults($result1, $result2)
    {
        $status = null;
        
        switch ($result1) {
            case "yes":
                switch($result2) {
                    case "yes":
                        $status = 3;
                        break;
                    case "no":
                        $status = -1;
                        break;
                    default:
                        $status = 1;
                        break;
                }
                break;
            
            case "no":
                switch($result2) {
                    case "yes":
                        $status = -3;
                        break;
                    case "no":
                        $status = -5;
                        break;
                    default:
                        $status = -4;
                        break;
                }                
                break;
            
            default:
                switch($result2) {
                    case "yes":
                        $status = 2;
                        break;
                    case "no":
                        $status = -2;
                        break;
                    default:
                        $status = 0;
                        break;
                }                
                break;   
        }
        
        return $status;
    }
    
}