<?php
//data/expertiseDAO.php

require_once("DBConfig.php");
require_once("entities/expertise.php");

class ExpertiseDAO {

    public function getExpertises() {
        $sql = "SELECT Expertise as expertise, ID as id FROM expertises";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $list = array();
        foreach ($resultSet as $row) {
            $expertise = entities\expertise::create($row["id"], $row["expertise"]);
            array_push($list, $expertise);
        }
        $dbh = null;
        return $list
    }
    
}