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
    
    /**
     * Get a list with expertises by name
     * 
     * @param string $expertiseName
     * 
     * @return array 
     */
    public function getExpertisesByName($expertiseName)
    {
        $expertiseDAO = new ExpertiseDAO();
        $expertises   = $expertiseDAO->getExpertisesByName($expertiseName);
        return $expertises;
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

    public function addExpertise($expertise){
        $expertiseDAO = new ExpertiseDAO();
        $exp = $expertiseDAO->newExpertise($expertise);
    }
    
    public function updateExpertise($expertise, $eaid){
        $expertiseDAO = new updateExpertiseDAO();
        $exp = $expertiseDAO->Expertise($expertise, $eaid);
    }
    
    public function deleteExpertise($edid){
        $expertiseDAO = new ExpertiseDAO();
        $exp = $expertiseDAO->deleteExpertise($edid);
    }
}

