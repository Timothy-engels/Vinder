<?php

//business/generalService.php

require_once("data/generalDAO.php");

class GeneralService
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
    
    /**f
     * Update the mail (insert new record when no record is available)
     * 
     * @param object $generalObject
     * 
     * @return void
     */
    public function updateMail($generalObject)
    {        
        $generalDAO = new GeneralDAO();
        
        if ($generalDAO->get() !== null) {
            $generalDAO->updateMail($generalObject);
        } else {
            $generalObject->setRegisterDate('2099-12-31 00:00:00');
            $generalObject->setSwipeDate('2099-12-31 00:00:00');
            $generalDAO->insert($generalObject);
        }
    }
}