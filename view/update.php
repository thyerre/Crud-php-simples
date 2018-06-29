<?php 
$usuario = $user->getUsuario();

?>
<div style="width:50%;margin:2% 0%">
    <H3 style="margin:5% 0">Edição de usuario</H3>
    <form method="POST">
        <input type="hidden" class="form-control" name="id" id="id"  value="<?=$usuario->id?>" >
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" id="nome"  placeholder="Enter nome" value="<?=$usuario->nome?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?=$usuario->email?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input check-update" id="check" name="check">
            <label class="form-check-label">Tem certeza que deseja editar esse usuario</label>
        </div>
            <button type="submit" class="btn btn-primary bt-updade" onclick="return:false" name="bnt_edit">editar</button>
            <a href="?acao=list-all"<button type="submit" class="btn btn-dark">Home</button></a>
    </form>
</div>  

<?php

if(isset($_POST['bnt_edit'])){
    $user->update();
}