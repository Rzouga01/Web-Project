<?php


class Product
{

    private $name;
    private $price;
    private $image;
    private $description;
    private $category;


    public function __construct($name, $price, $image, $description, $category)
    {

        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->category = $category;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getCategory()
    {
        return $this->category;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    public function setprice($price)
    {
        $this->price = $price;
    }
}
