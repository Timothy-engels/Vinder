<?php
//business/accountService.php

require_once("data/accountDAO.php");

class AccountService
{
    public function getAccounts()
    {
        $accountsDAO = new AccountDAO();
        $list = $accountsDAO->getAll();
        return $list;
    }
}