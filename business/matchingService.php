<?php
// business/matchingService.php

require_once ('data/accountDAO.php');
Session_start();

class matchingService {
    
    public function getMatchOverzicht () {
        $mDB = new AccountDAO();
        $match = $mDB -> getMatchedCompanies($_SESSION['ID']);
        return $match;
    }
}