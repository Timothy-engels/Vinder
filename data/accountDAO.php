<?php
//data/accountDAO.php

require_once("DBConfig.php");
require_once("../entities/account.php");



class AccountDAO
{
    public function getAll()
    {
        $sql = "select naam as name, contactpersoon as contactPerson, emailadres as email, wachtwoord as password, bevestigd as confirmed, logo, website, info from accounts, admin as adniminstrator";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $list = array();
        foreach ($resultSet as $row) {
            $account = Account::create($row["name"], $row["contactPerson"], $row["email"], $row["password"], $row["confirmed"], $row["logo"], $row["website"], $row["info"], $row["administrator"]);
            array_push($list, $account);
        }
        $dbh = null;
        return $list;
    }
    
    }
