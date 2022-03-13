<?php

require_once '../../classes/autoload.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);
$image = $_FILES['image'];

$product = new Products();
$product->formData($name, $quantity, $price, $image); 
$product->create();
