<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
	<link rel="stylesheet" href="assets/bootstrap.min.css" >
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
</head>
<body>

	<?php
	session_start();
	//Requisições de classes

	require_once("util/crud.class.php");
	require_once("util/util.class.php");
	require_once("user.php");
	

	$util = new Util();
	$user = new User();
	
	?>
	<!-- sessão do usuario -->
	<div class="container" id="cont" style="margin-top: 5%">
		<div style="float:right">
			<span><?=$_SESSION['login']?></span>
		</div>
		<div style="margin: 0px 0px ">
	<!-- botões de controle -->
		

			<a href="?acao=login" hidden><button class="btn btn-primary" type="submit">Login</button></a>
			<a href="?acao=list-active" ><button class="btn btn-success" >Usuarios ativos</button></a>
			<a href="?acao=list-all"><button class="btn btn-warning">Todos cadastrados</button></a>
			<a href="?acao=insert"><button class="btn btn-info">Cadastrar</button></a>
		</div>
		<div style="margin: 5% 0%">
			<?php 
			require_once("controller-user.php")
			?>
		</div>
	</div>


	

</body>
</html>