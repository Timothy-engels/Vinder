<?php
//data/accountDAO.php

require_once("DBConfig.php");
require_once("entities/account.php");

class AccountDAO
{
    public function getAll()
    {
        $sql = "select id, naam as name, contactpersoon as contactPerson, emailadres as email, wachtwoord as password, bevestigd as confirmed, website, logo, info, admin as adniminstrator from accounts";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $list = array();
        foreach ($resultSet as $row) {
            $account = entities\Account::create($row["id"],$row["name"], $row["contactPerson"], $row["email"], $row["password"], $row["confirmed"],$row["website"], $row["logo"],  $row["info"], $row["administrator"]);
            array_push($list, $account);
        }
        $dbh = null;
        return $list;
    }
    
    /**
     * Find an account by the email address
     * 
     * @param string $email
     * 
     * @return Account|null
     */
    public function getByEmail($email)
    {   
        // Find the account by the email address
        $sql = "SELECT ID, Naam, Contactpersoon, Emailadres, Wachtwoord, Bevestigd, Website, Logo, Info, Admin
                FROM accounts
                WHERE Emailadres = :email";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        // Get the acount information
        $account = null;
        
        if ($stmt->rowCount() > 0) {
            
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);

            $account = entities\Account::create(
                $rij['ID'],
                $rij['Naam'],
                $rij['Contactpersoon'],
                $rij['Emailadres'],
                $rij['Wachtwoord'],
                $rij['Bevestigd'],
                $rij['Website'],
                $rij['Logo'],
                $rij['Info'],
                $rij['Admin']
            );
        }
        
        // Close the db connection
        $dbh = null;
        
        // Return the account information
        return $account;                
    }
    
    /**
     * Add a new account
     * 
     * @param string $name
     * @param string $contactPerson
     * @param string $email
     * @param string $password
     * @param int $confirmed
     * @param int $administrator
     * 
     * @return void
     */
    public function insert(
        $name,
        $contactPerson,
        $email,
        $password,
        $confirmed = 0,
        $administrator = 0
    ) {        
        // Insert the account
        $sql = "INSERT INTO accounts (Naam, Contactpersoon, Emailadres, Wachtwoord, Bevestigd, Admin)
                VALUES (:name, :contactPerson, :email, :password, :confirmed, :admin)";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':name'          => $name,
            ':contactPerson' => $contactPerson,
            ':email'         => $email,
            ':password'      => $password,
            ':confirmed'     => $confirmed,
            ':admin'         => $administrator
        ]);
        
        // Get the account ID
        $accountId = $dbh->lastInsertId();
        
        // Close the db connection
        $dbh = null;
        
        // Return the account                        
        $account = entities\Account::create(
            $accountId,
            $name,
            $contactPerson,
            $email,
            $password,
            $confirmed,
            null,
            null,
            null,
            $administrator
        );
        
        return $account;
    }

    public function UpdateProfile() {
        // code voor update van Database
        $sql = "UPDATE `accounts` 
                SET 
                `Naam`= :naam,
                `Contactpersoon`= :contactpersoon,
                `Emailadres`=:email,
                `Website`= :website,
                `Logo`= :Logo,
                `Info`= :Info"
                ;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);

        $stmt = $resultSet->execute(array(
            ":naam" => $_POST["naam"],
            ":contactpersoon" => $_POST["contacpersoon"],
            ":email" => $_POST["email"],
            ":website" => $_POST["website"],
            ":Logo" => $_POST["Logo"],
            ":Info" => $_POST["info"]
        ));

        $dbh = null;
    }

    /**
     * Registration confirmation

     * @param string $email
     *
     * @return bool
     */
    public function confirm(
        $email
    ) {
        // Insert the account
        $sql = "UPDATE accounts SET Bevestigd = 1 WHERE emailadres = :email";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':email'         => $email
        ]);

        $count = $stmt->rowCount();

        if($count =='0'){
            $update = false;
        }
        else{

            $update = true;
        }

        // Close the db connection
        $dbh = null;

        return $update;
    }

}