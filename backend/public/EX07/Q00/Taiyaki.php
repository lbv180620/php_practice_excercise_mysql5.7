<?php

class Taiyaki
{
    /** @var string */
    protected $konaType;

    /** @var string */
    protected $annType;

    /**
     * @param string $konaType
     * @param string $annType
     */
    public function __construct($konaType, $annType)
    {
        $this->konaType = $konaType;
        $this->annType = $annType;
    }

    /** @return string */
    public function bake()
    {
        return $this->konaType . "を使って、" . $this->annType . "のたい焼きを焼きました。";
    }

    public function getKonaType()
    {
        return $this->konaType;
    }

    public function setKonaType($konaType)
    {
        $this->konaType = $konaType;
    }

    public function getAnnType()
    {
        return $this->annType;
    }

    public function setAnnType($annType)
    {
        $this->annType = $annType;
    }
}
