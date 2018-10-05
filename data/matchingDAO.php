<?php
require_once("DBConfig.php");
require_once("entities/account.php");
require_once("entities/match.php");

class MatchingDAO
{
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
        // Create the query
        $sql = "INSERT INTO matching (AccountID1, AccountID2, Status)
                VALUES (:accountID1, :accountID2, :status)";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Prepare and execute
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':accountID1' => $accountID1,
            ':accountID2' => $accountID2,
            ':status'     => $status
        ]);
        
        // Close the db connection
        $dbh = null;

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
        // Create the sql
        $query = "UPDATE `matching`
                  SET
                    AccountID1 = :accountID1,
                    AccountID2 = :accountID2,
                    Status = :status
                  WHERE ID = :matchID";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Prepare & execute the query
        $stmt = $dbh->prepare($query);
        $stmt->execute([
            ':accountID1' => $match->getAccount1()->getID(),
            ':accountID2' => $match->getAccount2()->getID(),
            ':status'     => $match->getStatus(),
            ':matchID'    => $match->getID()
        ]);
                  
        // Close the db connection
        $dbh = null;
    }
    
    /**
     * Delete all matches
     * 
     * @return void
     */
    public function deleteAll()
    {
        // Create the sql
        $query = "DELETE FROM `matching`";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($query);
        $resultSet->execute();
        
        // Close the connection
        $dbh = null;
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
        // Create the sql
        $sql = "SELECT *
                FROM `matching`
                WHERE (AccountID1 = :accountId1 AND AccountID2 = :accountId2)
                   OR (AccountID1 = :accountId3 AND AccountID2 = :accountId4)";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ':accountId1' => $account1->getId(),
            ':accountId2' => $account2->getId(),
            ':accountId3' => $account2->getId(),
            ':accountId4' => $account1->getId(),
        ]);
        
        // Return the result
        $match = null;
        
        if ($resultSet->rowCount() > 0) {
            
            $row = $resultSet->fetch(PDO::FETCH_ASSOC);
            
            if ($row['AccountID1'] === $account1->getId()) {
                $accountA = $account1;
                $accountB = $account2;
            } else {
                $accountA = $account2;
                $accountB = $account1;
            }
            
            $match = entities\Match::create(
                $row['ID'],
                $accountA,
                $accountB,
                $row['Status']
            );
        }
        
        // Close the connection
        $dbh = null;
        
        // Return the result
        return $match;
    }

    /**
     * Delete all matches by user id
     *
     * @return void
     */
    public function deleteByUserId($id)
    {

        $sql = "DELETE FROM `matching` WHERE `matching`.`AccountID1` = :id OR `matching`.`AccountID2` = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id
        ]);
        $dbh = null;
        return $resultSet;
    }
    
    /**
     * Get the amount of matches for a specified account
     * 
     * @param object $account
     * 
     * @return int
     */
    public function getMyMatchesAmount($account)
    {
        // Create the sql
        $query = "SELECT COUNT(ID) AS Amount
                  FROM matching
                  WHERE (`AccountID1` = :accountID1 OR `AccountID2` = :accountID2)
                    AND `Status` = 3";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($query);
        $resultSet->execute([
            ':accountID1' => $account->getId(),
            ':accountID2' => $account->getId()
        ]);
        
        // Return the result
        $amount = 0;
        
        if ($resultSet->rowCount() > 0) {
            $row    = $resultSet->fetch(PDO::FETCH_ASSOC);
            $amount = $row['Amount'];
        }
        
        return $amount;     
    }
}
