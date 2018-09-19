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


    public function addExpertisesById($id,$eId,$text)
    {
        $expertiseDAO = new ExpertiseDAO();
        $result = $expertiseDAO->addByUserId($id,$eId,$text);
        return $result;
    }

    public function addExpectedExpertisesById($id,$eId,$text)
    {
        $expertiseDAO = new ExpertiseDAO();
        $result = $expertiseDAO->addExpectedByUserId($id,$eId,$text);
        return $result;
    }

    public function deleteExpertisesByUserId($id)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->deleteAllByUserId($id);
        return $list;
    }

    public function deleteExpectedByUserId($id)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->deleteAllExpectedByUserId($id);
        return $list;
    }

    public function addExtraExpertiseByUserId($id,$name,$text)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->addExtraExpertise($id,$name,$text);
        return $list;
    }

    public function addExtraExpectedExpertiseByUserId($id,$name,$text)
    {
        $expertiseDAO = new ExpertiseDAO();
        $list = $expertiseDAO->addExtraExpectedExpertise($id,$name,$text);
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

