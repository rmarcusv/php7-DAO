<?php 

	require_once("config.php");

/*	$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios;");

	echo json_encode($usuarios);*/

/*-----------------------------------------------------------*/

	// Carrega um único usuário
/*	$root = new Usuario();
	$root->loadbyId(1);
	echo $root;*/

/*-----------------------------------------------------------*/

/*	// Carrega uma lista de usuarios
	$lista = Usuario::getList(); // nã demanda instanciamento, por o método pertencer à classe, e não à instância
	echo json_encode($lista);*/

/*	// Carrega uma lista de usuarios buscando pelo login/*
	$search = Usuario::search("jo");
	echo json_encode($search);*/

/*-----------------------------------------------------------*/
	//login
/*	$usuario = new Usuario();
	$usuario->login("joao","qwerty");
	echo $usuario;*/

/*-----------------------------------------------------------*/
// cria novo usuário e o retorna
/*	$aluno = new Usuario("aluno", "senha"); // chama diretamente no construct

	$aluno->setDeslogin("aluno");
	$aluno->setDessenha("senha");

	$aluno->insert();

	echo $aluno;*/

/*-----------------------------------------------------------*/

// atualiza registro na tabela

/*$usuario = new Usuario();

$usuario->loadbyId(3);

$usuario->update("professor", "senha2");

echo $usuario;*/

/*-----------------------------------------------------------*/

// deleta registro ma tabela

$usuario = new Usuario();

$usuario->loadbyId(5);

$usuario->delete();

echo $usuario;

 ?>