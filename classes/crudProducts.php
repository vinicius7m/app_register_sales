<?php

interface crudProducts {
    public function create();
    public function read();
    public function update($id, $name, $quantity, $price, $image);
    public function delete($id); 
}