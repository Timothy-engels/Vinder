<?php

//entities/settings.php

namespace entities;

/**
 * Class Settings
 *
 * Hold the properties of the settings
 */
class Settings
{
   private static $idMap = null;
   
   protected $registerDate;
   protected $swipeDate;
   
   /**
    * @param dateTime $registerDate
    * @param dateTime $swipeDate
    */
   private function __construct($registerDate, $swipeDate)
   {
       $this->registerDate = $registerDate;
       $this->swipeDate    = $swipeDate;
   }
   
   /**
    * @param dateTime $registerDate
    * @param dateTime $swipeDate
    * 
    * @return object
    */
   public static function create($registerDate, $swipeDate)
   {
       if (self::$idMap === null) {
           self::$idMap = new Settings($registerDate, $swipeDate);
       }
       
       return $self::$idMap;
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
}
