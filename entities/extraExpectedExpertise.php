<?php
require_once("entities/expertise.php");

class ExtraExpectedExpertise extends Expertise
{
    private static $idMapExtraExpected = array();

    public static function create(
        $id,
        $expertise,
        $active = 1,
        $info = null
    ) {
        if (!isset(self::$idMapExtraExpected[$id])) {
            self::$idMapExtraExpected[$id] = new Expertise(
                $id,
                $expertise,
                $active = 1,
                $info
            );
        }

        return self::$idMapExtraExpected[$id];
    }

}