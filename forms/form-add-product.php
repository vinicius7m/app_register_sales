<?php
    require_once '../includes/header.php';
?>

<form action="../database/products/create.php" method="POST">
    <input 
        type="hidden"
        name="id"
        id="id"
    >
    <input 
        type="text" 
        class="form-control mb-3" 
        name="name" 
        id="name" 
        placeholder="Nome"
        required
    >
    <input 
        type="number" 
        class="form-control mb-3" 
        name="quantity" 
        id="quantity"
        min="0"
        placeholder="Quantidade" 
    >
    <input 
        type="number" 
        class="form-control mb-3" 
        name="price" 
        id="price" 
        min="0.01"
        step="0.01"
        placeholder="Preço"
        required
    >
    <input 
        type="file" 
        class="form-control mb-3" 
        name="image" 
        id="image" 
        placeholder="Imagem"
        accept="image/png, image/jpeg"
    >

    <input 
        type="submit" 
        class="btn btn-primary"
    >
    <input 
        type="reset"
        class="btn btn-danger"
        value="Cancelar"
    >
</form>

<?php
    require_once '../includes/footer.php';
?>