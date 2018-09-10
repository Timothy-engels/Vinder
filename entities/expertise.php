<?php
//entities/expertises.php


class Expertise {

    private static $idMap = array();

    /**
     * @param int $id
     * @param string $expertise
     * @param bool $active
     */
    private $id;
    private $expertise;
    private $active;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getExpertise()
    {
        return $this->expertise;
    }

    /**
     * @param mixed $expertise
     */
    public function setExpertise($expertise)
    {
        $this->expertise = $expertise;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Expertise constructor.
     * @param $id
     * @param $expertise
     * @param $active
     */
    public function __construct($id, $expertise, $active)
    {
        $this->id = $id;
        $this->expertise = $expertise;
        $this->active = $active;
    }

    public static function create(
        $id,
        $expertise,
        $active
    ) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Expertise(
                $id,
                $expertise,
                $active
            );
        }

        return self::$idMap[$id];
    }
}