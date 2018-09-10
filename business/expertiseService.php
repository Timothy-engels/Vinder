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


}

