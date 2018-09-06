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
}