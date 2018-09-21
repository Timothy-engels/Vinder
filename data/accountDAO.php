<?php
//data/accountDAO.php

require_once("DBConfig.php");
require_once("entities/account.php");

class AccountDAO
{
    /**
     * Get an array with all accounts
     * 
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT ID, Naam, Contactpersoon, Emailadres, Wachtwoord, 
                  Bevestigd, Website, Logo, Info, Admin
                FROM `accounts`";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $resultSet = $dbh->query($sql);
        
        $list = array();
        
        foreach ($resultSet as $row) {
            $account = entities\Account::create(
                $row["ID"],
                $row["Naam"],
                $row["Contactpersoon"],
                $row["Emailadres"],
                $row["Wachtwoord"],
                $row["Bevestigd"],$row["Website"], $row["Logo"],  $row["Logo"], $row["Admin"]
            );
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
     * Find an account by the email address
     * 
     * @param int $id
     * 
     * @return object
     */
    public function getById($id)
    {
        // Find the account by the id
        $sql = "SELECT ID, Naam, Contactpersoon, Emailadres, Wachtwoord, Bevestigd, Website, Logo, Info, Admin
                FROM accounts
                WHERE ID = :id";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $id]);

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
    
    /**
     * Update the account information
     * 
     * @param obj $account
     * 
     * @return void
     */
    public function update($account)
    {
        // Generate & execute the query
        $query = "UPDATE `accounts`
                  SET Naam = :name,
                      ContactPersoon = :contactPerson,
                      EmailAdres = :mail,
                      Wachtwoord = :password,
                      Bevestigd = :confirmed,
                      Website = :website,
                      Logo = :logo,
                      Info = :info,
                      Admin = :admin
                  WHERE ID = :id"; 
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($query);
        $stmt->execute([
            ':name'          => $account->getName(),
            ':contactPerson' => $account->getContactPerson(),
            ':mail'          => $account->getEmail(),
            ':password'      => $account->getPassword(),
            ':confirmed'     => $account->getConfirmed(),
            ':website'       => $account->getWebsite(),
            ':logo'          => $account->getLogo(),
            ':info'          => $account->getInfo(),
            ':admin'         => $account->getAdministrator(),
            ':id'            => $account->getId()
        ]);
        
        // Check if the account is updated
        $count = $stmt->rowCount();
        
        $update = false;
        if ($count === 1){
            $update = true;
        }
        
        // Close the db connection
        $dbh = null;
        
        // Return the result
        return $update;
    }
    
    public function getSwipeProfile($id)
    {
     // Find the account by the id
        $sql = "SELECT Naam, Logo, Info
                FROM accounts
                WHERE ID = :id";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Get the acount information
        $swipeProfile = null;

        if ($stmt->rowCount() > 0) {

            $rij = $stmt->fetch(PDO::FETCH_ASSOC);

            $swipeProfile = entities\Account::create(
                $rij['Naam'],
                $rij['Logo'],
                $rij['Info']
            );
        }

        // Return the account information
        return $swipeProfile;   
    }
    
}