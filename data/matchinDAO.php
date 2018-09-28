<?php
// data/matchingDAO.php

require_once("DBConfig.php");
require_once("entities/account.php");


class matchings {
    
    public function Insert(
        $AccountID1,
        $AccountID2,
        $status
        ) 
    {
        $sql = "INSERT INTO matching
                (AccountID1, AccountID2, status)
                VALUES
                (:AccountID1, :AccountID2, :status)
                ";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':AccountID1'       => $AccountID1,
            ':AccountID2'       => $AccountID2,
            ':status'           => $status
        ]);
        
        // Close the db connection
        $dbh = null;

    }
}
