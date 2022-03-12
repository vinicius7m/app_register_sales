<?php
session_start();
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

    public function upload($image) {
        
    }

    // Métodos da interface
    public function create() {
        $name = $this->getName();
        $quantity = $this->getQuantity();
        $price = $this->getPrice();
        $image = $this->getImage();

        if($image != null) {
            $this->upload($image);
        }

        $connection = $this->connect();

        $sql = "insert into products values(default, :name, :quantity, :price, :image)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);

        if($stmt->execute()) {
            $_SESSION['success'] = "Cadastrado com sucesso!";
            $destiny = header('Location: ../../public/products.php');
        } else {
            $_SESSION['error'] = "Ocorreu um erro no cadastro do produto!";
            $destiny = header('Location: ../../public/products.php');
        }

    }
    public function read() {

    }
    public function update($id, $name, $quantity, $price, $image) {

    }
    public function delete($id) {

    }
}