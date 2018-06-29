
<form method="POST" class="form-group" style="width:50%;">
	<legend style="margin-bottom:20px">Cadastrar</legend>
	<label for="">Nome:</label>
	<input type="text" id="nome" name="nome" class="form-control">
	<label for="">Email:</label>
	<input type="text" name="email" id="email" class="form-control">
	<label for="">Senha:</label>
	<input type="password" id="senha" name="senha" class="form-control">
	<br/>
	<button type="submit" return="false" class="alert alert-success" onclick="return:false" role="alert" >Cadastrar</button>
</form>
<?php
if(isset($_POST['nome'])){
	$user->insert();
}