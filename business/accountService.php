<?php
require_once("data/accountDAO.php");
require_once("data/expertiseDAO.php");
require_once("data/matchingDAO.php");
require_once("business/mailService.php");
require_once("business/encryptionService.php");

class AccountService
{
    /**
     * Get an array with all accounts
     * 
     * @return array
     */
    public function getAccounts()
    {
        $accountsDAO = new AccountDAO();
        $list        = $accountsDAO->getAll();
        
        return $list;
    }
    
    /**
     * Find an account by email address
     * 
     * @param string $email
     * 
     * @return Account|null
     */
    public function getByEmail($email)
    {
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->getByEmail($email);
        return $account;
    }

    /**
     * Find an account by id
     *
     * @param int $id
     *
     * @return Account|null
     */
    public function getById($id)
    {
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->getById($id);
        return $account;
    }
    
    /**
     * Get the complete account info
     * 
     * @param int $accountId
     * 
     * @return object
     */
    public function getCompleteAccountInfo($accountId)
    {
        // Get the account info
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->getById($accountId);
        
        if (!empty($account)) {
            
            $expertiseDAO = new ExpertiseDAO();
            
            // Add the account expertises
            $account = $expertiseDAO->addAccountExpertiseToAccountInfo($account);
            
            // Add the account expoertise extra
            $account = $expertiseDAO->addAccountExpertiseExtraToAccountInfo($account);
            
            // Add the account more info
            $account = $expertiseDAO->addAccountMoreInfoToAccountInfo($account);
            
            // Add te account expertise extra
            $account = $expertiseDAO->addAccountMoreInfoExtraToAccountInfo($account);
            
        }
        
        // Return the result
        return $account;
    }
    
    /**
     * Insert a new account
     * 
     * @param object $account
     * 
     * @return object
     */    
    public function insert($account) 
    {
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->insert($account);
        
        return $account;
    }
    
    /**
     * Update the account
     * 
     * @param obj $account (type : Account)
     * 
     * @return bool
     */
    public function update($account)
    {
        $accountDAO = new AccountDAO();
        $updated    = $accountDAO->update($account);
        
        return $updated;
    }

    /**
     * Send an email to confirm the registration
     * 
     * @param object $account
     * 
     * @return void
     */
    public function sendConfirmRegistrationMail($account)
    {
        $id    = $account->getId();
        $email = $account->getEmail();
        
        // Get the confirmation string
        $confirmationString  = $id . "|" . $email;
        
        // Get the encryption key
        $encryptionSvc = new EncryptionService();
        $code          = $encryptionSvc->encryptString(
            $confirmationString,
            $encryptionSvc::CONFIRM_REGISTRATION_KEY
        );

        // Generate the message
        $currentPath = $this->getCurrentPath();
        $link        = $currentPath . "registratie-bevestigen.php?code=" . $code;
        
        $msg = "
            <p>Beste,<br/><br/>
            Klik op de onderstaande link om je registratie te bevestigen:<br />
            <a href=\"" . $link . "\">Bevestigen</a><br /><br />
            Met vriendelijke groeten,<br/>
            VDAB</p>
        ";
        
        // Send html email        
        $mailSvc = new MailService();
        $mailSvc->sendHtmlMail($email, "Registratie bevestigen", $msg);
    }
    
