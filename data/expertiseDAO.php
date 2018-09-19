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
     * Get a list with the expertises by name
     * 
     * @param string $expertiseName
     * 
     * @return array
     */
    public function getExpertisesByName($expertiseName)
    {
        // Find the expertise by the name
        $query = "SELECT ID, Expertise, Actief
                  FROM `expertises`
                  WHERE Expertise = :expertiseName";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $results = $dbh->prepare($query);
        $results->execute([':expertiseName' => $expertiseName]);
        
        // Generate a list of expertises
        $expertises = [];
        
        foreach ($results AS $result) {
            $expertise = Expertise::create(
                $result['ID'],
                $result['Expertise'],
                $result['Actief']
            );
            
            array_push($expertises, $expertise);
        } 
        
        // Close the connection
        $dbh = null;
        
        // Return the result
        return $expertises;
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
            $exp = Expertise::create($row["id"],$row["expertise"], 1, $row["info"]);
            array_push($list, $exp);
        }
        $dbh = null;
        return $list;
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

    public function getExtraExpectedExpertise($id)
    {
        $sql = "SELECT accountmeerinfoextra.ID as id, MeerinfoNaam as expertise, info FROM accountmeerinfoextra where AccountID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([":id"=>$id]);
        $exp = [];
        foreach ($resultSet as $row) {
            $exp = ExtraExpertise::create($row["id"],$row["expertise"], 1, $row["info"]);
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
    
    public function updateExpertise($expertise, $id)
    {
        $sql = "UPDATE expertises SET Expertise = :expertise WHERE ID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $update = $dbh->prepare($sql);
        $update->execute([":expertise"=>$expertise, ":id"=>$id]);
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
}
