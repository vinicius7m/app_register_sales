<?php
    require_once '../includes/header.php';
?>

<form action="../database/products/update.php" method="POST" enctype="multipart/form-data">
    <input 
        type="hidden" 
        class="form-control mb-3" 
        name="id" 
        id="id" 
        value="<?php echo $values['id']; ?>"
    >
    <input 
        type="text" 
        class="form-control mb-3" 
        name="name" 
        id="name" 
        placeholder="Nome"
        required
        value="<?php echo $values['name']; ?>"
    >
    <input 
        type="number" 
        class="form-control mb-3" 
        name="quantity" 
        id="quantity"
        min="0"
        placeholder="Quantidade" 
        value="<?php echo $values['quantity']; ?>"
    >
    <input 
        type="number" 
        class="form-control mb-3" 
        name="price" 
        id="price" 
        min="0.01"
        step="0.01"
        placeholder="Preço"
        value="<?php echo $values['price']; ?>"
        required
    >
    <img width="300" src="../assets/images/upload/<?php echo $values['image']?>" alt="">
    <input 
        type="file" 
        class="form-control mb-3" 
        name="image" 
        id="image" 
        placeholder="Imagem"
        value="<?php echo $values['image']; ?>"
        accept="image/png, image/jpeg, image/gif"
    >

    <input 
        type="submit" 
        class="btn btn-primary"
    >
    <a href="home.php" class="btn btn-danger">Cancelar </a>
</form>

<?php
    require_once '../includes/footer.php';
?>