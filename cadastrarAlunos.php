<?php
session_start();
include "conexao.php";

if (
	isset($_POST['matricula']) && isset($_POST['aluno'])
	&& isset($_POST['nota1']) && isset($_POST['nota2'])
) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$matricula = validate($_POST['matricula']);
	$aluno = validate($_POST['aluno']);
	$nota1 = validate($_POST['nota1']);
	$nota2 = validate($_POST['nota2']);

	$user_data = 'aluno=' . $aluno . '&aluno=' . $aluno;

	//diz que o aluno é necessário
	if (empty($aluno)) {

		header("Location: cadastroAlunos.php?error=Preencha o Nome do Aluno&$user_data");
		exit();
		//diz que a matrícula é necessária
	} else if (empty($matricula)) {
		header("Location: cadastroAlunos.php?error=A matrícula é obrigatória&$user_data");
		exit();
	}
	//diz que a nota é necessária
	else if (empty($nota1)) {
		header("Location: cadastroAlunos.php?error=Digite a primeira nota&$user_data");
		exit();
	} else if (empty($nota2)) {
		header("Location: cadastroAlunos.php?error=Digite a segunda nota&$user_data");
		exit();
	} else {
		//verifica se já existe algum usuário com a mesma matrícula
		$sql = "SELECT * FROM alunos WHERE matricula='$matricula' ";
		$result = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($result) > 1) {
			header("Location: cadastroAlunos.php?error=Já existe um aluno com essa matrícula$user_data");
			exit();
		} else {
			//insere os valores dentro do banco de dados
			$sql2 = "INSERT INTO alunos(matricula, aluno, nota1, nota2) VALUES('$matricula', '$aluno', '$nota1', '$nota2')";
			$result2 = mysqli_query($conexao, $sql2);
			if ($result2) {
				//avisa quando a conta foi registrada no banco
				header("Location: cadastroAlunos.php?success=Dados registrados no sistema!");
				exit();
			} else {
				//avisa se ocorrer algum erro durante a criação
				header("Location: cadastroAlunos.php?error=Ocorreu um erro durante o registro&$user_data");
				exit();
			}
		}
	}
} else {
	header("Location: cadastroAlunos.php");
	exit();
}
