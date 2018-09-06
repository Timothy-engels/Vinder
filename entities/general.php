<?php

//entities/general.php

namespace entities;

/**
 * Class General
 *
 * Hold the properties of the general settings
 */
class General
{
   private static $idMap = null;
   
   protected $registerDate;
   protected $swipeDate;
   protected $mail;
   
   /**
    * @param dateTime $registerDate
    * @param dateTime $swipeDate
    * @param string $mail
    * 
    * @return void
    */
   private function __construct($registerDate, $swipeDate, $mail)
   {
       $this->registerDate = $registerDate;
       $this->swipeDate    = $swipeDate;
       $this->mail         = $mail;
   }
   
   /**
    * @param dateTime $registerDate
    * @param dateTime $swipeDate
    * @param string $mail
    * 
    * @return object
    */
   public static function create($registerDate, $swipeDate, $mail)
   {
       if (self::$idMap === null) {
           self::$idMap = new General($registerDate, $swipeDate, $mail);
       }
       
       return self::$idMap;
   }
   
   /**
    * @return dateTime
    */
   public function getRegisterDate()
   {
       return $this->registerDate;
   }
   
   /**
    * @param dateTime $registerDate
    * 
    * @return object
    */
   public function setRegisterDate($registerDate)
   {
       $this->registerDate = $registerDate;
       return $this;
   }
   
   /**
    * @return dateTime
    */
   public function getSwipeDate()
   {
       return $this->swipeDate;
   }
   
   /**
    * @param dateTime $swipeDate
    * 
    * @return $this
    */
   public function setSwipeDate($swipeDate)
   {
       $this->swipeDate = $swipeDate;
       return $this;
   }
   
   /**
    * @return string
    */
   public function getMail()
   {
       return $this->mail;
   }
   
   /**
    * @param string $mail
    * 
    * @return $this
    */
   public function setMail($mail)
   {
       $this->mail = $mail;
       return $this;
   }
}
