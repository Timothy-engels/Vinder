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
                $row["Bevestigd"],$row["Website"], $row["Logo"],  $row["Info"], $row["Admin"]
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
    
    /**
     * Get the swiping information for a specified company
     * 
     * @param int $companyId
     * 
     * @return array
     */
    public function getSwipingInfo($companyId)
    {
        // Create the sql
        $sql = "SELECT ID
                FROM `accounts`
                WHERE ID <> :companyId
                  AND Bevestigd = 1
                  AND Admin = 0
                  AND ID NOT IN (
                    SELECT AccountID2
                    FROM `matching`
                    WHERE AccountID1 = :accountId1
                    AND Status NOT IN (0, 2, -2)
                  )
                  AND ID NOT IN (
                    SELECT AccountID1
                    FROM `matching`
                    WHERE AccountID2 = :accountId2
                    AND Status NOT IN (1, -4, 0)
                  )
                  ";
                  
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ':companyId'  => $companyId,
            ':accountId1' => $companyId,
            ':accountId2' => $companyId
        ]);
        
        // Return the results
        $accounts = [];
        
        foreach ($resultSet as $result) {            
            $accounts[] = $result['ID'];
        }
        
        return $accounts;
    }
    
    /**
     * Get the swiping information for a specified company
     * 
     * @param int $companyId
     * 
     * @return array
     */
    public function getCompleteSwipingInfo($companyId)
    {
        // Create the sql
        $sql = "SELECT *
                FROM `accounts`
                WHERE ID <> :companyId
                  AND Bevestigd = 1
                  AND Admin = 0
                  AND ID NOT IN (
                    SELECT AccountID2
                    FROM `matching`
                    WHERE AccountID1 = :accountId1
                    AND Status NOT IN (0, 2, -2)
                  )
                  AND ID NOT IN (
                    SELECT AccountID1
                    FROM `matching`
                    WHERE AccountID2 = :accountId2
                    AND Status NOT IN (1, -4, 0)
                  )
                  LIMIT 10";
                  
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ':companyId'  => $companyId,
            ':accountId1' => $companyId,
            ':accountId2' => $companyId
        ]);
        
        // Return the results
        $accounts = [];
        
        foreach ($resultSet as $result) {
            
            $account = entities\Account::create(
                $result['ID'],
                $result['Naam'],
                $result['Contactpersoon'],
                $result['Emailadres'],
                $result['Wachtwoord'],
                $result['Bevestigd'],
                $result['Website'],
                $result['Logo'],
                $result['Info'],
                $result['Admin']
            );
            
            $accounts[$result['ID']] = $account;
            
        }
        
        return $accounts;
    }
    
    /**
     * Get a list with all companies that are matched (to a specified company)
     * 
     * @param int $companyId
     * 
     * @return array
     */
    public function getMatchedCompanies($companyId = null)
    {
        // Create the sql
        $sql  = "SELECT DISTINCT a.*
                 FROM accounts a
                 WHERE ID IN (
                   SELECT AccountID1 AS AccountID
                   FROM matching
                   WHERE Status = 3 ";
        
        $params = [];
        
        if ($companyId !== null) {
            $sql                  .= " AND AccountID2 = :companyId1 ";
            $params[':companyId1'] = $companyId;
        }
        
        $sql .= "UNION
                   SELECT AccountID2 as AccountID
                   FROM matching
                   WHERE Status = 3 ";
        
        if ($companyId !== null) {
            $sql                  .= " AND AccountID1 = :companyId2 ";
            $params[':companyId2'] = $companyId;
        }
        
        $sql .= ")
                 ORDER BY a.Naam";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute($params);
        
        // Return the results
        $accounts = [];
        
        foreach ($resultSet as $result) {
            
            $account = entities\Account::create(
                $result['ID'],
                $result['Naam'],
                $result['Contactpersoon'],
                $result['Emailadres'],
                $result['Wachtwoord'],
                $result['Bevestigd'],
                $result['Website'],
                $result['Logo'],
                $result['Info'],
                $result['Admin']
            );
            
            $accounts[] = $account;
        }
        
        return $accounts;
    }
    
    /**
     * Get the amount of matches of the matched companies 
     * 
     * @return array (companyId => amountMatches)
     */
    public function getAmountMatchesByCompany()
    {
        // Create the sql
        $sql = "SELECT AccountID, COUNT(AccountID) AS Amount
                FROM (
                  SELECT AccountID1 AS AccountID
                  FROM matching
                  WHERE Status = 3
                  UNION ALL
                  SELECT AccountID2 AS AccountID
                  FROM matching
                  WHERE Status = 3
                ) AS MC
                GROUP BY AccountID";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute();
        
        // Return the results
        $amountMatches = [];
        
        foreach ($resultSet as $result) {
            $amountMatches[$result['AccountID']] = $result['Amount'];
        }
        
        return $amountMatches;
    }
    
    /**
     * Get a list with all companies that are unmatched
     * 
     * @return array
     */
    public function getUnmatchedCompanies()
    {
        // Create the sql
        $sql = "SELECT *
                FROM accounts
                WHERE Bevestigd = 1
                  AND Admin = 0
                  AND ID NOT IN (
                    SELECT AccountID1 AS AccountID
                    FROM matching
                    WHERE Status = 3
                    UNION
                    SELECT AccountID2 AS AccountID
                    FROM matching
                    WHERE Status = 3
                )";
        
        // Open the connection
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        // Execute the query
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute();
        
        // Return the results
        $accounts = [];
        
        foreach ($resultSet as $result) {
            $account = entities\Account::create(
                $result['ID'],
                $result['Naam'],
                $result['Contactpersoon'],
                $result['Emailadres'],
                $result['Wachtwoord'],
                $result['Bevestigd'],
                $result['Website'],
                $result['Logo'],
                $result['Info'],
                $result['Admin']
            );
            
            $accounts[$result['ID']] = $account;
        }
        
        return $accounts;              
    }

    //remove account
    public function deleteById($id)
    {
        $sql = "DELETE FROM `accounts` WHERE `accounts`.`ID` = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $resultSet->execute([
            ":id"=>$id
        ]);
        $dbh = null;
        return $resultSet;
    }
    
}