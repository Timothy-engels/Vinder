<?php

session_start();

class login {

    public function logout(){

        // kijken of de persoon al ingelogd is of niet.

        if ($_SESSION("ingelogged")==true){
            // session voor controle login verwijderen.
            session_unset("ingelogged"); 
        }
        else{
            // persoon is nog niet ingelogd en krijgt een notificatie.
            $bericht = "u was nog niet ingelogged";
        }

    }
    
}
