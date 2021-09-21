<?php

class TaiyakiProduct extends Taiyaki
{

    /** @var int $konaQuantity */
    private $konaQuantity;

    /** @var int $num */
    private $num;

    /**
     * @param string $konaType
     * @param string $annType
     * @param int $konaQuantity
     * @param int $num
     */
    public function __construct($konaType, $annType, $konaQuantity, $num)
    {
        parent::__construct($konaType, $annType);

        $this->konaQuantity = $konaQuantity;
        $this->num = $num;
    }

    /** @return string */
    public function bake()
    {
        return $this->konaQuantity . "グラムの" . $this->konaType . "を使って、" . $this->annType . "のたい焼きを" . $this->num . "個焼きました。";
    }
}
