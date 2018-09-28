<?php

/**
 * Date Service
 * 
 * Holds function for dates
 */
class dateService
{
    /**
     * @param string $date
     * @param string $separator
     * 
     * @return string
     */
    public function dateToDbString($date, $separator)
    {
        $dateArray = explode($separator, $date);
        
        return $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0] . ' 00:00:00';
    }
    
    /**
     * @param string $date
     * @param string $separator
     */
    public function dateDbToString($date, $separator)
    {
        $tmpDate   = substr($date, 0, 10);
        $dateArray = explode($separator, $tmpDate);
        
        return $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
    }
    
    /**
     * Check if the first date is bigger than the last date
     * 
     * @param string $firstDate
     * @param string $lastDate
     * @param string $format
     * 
     * @return boolean
     */
    public function isBiggerThen($firstDate, $lastDate, $format)
    {
        $result = false;
        
        // Format the dates to a date time string
        $fd = DateTime::createFromFormat($format, $firstDate);
        $ld = DateTime::createFromFormat($format, $lastDate);
        
        // Compare the dates
        if ($fd > $ld) {
            $result = true;
        }
        
        // Return the result
        return $result;
    }
}