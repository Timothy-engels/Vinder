<?php
//data/expertiseDAO.php

require_once("DBConfig.php");
require_once("entities/expertise.php");

class ExpertiseDAO
{
    public function getAll()
    {
        $sql = "select id, expertise, actief as active from expertises";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $list = array();
        foreach ($resultSet as $row) {
            $exp = Expertise::create($row["id"],$row["expertise"], $row["active"], null);
            array_push($list, $exp);
        }
        $dbh = null;
        return $list;
    }
    
    /**
     * Get an expertise by the ID
     * 
     * @param int $expertiseId
     * 
     * @return object
     */
    public function getById($expertiseId)
    {
        // Generate the query
        $sql = "SELECT ID, Expertise, Actief
                FROM expertises
                WHERE ID = :id";
        
        // Create the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $expertiseId]);
        
        // Get the expertise information
        $expertise = null;
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $expertise = Expertise::create(
                $row['ID'],
                $row['Expertise'],
                $row['Actief']
            );
        }
        
        // Return the expertise information
        $dbh = null;

        return $expertise;
    }
    
    public function getByUserId($id)
    {
        $sql = "select expertises.id as id, expertises.Expertise as expertise, accountexpertises.Info as info from expertises, accountexpertises where accountexpertises.ExpertiseID = expertises.id and expertises.Actief = 1 and accountexpertises.AccountID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([":id"=>$id]);
        $list = array();
        foreach ($resultSet as $row) {
            $exp = Expertise::create($row["id"],$row["expertise"], 1, $row["info"]);
            array_push($list, $exp);
        }
        $dbh = null;
        return $list;
    }

    public function getExpectedByUserId($id)
    {
        $sql = "select expertises.id as id, expertises.Expertise as expertise, accountmeerinfo.Info as info from expertises, accountmeerinfo where accountmeerinfo.ExpertiseID = expertises.id and expertises.Actief = 1 and accountmeerinfo.AccountID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([":id"=>$id]);
        $list = array();
        foreach ($resultSet as $row) {
            $exp = ExpectedExpertise::create($row["id"],$row["expertise"], 1, $row["info"]);
            array_push($list, $exp);
        }
        $dbh = null;
        return $list;
    }

    public function addByUserId($id,$expertiseId,$text)
    {
        $sql = "INSERT INTO `accountexpertises` (`ID`, `AccountID`, `ExpertiseID`, `Info`) VALUES (NULL, :id, :expertiseId, :text)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id,
            ":expertiseId"=>$expertiseId,
            ":text"=>$text
            ]);
        $dbh = null;
        return $resultSet;
    }

    public function addExpectedByUserId($id,$expertiseId,$text)
    {
        $sql = "INSERT INTO `accountmeerinfo` (`ID`, `AccountID`, `ExpertiseID`, `Info`) VALUES (NULL, :id, :expertiseId, :text)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id,
            ":expertiseId"=>$expertiseId,
            ":text"=>$text
        ]);
        $dbh = null;
        return $resultSet;
    }

    public function deleteAllByUserId($id)
    {
        $sql = "DELETE FROM `accountexpertises` WHERE `accountexpertises`.`AccountID` = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id
        ]);
        $dbh = null;
        return $resultSet;
    }

    public function deleteAllExpectedByUserId($id)
    {
        $sql = "DELETE FROM `accountmeerinfo` WHERE `accountmeerinfo`.`AccountID` = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id
        ]);
        $dbh = null;
        return $resultSet;
    }



    public function getExtraExpertise($id)
    {
        $sql = "SELECT accountexpertisesextra.ID as id, ExpertiseNaam as expertise, info FROM accountexpertisesextra where AccountID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([":id"=>$id]);
        $exp = [];
        foreach ($resultSet as $row) {
            $exp = ExtraExpertise::create($row["id"],$row["expertise"], 1,$row["info"]);
        }
        $dbh = null;
        return $exp;
    }

    public function addExtraExpertise($id,$name,$text){
        $sql2 = "DELETE FROM `accountmeerinfoextra` WHERE `accountmeerinfoextra`.`AccountID` = :id";
        $sql = "INSERT INTO `accountexpertisesextra` (`ID`, `AccountID`, `ExpertiseNaam`, `Info`) VALUES (NULL, :id, :name, :text);";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $delete = $dbh->prepare($sql2);
        $delete->execute([
            ":id"=>$id]);

        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id,
            ":name"=>$name,
           ":text"=>$text]);

        $dbh = null;
        return $resultSet;
    }

    public function addExtraExpectedExpertise($id,$name,$text){
        $sql2 = "DELETE FROM `accountmeerinfoextra` WHERE `accountmeerinfoextra`.`AccountID` = :id";
        $sql = "INSERT INTO `accountmeerinfoextra` (`ID`, `AccountID`, `MeerinfoNaam`, `Info`) VALUES (NULL, :id, :name, :text);";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $delete = $dbh->prepare($sql2);
        $delete->execute([
            ":id"=>$id]);

        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id,
            ":name"=>$name,
            ":text"=>$text]);
        $dbh = null;
        return $resultSet;
    }

    public function getExtraExpectedExpertise($id)
    {
        $sql = "SELECT accountmeerinfoextra.ID as id, MeerinfoNaam as expertise, info FROM accountmeerinfoextra where AccountID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([":id"=>$id]);
        $exp = [];
        foreach ($resultSet as $row) {
            $exp = ExtraExpectedExpertise::create($row["id"],$row["expertise"], 1, $row["info"]);
        }
        $dbh = null;
        return $exp;
    }
    
    /**
     * Add a new expertise
     * 
     * @param object $expertise
     * 
     * @return void
     */
    public function newExpertise($expertise)
    {
        // Create the query
        $sql = "INSERT INTO expertises(Expertise, Actief)
                VALUES (:expertise, :active)";
        
        // Open the connection 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $new = $dbh->prepare($sql);
        $new->execute([
            ":expertise" => $expertise->getExpertise(),
            ":active"    => $expertise->getActive()
        ]);
        
        // Close the connection
        $dbh = null;
    }
    
    /**
     * Update an expertise
     * 
     * @param object $expertise
     * 
     * @return void
     */
    public function updateExpertise($expertise)
    {
        $sql = "UPDATE expertises
                SET Expertise = :expertise, 
                    Actief = :active
                WHERE ID = :id";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $update = $dbh->prepare($sql);
        $update->execute([
            ":expertise" => $expertise->getExpertise(),
            ":active"    => $expertise->getActive(),
            ":id"        => $expertise->getId()
        ]);
        
        $dbh = null;
    }
    
    public function deleteExpertise($id)
    {
        $sql = "DELETE FROM expertises WHERE ID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $delete = $dbh->prepare($sql);
        $delete->execute([":id"=>$id]);
        $dbh = null;
    }
    
    public function activator3000($id, $choice)
    {
        $sql = "UPDATE expertises SET Actief = :choice WHERE ID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $adjust = $dbh->prepare($sql);
        $adjust->execute([':id'=>$id, ":choice"=>$choice]);
        $dbh = null;
    }
    
    /**
     * Check if the name of the expertises is unique
     * 
     * @param string $expertiseName
     * @param int|null $expertiseId
     * 
     * @return bool 
     */
    public function checkUniqueExpertise($expertiseName, $expertiseId = null)
    {
        // Find the expertise by the name
        $query = "SELECT ID, Expertise, Actief
                  FROM `expertises`
                  WHERE Expertise = :expertiseName";
        
        $params = [':expertiseName' => $expertiseName];
        
        if ($expertiseId !== null) {
            $query                 .= " AND ID <> :expertiseId";
            $params[':expertiseId'] = $expertiseId;
        }
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $results = $dbh->prepare($query);
        $results->execute($params);
        
        // Get the result
        $unique = ($results->rowCount() === 0 ? true : false);
        
        // Close the connection
        $dbh = null;
        
        // Return the result
        return $unique;
    } 
}
