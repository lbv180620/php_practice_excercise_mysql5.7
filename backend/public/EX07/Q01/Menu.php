<?php

class Menu
{
    /** @var string $category */
    protected $category;

    /** @var string $menu */
    protected $menu;

    /** @var int $price */
    protected $price;

    /**
     * @param string $category
     * @param string $menu
     * @param int $price
     */
    public function __construct($category, $menu, $price)
    {
        $this->category = $category;
        $this->menu = $menu;
        $this->price = $price;
    }

    /** @return array */
    public function getData()
    {
        $ary = [
            'category' => $this->category,
            'menu' => $this->menu,
            'price' => $this->price,
        ];
        return $ary;
    }
}
