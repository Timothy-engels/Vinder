<?php
require_once("accountService.php");

/**
 * Validation Service
 * 
 * Holds function for validation user input
 */
class ValidationService 
{
    /**
     * Check is the value is required with a maximum length 
     * 
     * @param type $value
     * @param int $length
     * 
     * @return string
     */
    public function checkRequiredAndMaxLength($value, $length)
    {        
        $result = $this->checkRequired($value);
        
        // Check the max length of the value
        if ($result === '') {
            $result = $this->checkMaxLength($value, $length);
        }
        
        return $result;
    }
    
    /**
     * Check if the given value is not empty
     * 
     * @param string $value
     * 
     * @return string
     */
    public function checkRequired($value)
    {
        $result = '';
        
        if (trim($value) === '') {
            $result = 'Dit is een verplicht veld.';
        }
        
        return $result;
    }
    
    /**
     * Check if the min. length of the value
     * 
     * @param string $value
     * @param int $length
     * 
     * @return string
     */
    public function checkMinLength($value, $length)
    {
        $result = '';
        
        if (strlen($value) < $length) {
            $result = 'Dit veld moet min. ' . $length . ' karakters bevatten.';
        }
        
        return $result;
    }
    
    /**
     * Check if the max. length of the value
     * 
     * @param string $value
     * @param int $length
     * 
     * @return string
     */
    public function checkMaxLength($value, $length)
    {
        $result = '';
        
        if (strlen($value) > $length) {
            $result = 'Dit veld mag max. ' . $length . ' karakters bevatten.';
        }
        
        return $result;
    }
    
    /**
     * Check if the value is a valid e-mail address
     * 
     * @param string $value
     * 
     * @return string
     */
    public function checkEmail($value)
    {
        $result = '';
       
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $result = 'Dit veld moet een geldig e-mail adres bevatten.';
        }
        
        return $result;
    }
    
    
    /**
     * Check if the email address is unique
     * 
     * @param string $value
     * 
     * @return string
     */
    public function checkUniqueAccountEmail($email)
    {        
        $result  = '';
        
        $accountService = new AccountService();
        $account        = $accountService->getByEmail($email);
                
        if ($account !== null) {
            $result = 'Dit veld moet een uniek e-mail adres bevatten.';
        }
        
        return $result;
    }
    
    /*     
     * Checks if the password is safe (must contain at least one letter, one 
     * capital letter, one digit and one special character)
     * 
     * @param string $value
     * 
     * @return string
     */
    public function checkSafePassword($value)
    {
        $result = '';
        
        if (!preg_match('/^((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,50})/', $value)) {
            $result = 'Het wachtwoord moet minstens 1 letter, 1 hoofdletter, 1 cijfer en een speciaal karakter bevatten';
        }
        
        return $result;
    }
    
    /**
     * Check if the passwords agree
     * 
     * @param string $password
     * @param string $repeatedPassword
     * 
     * @return string
     */
    public function checkRepeatPassword($password, $repeatedPassword)
    {
        $result = '';
        
        if ($password !== $repeatedPassword) {
            $result = 'De wachtwoorden komen niet overeen.';
        }
        
        return $result;
    } 
 
}