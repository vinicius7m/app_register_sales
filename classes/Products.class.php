<?php

require_once 'crudProducts.php';

class Products extends Connection implements crudProducts {
    private $id, $name, $quantity, $price, $image;

    // Setters
    protected function setId($id) {
        $this->id = $id;
    }
    protected function setName($name) {
        $this->name = $name;
    }
    protected function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    protected function setPrice($price) {
        $this->price = $price;
    }
    protected function setImage($image) {
        $this->image = $image;
    }

    // Getters
    protected function getId() {
        return $this->id;
    }
    protected function getName() {
        return $this->name;
    }
    protected function getQuantity() {
        return $this->quantity;
    }
    protected function getPrice() {
        return $this->price;
    }
    protected function getImage() {
        return $this->image;
    }

    // Métodos específicos
    public function formData($name, $quantity, $price, $image) {
        $this->setName($name);
        $this->setQuantity($quantity);
        $this->setPrice($price);
        $this->setImage($image);
    }

    // Métodos da interface
    public function create() {
        echo $this->getName();
        echo $this->getQuantity();
        echo $this->getPrice();
        echo $this->getImage();

    }
    public function read() {

    }
    public function update($id, $name, $quantity, $price, $image) {

    }
    public function delete($id) {

    }
}