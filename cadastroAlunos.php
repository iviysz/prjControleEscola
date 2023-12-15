<?php

include('protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Alunos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

  <div class="content">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="pills-home-tab" href="menu.php" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
      </li>
      <li class="nav-item">
        <a class="lista nav-link" id="pills-cadastro-tab" href="cadastroAlunos.php" role="tab" aria-controls="pills-contact" aria-selected="false">Cadastrar Alunos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-lista-tab" href="lialunos.php" role="tab" aria-controls="pills-profile" aria-selected="false">Listar Alunos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-logout-tab" role="tab" aria-controls="pills-contact" aria-selected="false" href="logout.php">Sair</a>
      </li>

    </ul>

    <br>
    <h1>Cadastro de Alunos</h1>
    <form action="cadastrarAlunos.php" method="POST">
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>

      <?php if (isset($_GET['success'])) { ?>
        <p class="success"><?php echo $_GET['success']; ?></p>
      <?php } ?>

      <div class="form-group">
        <label for="exampleInputNome1">Nome do Aluno</label><br>
        <input type="text" class="inputs required" id="exampleInputNome1" placeholder="Nome Completo" name="aluno" oninput="nameValidate()" onkeypress="return ApenasLetras(event,this);">
        <span class="span-required">Deve ter no mínimo 3 caracteres</span>
      </div>
      <div class="form-group">
        <label for="exampleInputMatricula1">Número de Matrícula</label><br>
        <input type="number" class="inputs required" id="exampleInputMatricula1" placeholder="Matrícula" name="matricula">
        <span class="span-required">Deve ser um valor numérico</span>
      </div>
      <div class="form-group">
        <label for="exampleInputNota1">Digite a Primeira Nota</label><br>
        <input type="number" step="0.01" class="inputs required" id="exampleInputNota1" placeholder="Primeira Nota" name="nota1">
        <span class="span-required">Digite uma nota válida</span>
      </div>
      <div class="form-group">
        <label for="exampleInputSnota">Digite a Segunda Nota</label><br>
        <input type="number" step="0.01" class="inputs required" id="exampleInputSnota1" placeholder="Segunda Nota" name="nota2">
        <span class="span-required">Digite uma nota válida</span>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
      <br><br>
  </div>
  </form>
  </div>

  <style type="text/css">
    :root {
      --color-white: #fff;
      --color-red: #e63636;
      --color-dark1: #181818;
      --color-dark2: #1e1e1e;
      --color-purple1: #9333FF;
      --color-purple2: indigo;
    }

    * {
      margin: 0;
      padding: 0;
    }

    .span-required {
      display: none;
    }

    body {
      background-color: var(--color-dark1);
      color: var(--color-white);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .content {
      background-color: var(--color-dark2);
      padding: 3rem;
      border-radius: 10px;
      width: 60%;
      overflow: auto;
    }

    h1 {
      margin-bottom: 1rem;
      text-align: center;
    }

    .content form {
      display: flex;
      flex-direction: column;

    }

    .inputs {
      align-items: center;
      padding: 8px 5px;
      outline: none;
      border-radius: 5px;
      background-color: var(--color-dark1);
      border: 2px solid var(--color-dark1);
      color: var(--color-white);
      width: 800px;
      box-sizing: border-box;
      transition: .3s;
    }

    .inputs:focus {
      border-color: var(--color-purple1);
    }

    button[type='submit'] {
      font-size: 1rem;
      outline: none;
      border: none;
      border-radius: 5px;
      margin-top: 1rem;
      background-color: var(--color-purple2);
      color: var(--color-white);
      transition: .3s;
    }

    button[type='submit']:hover {
      background-color: var(--color-purple1);
    }

    a {
      padding: 10px;
      margin: 0rem;
      outline: none;
      border: none;
      color: var(--color-white);
      color: inherit;
      text-decoration: none;
    }

    a:hover {
      color: var(--color-purple1);
    }

    a:active {
      color: var(--color-purple1);
    }

    .nav li a:hover {
      background: var(--color-purple2);
      color: #fff;
      box-shadow: 0 3px 10px 0 #CCC;
      -webkit-box-shadow: 0 3px 10px 0 #ccc;
      text-shadow: 0px 0px 5px #fff;
    }

    .lista {
      background-color: var(--color-purple1);
      box-shadow: 0 3px 10px 0 #CCC;
      -webkit-box-shadow: 0 3px 10px 0 #ccc;
    }

    @media screen and (max-width: 576px) {
      .box-select {
        flex-direction: column;
        gap: 5px;
      }
    }
  </style>

</body>

<script>
  const form = document.getElementById('form');
  const campos = document.querySelectorAll('.required');
  const spans = document.querySelectorAll('.span-required')

  function setError(index) {
    campos[index].style.border = '2px solid #e63636';
    spans[index].style.display = 'block';
  }

  function removeError(index) {
    campos[index].style.border = '';
    spans[index].style.display = 'none';
  }


  function nameValidate() {
    if (campos[0].value.length < 3) {
      setError(0);
    } else {
      removeError(0);
    }
  }

  function ApenasLetras(e, t) {
    try {
      if (window.event) {
        var charCode = window.event.keyCode;
      } else if (e) {
        var charCode = e.which;
      } else {
        return true;
      }
      if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 191 && charCode <= 255) || charCode == 32) {
        return true;
      } else {
        return false;
      }
    } catch (err) {
      alert(err.Description);
    }
  }
</script>

</html>