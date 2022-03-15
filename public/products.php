<?php 
session_start();
require_once '../includes/header.php'; 
?>

<div>
    <h4>Cadastro de produtos</h4><hr>
    <?php 
    require_once '../forms/form-add-product.php'; 
    ?>
</div>

<?php require_once '../includes/footer.php' ?>
