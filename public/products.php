<?php 
session_start();
require_once '../includes/header.php'; 
?>

<div>
    <h4>Cadastro de produtos</h4><hr>
    <?php 
    if(isset($_SESSION['success'])) {
        echo '<p class="alert alert-success">';
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        echo '</p>';
    } elseif(isset($_SESSION['error'])) {
        echo '<p class="alert alert-danger">';
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        echo '</p>';
    }
    require_once '../forms/form-add-product.php'; 
    ?>
</div>

<?php require_once '../includes/footer.php' ?>
