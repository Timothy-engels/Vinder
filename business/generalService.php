<?php

//business/generalService.php

require_once("data/generalDAO.php");

class generalService
{
    /**
     * Find the general settings
     * 
     * @return object|null
     */
    public function get()
    {
        $generalDAO = new GeneralDAO();
        $general    = $generalDAO->get();
        return $general;
    }
    
    /**
     * Update the dates (insert new record when no record is available)
     * 
     * @param object $generalObject
     * 
     * @return void
     */
    public function updateDates($generalObject)
    {
        $generalDAO = new GeneralDAO();
        
        if ($generalDAO->get() !== null) {
            $generalDAO->updateDates($generalObject);    
        } else {
            $generalObject->setMail('');
            $generalDAO->insert($generalObject); 
        }
        
    }
}