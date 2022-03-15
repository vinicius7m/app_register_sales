<?php 

require_once '../includes/header.php';
require_once '../classes/autoload.php';
?>
<h4>Tabela de produtos</h4><hr>

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
?>

<table class="table table-responsive table-hover">
  <thead>
    <tr>
      <th scope="col">Preview</th>
      <th scope="col">Nome</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Preço</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
        require_once '../database/products/read.php';
    ?>
  </tbody>
</table>


<?php require_once '../includes/footer.php' ?>