    /**
     * Get the current path (without filename)
     * 
     * @return string
     */
    public function getCurrentPath()
    {
        $result = '';
        
        $protocol   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $currentUrl = $protocol . $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] !== '') {
            $currentUrl .= ':' . $_SERVER['SERVER_PORT'];
        }
        $currentUrl .= $_SERVER['REQUEST_URI'];
        
        // Remove the extra parameters
        $position = strrpos($currentUrl, '?');
        
        if ($position !== false) {
            $currentUrl = substr($currentUrl, 0, $position);
        }
        
        // Remove the file name
        $position   = strrpos($currentUrl, '/', -0);    
        
        if ($position !== false) {
            $currentUrl = substr($currentUrl, 0, $position + 1);
        }
        
        return $currentUrl;
    }
    
    /**
     * Get the information of the logged in user
     * When no user is logged in, the function redirects to the login page
     * 
     * @param bool $checkedInAsAdmin (Should the user be an administrator?)
     * 
     * @return obj (type: Account)
     */
    public function getLoggedInUser($checkedInAsAdmin = false)
    {
        // Check if a session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Redirect to login page when no session is found
        if (!array_key_exists('ID', $_SESSION)) {
            header("location: logIn.php");
        }
        
        // Get the account information
        $account = $this->getById($_SESSION['ID']);
        
        // Redirect to login page when account doesn't exists
        if ($account === null) {
            header("location: logIn.php");
        }
        
        // Check if you must be logged in as an admin
        if ($checkedInAsAdmin === true) {
            if ($account->getAdministrator() === "0") {
                header("location: logIn.php");
            }
        }
        
        // Add the amount of matches
        $matchingDAO     = new MatchingDAO();
        $amountMyMatches = $matchingDAO->getMyMatchesAmount($account);
        
        $account->setAmountMyMatches($amountMyMatches);
        
        // Return the account information
        return $account;
    }
    
    /**
     * Get the complete swiping info
     * 
     * @param int $accountId
     * @param string|null $excludeAccountIds    (string with id's to exclude - format: 8,9,10)
     * 
     * @return array
     */
    public function getCompleteSwipingInfo($accountId, $excludeAccountIds = null)
    {
        $accountDAO  = new AccountDAO();
        $swipingInfo = $accountDAO->getCompleteSwipingInfo($accountId, $excludeAccountIds);
        
        if (!empty($swipingInfo)) {
                
            // Get an array with all the active expertises
            $expertiseDAO = new ExpertiseDAO();
            $expertises   = $expertiseDAO->getAll(1);
            
             // Add the account expertises
            $swipingInfo = $expertiseDAO->addAccountExpertisesToSwipingInfo(
                $swipingInfo,
                $expertises
            );
            
            // Add the account more info
            $swipingInfo = $expertiseDAO->addAccountMoreInfoToSwipingInfo(
                $swipingInfo,
                $expertises
            );
            
            // Add the extra account expertise
            $swipingInfo = $expertiseDAO->addAccountExpertiseExtraToSwipingInfo(
                $swipingInfo
            );
            
            // Add the account more info extra
            $swipingInfo = $expertiseDAO->addAccountMoreInfoExtraToSwipingInfo(
                $swipingInfo
            );
            
        }        
        
        return $swipingInfo;
    }
    
    /**
     * Get a list with all companies that are matched (to a specified company)
     * 
     * @param int|null $companyId
     * 
     * @return type
     */
    public function getMatchedCompanies($companyId = null)
    {
        $accountDAO           = new AccountDAO();
        $companiesWithMatches = $accountDAO->getMatchedCompanies($companyId);
        
        return $companiesWithMatches;
    }
    
    /**
     * Get the amount of matches of the matched companies 
     * 
     * @return array (companyId => amountMatches)
     */
    public function getAmountMatchesByCompany()
    {
        $accountDAO    = new AccountDAO();
        $amountMatches = $accountDAO->getAmountMatchesByCompany();
        
        return $amountMatches;
    }

    /**
     * Get a list with all the companies without matches
     * 
     * @return array
     */
    public function getUnmatchedCompanies()
    {
        $accountDAO              = new AccountDAO();
        $companiesWithoutMatches = $accountDAO->getUnmatchedCompanies();
        
        return $companiesWithoutMatches;
    }
    
    /**
     * Send a mail to both companies when a match is found
     * 
     * @param int $companyId1
     * @param int $companyId2
     * 
     * @return void
     */
    public function sendMatchFoundMails($companyId1, $companyId2)
    {
        $this->sendMatchFoundMail($companyId1, $companyId2);
        $this->sendMatchFoundMail($companyId2, $companyId1);
    }
    
    /**
     * Send a mail when a match is found to a specified company
     * 
     * @param int $companyToID
     * @param int $companyMatchID
     * 
     * @return void
     */
    public function sendMatchFoundMail($companyToID, $companyMatchID)
    {         
        // Encode the IDs of the companies
        $encryptionSvc         = new EncryptionService();
        $companyToIdEncoded    = $encryptionSvc->encryptString($companyToID, $encryptionSvc::MAIL_MATCH_KEY);
        $companyMatchIdEncoded = $encryptionSvc->encryptString($companyMatchID, $encryptionSvc::MAIL_MATCH_KEY);
        
        $link        = $this->getCurrentPath() . 'createMatchMailTemplate.php?companyTo=' . $companyToIdEncoded . '&companyMatch=' . $companyMatchIdEncoded;
        $mailContent = file_get_contents($link);
        
        if ($mailContent !== '') {
            $company     = $this->getById($companyToID);
            $companyMail = $company->getEmail();
            
            $mailSrv = new MailService();
            $mailSrv->sendHtmlMail($companyMail, 'Match gevonden op Vinder', $mailContent, false);
        } 
    }     
    
    // Delete account by ID
    public function deleteById($id)
    {
        // delete by account id
        $accountDAO  = new AccountDAO();
        $swipingInfo = $accountDAO->deleteById($id);

        return $swipingInfo;
    }
    
    /**
     * Get the amount of matched companies
     * 
     * @return int
     */
    public function getAmountMatchedCompanies()
    {
        $accountDAO             = new AccountDAO();
        $amountMatchedCompanies = $accountDAO->getAmountMatchedCompanies();
        
        return $amountMatchedCompanies;
    }
    
    /**
     * Get the amount of unmatched companies
     * 
     * @return int
     */
    public function getAmountUnmatchedCompanies()
    {
        $accountDAO               = new AccountDAO();
        $amountUnmatchedCompanies = $accountDAO->getAmountUnmatchedCompanies();
        
        return $amountUnmatchedCompanies;
    }
    
}
