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
        print_r($list);
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
            $exp = ExtraExpertise::create($row["id"],$row["expertise"], 1, $row["info"]);
        }
        $dbh = null;
        return $exp;
    }
    
    public function newExpertise($expertise)
    {
        $sql = "INSERT INTO expertises(Expertise, Actief) VALUES (:expertise, 1)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $new = $dbh->prepare($sql);
        $new->execute([":expertise"=>$expertise]);
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
