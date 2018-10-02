<?php
/**
 * Encryption Service
 *
 * Holds function for encrypting / decrypting code
 */
class EncryptionService
{
    const CONFIRM_REGISTRATION_KEY    = 'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS';
    const FORGOTTEN_PASSWORD_KEY      = 'MxSxqv4NKjb4rwjfh7SzrYNV5uGEg45H';
    const MAIL_MATCH_KEY              = 'kNWLohoNWEByXjhks5ih1TxtaTcD3zHW';
    const DELETE_MATCHING_STRING      = 'AfcPNY6Rwxd27hkcFNZh3wjehLrtcVzT';
    const CIPHER                      = 'aes-256-cbc';
    
    /**
     * Encrypt a string
     * 
     * @param string $string
     * @param string $key
     * 
     * @return string
     */
    public function encryptString($string, $key)
    {
        $length = openssl_cipher_iv_length(self::CIPHER);
        $iv     = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", $length)), 0, $length);

        $encrypted = openssl_encrypt(
            $string,
            self::CIPHER,
            $key,
            $options = 0,
            $iv
        );
        
        return base64_encode($encrypted . '::' . $iv);
    }
    
    /**
     * Decrypt a string
     * 
     * @param string $string
     * @param string $key
     * 
     * @return type
     */
    public function decryptString($string, $key)
    {
        $result        = '';
        $base64Decoded = base64_decode($string);
        $position      = strrpos($base64Decoded, '::');
        
        if ($position !== false) {
            list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);
            
            $result = openssl_decrypt(
                $encrypted_data,
                self::CIPHER,
                $key,
                $options = 0,
                $iv
            );  
        }
        
        return $result;
    }
}
