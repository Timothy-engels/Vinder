<?php
//business/beheerderService.php

require_once "data/accountDAO.php";

class beheerder {

    public function lijstGebruikers (){
        
        $accDAO = new AccountDAO();
        $lijst = $accDAO -> getAll();

        return $lijst;
    }

}

