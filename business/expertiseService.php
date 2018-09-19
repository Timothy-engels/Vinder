<?php
//business/expertiseService.php

require_once("data/expertiseDAO.php");

class ExpertiseService
{
    public function getExpertises()
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->getAll();
        return $list;
    }
    
    public function getExpertisesById($id)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->getByUserId($id);
        return $list;
    }
    
    public function getExpectedExpertisesById($id)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->getExpectedByUserId($id);
        return $list;
    }

    public function getExtraExpertise($id){
        $expertiseDAO = new ExpertiseDAO();
        $exp = $expertiseDAO->getExtraExpertise($id);
        return $exp;
    }

    public function getExtraExpectedExpertise($id){
        $expertiseDAO = new ExpertiseDAO();
        $exp = $expertiseDAO->getExtraExpectedExpertise($id);
        return $exp;
    }

    /**
     * Add a new expertise
     * 
     * @param object $expertise
     * 
     * @return $expertise
     */
    public function addExpertise($expertise)
    {
        $expertiseDAO = new ExpertiseDAO();
        $expertiseDAO->newExpertise($expertise);
    }
    
    /**
     * Update an expertise
     * 
     * @param object $expertise
     * 
     * @return void
     */
    public function updateExpertise($expertise)
    {
        $expertiseDAO = new ExpertiseDAO();
        $expertiseDAO->updateExpertise($expertise);
    }
    
    public function deleteExpertise($edid){
        $expertiseDAO = new ExpertiseDAO();
        $exp = $expertiseDAO->deleteExpertise($edid);
    }
    
    /**
     * Get the details of the specified expertise
     * 
     * @param int $expertiseId
     * 
     * @return null|object
     */
    public function getById($expertiseId)
    {
        $expertiseDAO = new ExpertiseDAO();
        $expertise    = $expertiseDAO->getById($expertiseId);
        
        return $expertise;
    }       
    
    /**
     * Check if the name of the expertises is unique
     * 
     * @param string $expertiseName
     * @param int|null $expertiseId
     * 
     * @return bool 
     */
    public function checkUniqueExpertise($expertiseName, $expertiseId)
    {
        $expertiseDAO    = new ExpertiseDAO();
        $uniqueExpertise = $expertiseDAO->checkUniqueExpertise($expertiseName, $expertiseId);
        
        return $uniqueExpertise;
    }
}

