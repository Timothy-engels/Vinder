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
    
    public function new($expertise)
    {
        $sql = "INSERT INTO expertises(Expertise, Actief) VALUES (':expertise', 0)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $new = $dbh->prepare($sql);
        $new->execute([":expertise"=>$expertise]);
        $dbh = null;
    }
    
    public function update($expertise, $id)
    {
        $sql = "UPDATE expertises SET Expertise=':expertise' WHERE ID=':id'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $update = $dbh->prepare($sql);
        $update->execute([":expertise"=>$expertise, ":id"=>$id]);
        $dbh = null;
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM expertises WHERE ID = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $delete = $dbh->prepare($sql);
        $delete->execute([':id'=>$id]);
        $dbh = null;
    }
}