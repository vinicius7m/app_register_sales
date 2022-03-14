<?php

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);
$image = $_FILES['image'];

require_once '../../classes/autoload.php';

$update = new Products();
$update->update($id, $name, $quantity, $price, $image);

?>