<?php
session_start();
include "conexao.php";

if (
	isset($_POST['nome']) && isset($_POST['email'])
	&& isset($_POST['senha'])
) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$nome = validate($_POST['nome']);
	$email = validate($_POST['email']);

	$senha = validate($_POST['senha']);

	$user_data = 'nome=' . $nome . '&nome=' . $nome;

	//diz que o ema	il é necessário
	if (empty($email)) {
		header("Location: cadastro.php?error=Preencha seu E-mail&$user_data");
		exit();
		//diz que a senha é necessária
	} else if (empty($senha)) {
		header("Location: cadastro.php?error=A senha é obrigatória&$user_data");
		exit();
	}
	//diz que o nome é necessário
	else if (empty($nome)) {
		header("Location: cadastro.php?error=Coloque o seu nome&$user_data");
		exit();
	} else {
		//verifica se já existe algum usuário com o mesmo email inserido
		$sql = "SELECT * FROM usuario WHERE email='$email' ";
		$result = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($result) > 1) {
			header("Location: cadastro.php?error=O e-mail já está sendo utilizado, tente outro&$user_data");
			exit();
		} else {
			//insere os valores dentro do banco de dados
			$sql2 = "INSERT INTO usuario(nome, email, senha) VALUES('$nome', '$email', '$senha')";
			$result2 = mysqli_query($conexao, $sql2);
			if ($result2) {
				//avisa quando a conta foi registrada no banco
				header("Location: cadastro.php?success=Sua conta foi criada com sucesso!");
				exit();
			} else {
				//avisa se ocorrer algum erro durante a criação
				header("Location: cadastro.php?error=Ocorreu um erro durante a criação&$user_data");
				exit();
			}
		}
	}
} else {
	header("Location: cadastro.php");
	exit();
}
