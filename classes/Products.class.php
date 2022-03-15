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

    public function tableData($id) {
        $connection = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "select * from products where id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $_id);
        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach($result as $values) {
            require_once '../forms/form-edit-product.php';
        }
    }

    public function upload($image) {            
        if($image['error']) {
            //$_SESSION['error'] = "Falha ao enviar o arquivo";
            die("Falha ao enviar o arquivo");
            //$destiny = header('Location: ../../public/products.php');
            
        }
    
        if($image['size'] > 2097152) {
            //$_SESSION['error'] = "Erro no upload! Arquivo grande (MAX: 2 MB)";
            die("Erro no upload! Arquivo grande (MAX: 2 MB)");
            //$destiny = header('Location: ../../public/products.php');

        }
        $folder = "../../assets/images/upload/";
        $imageName = $image['name'];
        $newImageName = uniqid();
        $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    
        if($extension != "jpg" && $extension != "png"){
            die("Tipo de arquivo não aceito");
        }
    
        move_uploaded_file($image['tmp_name'], $folder . $newImageName . ".". $extension);
        $image = $newImageName . "." . $extension;
        return $image;
        
    }

    // Métodos da interface
    public function create() {
        $name = $this->getName();
        $quantity = $this->getQuantity();
        $price = $this->getPrice();
        $image = $this->getImage();

        if($image['name'] != "") {
            $image = $this->upload($image);
        } else {
            $image = "";
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
            $destiny = header('Location: ../../public/home.php');
        } else {
            $_SESSION['error'] = "Ocorreu um erro no cadastro do produto!";
            $destiny = header('Location: ../../public/home.php');
        }

    }
    public function read() {
        $connection = $this->connect();

        $sql = "select * from products";
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        
        foreach($result as $values) {
            $this->setId($values['id']);
            $this->setName($values['name']);
            $this->setQuantity($values['quantity']);
            $this->setPrice($values['price']);
            $this->setImage($values['image']);

            $_id = $this->getId();
            $_name = $this->getName();
            $_quantity = $this->getQuantity();
            $_price = number_format($this->getPrice(), 2, ',', '.');
            $_image = $this->getImage();
            
            if($_image == null) {
                echo "<tr>";
                echo "<td>Imagem não disponível</td>";
                echo "<td>$_name</td>";
                echo "<td>$_quantity</td>";
                echo "<td>R$ $_price</td>";
                echo "<td><a href=\"edit-product.php?id=$_id\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Editar</a></td>";
                echo "<td><a href=\"../database/products/delete.php?id=$_id\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Excluir</a></td>";
                echo "<td><a href=\"products.php\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-user-plus\" aria-hidden=\"true\"></i> Cadastrar produto</a></td>";
                echo "</tr>";
            } else {
                echo "<tr>";
                echo "<td><img width=\"30\" src=\"../assets/images/upload/$_image\"></td>";
                echo "<td>$_name</td>";
                echo "<td>$_quantity</td>";
                echo "<td>R$ $_price</td>";
                echo "<td><a href=\"edit-product.php?id=$_id\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Editar</a></td>";
                echo "<td><a href=\"../database/products/delete.php?id=$_id\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Excluir</a></td>";
                echo "<td><a href=\"products.php\" class=\"btn btn-link btn-sm\"><i class=\"fa fa-user-plus\" aria-hidden=\"true\"></i> Cadastrar produto</a></td>";
                echo "</tr>";        
            }
            
        }
    }
    public function update($id, $name, $quantity, $price, $image) {
        $connection = $this->connect();

        $this->setId($id);
        $this->setName($name);
        $this->setQuantity($quantity);
        $this->setPrice($price);
        $this->setImage($image);

        $id = $this->getId();
        $name = $this->getName();
        $quantity = $this->getQuantity();
        $price = $this->getPrice();
        $image = $this->getImage();

        if($image['name'] != "") {
            $image = $this->upload($image);

            $sql = "update products set name = :name, quantity = :quantity, price = :price, image = :image where id = :id";
            $stmt = $connection->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);

            $stmt->execute();

            $_SESSION['success'] = "Atualizado com sucesso!";
            $destiny = header("Location: ../../public/home.php");
        } else {
            $sql = "update products set name = :name, quantity = :quantity, price = :price where id = :id";
            $stmt = $connection->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);

            $stmt->execute();

            $_SESSION['success'] = "Atualizado com sucesso!";
            $destiny = header("Location: ../../public/home.php");
        }
    }
    public function delete($id) {
        $connection =  $this->connect();
        
        $this->setId($id);
        $_id = $this->getId();

        $sql = "delete from products where id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $_id);
        $stmt->execute();

        $destiny = header('Location: ../../public/home.php');
    }
}