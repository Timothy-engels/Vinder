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
}
