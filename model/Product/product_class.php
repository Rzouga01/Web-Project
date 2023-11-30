<?php


class Product {

private $id;
private $name;
private $price;
private $description;


public function __construct($id, $name,$description) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    

}
public function getId() {
    return $this->id;
}
public function getName() {
    return $this->name;
}
public function getPrice() {
    return $this->price;
}
public function getDescription() {
    return $this->description;
}
public function setName($name)
{
    $this->name = $name;
}
public function setDescription($description)
{
    $this->description = $description;
}
public function setprice($price)
{
    $this->price = $price;
}



}