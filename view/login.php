
<?php
session_destroy();
?>
<form method="POST" class="form-group" >
        <label>Email:</label>
        <input type="text" name="email" style="margin-bottom:20px"/>
        <label>Senha:</label>
        <input type="password" name="senha" style="margin-bottom:20px"/>
      <button class="btn btn-outline-primary" style="margin:20px 0px;" name="entrar" type="submit">Entrar</button>
</form>


<?php

if(isset($_REQUEST['entrar'])){
    $user->login();
}