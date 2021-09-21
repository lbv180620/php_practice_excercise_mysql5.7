<?php

require_once('./Menu.php');

class Drink extends Menu
{
    /** @var string $magSize */
    private $magSize;

    /**
     * @param string $category
     * @param string $menu
     * @param string $magSize
     * @param int $price
     */
    public function __construct($category, $menu, $magSize, $price)
    {
        parent::__construct($category, $menu, $price);

        $this->magSize = $magSize;
    }

    /** @return array */
    public function getData()
    {
        $ary = [
            'category' => $this->category,
            'menu' => $this->menu,
            'magSize' => $this->magSize,
            'price' => $this->price,
        ];
        return $ary;
    }
}
