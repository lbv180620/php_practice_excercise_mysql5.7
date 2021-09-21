<?php

require_once('./Menu.php');

class Noodle extends Menu
{
    /** @var string $noodleHardness */
    private $noodleHardness;

    /**
     * @param string $category
     * @param string $menu
     * @param string $noodleHardness
     * @param int $price
     */
    public function __construct($category, $menu, $noodleHardness, $price)
    {
        parent::__construct($category, $menu, $price);

        $this->noodleHardness = $noodleHardness;
    }

    /** @return array */
    public function getData()
    {
        $ary = [
            'category' => $this->category,
            'menu' => $this->menu,
            'noodleHardness' => $this->noodleHardness,
            'price' => $this->price,
        ];
        return $ary;
    }
}
