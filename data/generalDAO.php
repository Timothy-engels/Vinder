<?php

require_once("DBConfig.php");
require_once("entities/general.php");

class GeneralDAO
{
    /**
     * Get the general settings
     * 
     * @return object|null
     */
    public function get()
    {
        // Generate the query
        $sql = "SELECT RegisterDate, SwipeDate, Mail
                FROM `general`
                LIMIT 1";
        
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        
        $resultSet->execute();
        
        // Get the result
        $general = null;
        
        if ($resultSet->rowCount() > 0) {
            
            $row = $resultSet->fetch(PDO::FETCH_ASSOC);
            
            $general = entities\General::create(
                $row['RegisterDate'],
                $row['SwipeDate'],
                $row['Mail']
            );
            
        }
        
        // Close the connection
        $dbh = null;
        
        // Return the result
        return $general;
    }
    
    /**
     * Insert default general options
     *  
     * @param object $generalObject
     * 
     * @return void
     */
    public function insert($generalObject)
    {        
        // Generate the query
        $sql = "INSERT INTO `general` (RegisterDate, SwipeDate, Mail)
                VALUES (:registerDate, :swipeDate, :mail)";
        
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        
        $resultSet->execute([
            ':registerDate' => $generalObject->getRegisterDate(),
            ':swipeDate'    => $generalObject->getSwipeDate(),
            ':mail'         => $generalObject->getMail()
        ]);   
        
        $dbh = null;
    }
    
    /**
     * Update the existing dates
     * 
     * @param object $generalObject
     * 
     * @return void
     */
    public function updateDates($generalObject)
    {        
        // Generate the query
        $sql = "UPDATE `general`
                SET RegisterDate = :registerDate,
                    SwipeDate    = :swipeDate";
        
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        
        $resultSet->execute([
            ':registerDate' => $generalObject->getRegisterDate(),
            ':swipeDate'    => $generalObject->getSwipeDate()
        ]);   
        
        $dbh = null;
    }
    
    /**
     * Update the existing mail
     * 
     * @param object $generalObject
     * 
     * @return void
     */
    public function updateMail($generalObject)
    {        
        // Generate the query
        $sql = "UPDATE `general`
               SET Mail = :mail";
        
        $dbh       = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        
        $resultSet->execute([
            ':mail' => $generalObject->getMail()
        ]);

        $dbh = null;
    }
}