<?php
require_once("entities/expertise.php");

class ExtraExpertise extends Expertise
{
    private static $idMapExtra = array();

    public static function create(
        $id,
        $expertise,
        $active = 1,
        $info = null
    ) {
        if (!isset(self::$idMapExtra[$id])) {
            self::$idMapExtra[$id] = new Expertise(
                $id,
                $expertise,
                $active = 1,
                $info
            );
        }

        return self::$idMapExtra[$id];
    }

}