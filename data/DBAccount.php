<?php
//data/DBAccount.php
require_once("DBConfig.php");
require_once("entities/account.php");
    
class GebruikerDAO{
    
    protected function GetProfiel {
        $sql ="select ID, contactpersoon, Emailadres, info, Logo, naam, website  from accounts";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->querry($sql);
        
        $lijst = array();
        foreach($resultset as $rij){
            $profiel = Account::create($rij["ID"],$rij["contactpersoon"],$rij["Emailadres"],$rij["info"],$rij["Logo"],$rij["naam"],$rij["website"]);
            array_push($lijst, $profiel)
        }
        $dbh = NULL;
        return $lijst;
    }
}