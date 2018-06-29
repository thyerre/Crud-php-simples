<?php
$usuario = $user->getUsuario();
$user->delete();

?>

<div class="card" style="width: 18rem;margin: 0px 10%">
  <div class="card-body">
  
    <h6 class="card-subtitle mb-2 text-muted"><?=$usuario->nome?></h6>
    <p class="card-text"><?=$usuario->email?></p>
</div>
</div>
<div style='margin: 20px 10% '>
    <div class="alert alert-success" role="alert" style='width:32.5% '>
        Usuario deletado!
        <a href="?acao=list-all" <button class="btn btn-primary" type="submit" style='margin-left:20px;'>Voltar</button></a>
    </div>
</div>

<?php

