<?php
//entities/expertises.php


class Expertise {

    private static $idMap = array();

    /**
     * @param int $id
     * @param string $expertise
     * @param bool $active
     * @param string $info
     */
    private $id;
    private $expertise;
    private $active;
    private $info;

    public function __construct($id, $expertise, $active, $info)
    {
        $this->id        = $id;
        $this->expertise = $expertise;
        $this->active    = $active;
        $this->info      = $info;
    }
    
    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getExpertise()
    {
        return $this->expertise;
    }

    /**
     * @param string $expertise
     */
    public function setExpertise($expertise)
    {
        $this->expertise = $expertise;
    }

    /**
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Expertise constructor
     * 
     * @param $id
     * @param $expertise
     * @param $active
     * @param string $info
     */
    public static function create(
        $id,
        $expertise,
        $active = 1,
        $info = null
    ) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Expertise(
                $id,
                $expertise,
                $active,
                $info
            );
        }

        return self::$idMap[$id];
    }
}

class ExpectedExpertise extends Expertise{

    private static $idMapExpected = array();

    public static function create(
        $id,
        $expertise,
        $active = 1,
        $info = null
    ) {
        if (!isset(self::$idMapExpected[$id])) {
            self::$idMapExpected[$id] = new Expertise(
                $id,
                $expertise,
                $active = 1,
                $info
            );
        }

        return self::$idMapExpected[$id];
    }

}