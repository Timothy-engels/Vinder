<?php
//entities/expertises.php

class Expertise
{
    private $id;
    private $expertise;
    private $active;
    private $info;
    
    private static $idMap = array();

    /**
     * @param int $id
     * @param object $expertise
     * @param bool $active
     * @param string $info
     */
    public function __construct($id, $expertise, $active, $info)
    {
        $this->id        = $id;
        $this->expertise = $expertise;
        $this->active    = $active;
        $this->info      = $info;
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
     * @return object
     */
    public function getExpertise()
    {
        return $this->expertise;
    }

    /**
     * @param object $expertise
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

}
