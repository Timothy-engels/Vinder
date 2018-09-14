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
     * @param int|null $accountId
     * 
     * @return string
     */
    public function checkUniqueAccountEmail($email, $accountId = null)
    {        
        $result  = '';
        
        $accountService = new AccountService();
        $account        = $accountService->getByEmail($email);
                
        if ($account !== null) {
            if ($accountId !== null) {
                if ($account->getId() !== $accountId) {
                    $result = 'Dit veld moet een uniek e-mail adres bevatten.';
                }
            } else {
                $result = 'Dit veld moet een uniek e-mail adres bevatten.';
            }
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

        if (!preg_match('/^((?=.*\d)(?=.*[A-Z])(?=.*[a-z])((?=.*\W)|(?=.*\_)).{8,50})/', $value)) {
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
    
    /**
     * Check if the date is valid
     * 
     * @param string $value
     * @param string $format
     * 
     * @return string
     */
    public function checkValidDate($value, $format = 'd-m-Y')
    {
        $result = '';
        $d      = DateTime::createFromFormat($format, $value);
    
        // The Y ( 4 digits year ) returns TRUE for any integer with any number 
        // of digits so changing the comparison from == to === fixes the issue.
        if (!$d || $d->format($format) !== $value) {
            $result = 'Dit veld moet een geldige datum bevatten.';
        }
        
        return $result;
    }
    
    /**
     * 
     * @param string $firstDate (date time notation)
     * @param string $lastDate (date time notation)
     * @param string $firstDateTranslation
     * @param string $lastDateTranslation
     * @param string $format
     */
    public function checkDateBiggerThen(
        $firstDate,
        $lastDate,
        $firstDateTranslation,
        $lastDateTranslation,
        $format = 'd-m-Y'
    ) {
        // Set the result
        $result = '';
        
        // Format the dates to a date time string
        $fd = DateTime::createFromFormat($format, $firstDate);
        $ld = DateTime::createFromFormat($format, $lastDate);
        
        if ($fd > $ld) {
            $result = 'De \'' . $lastDateTranslation . '\' moet na de \'' . $firstDateTranslation . '\' liggen!';
        }
        
        return $result;
    }
 
}
