<?php
//data/accountDAO.php

require_once("DBConfig.php");
require_once("entities/account.php");


class AccountDAO
{
    public function getAll()
    {
        $sql = "select naam as name, contactpersoon as contactPerson, emailadres as email, wachtwoord as password, bevestigd as confirmed, logo, website, admin as adniminstrator from accounts";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $list = array();
        foreach ($resultSet as $row) {
            $account = entities\Account::create($row["name"], $row["contactPerson"], $row["email"], $row["password"], $row["confirmed"], $row["logo"], $row["website"], $row["info"], $row["administrator"]);
            array_push($list, $account);
        }
        $dbh = null;
        return $list;
    }
    public function UpdateProfile() {
        $sql = "UPDATE `accounts` SET `Naam`= :naam,`Contactpersoon`= :contactpersoon,`Emailadres`=:email,`Website`= :website,`Logo`= :Logo,`Info`= :Info";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);

        $stmt = $resultSet->execute(array(
            ":naam" = $_POST["naam"],
            ":contactpersoon" = $_POST["contacpersoon"],
            ":email" = $_POST["email"],
            ":website" = $_POST["website"],
            ":Logo" = $_POST["Logo"],
            ":Info" = $_POST["info"]
        ))

        $dbh = null;
    }
}