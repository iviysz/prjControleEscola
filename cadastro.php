<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="content">
        <form action="cadastrar.php" method="POST">

            <h1>Cadastro</h1>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <div class="form-group">
                <label for="exampleInputNome">Nome Completo</label>
                <input type="text" class="inputs required" id="exampleInputNome1" placeholder="Seu nome" name="nome" onkeypress="return ApenasLetras(event,this);" oninput="nameValidate()">
                <span class="span-required">Deve ter no mínimo 3 caracteres</span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Endereço de E-mail</label>
                <input type="email" class="inputs required" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" name="email" oninput="validateEmail()">
                <span class="span-required">Digite um email válido</span>
            </div>

            <div class="form-group">
                <label for="exampleInputSenha1">Senha</label>
                <input type="password" class="inputs required" id="exampleInputSenha1" placeholder="Senha" name="senha" oninput="passwordValidate()">
                <span class="span-required">Deve ter no mínimo 8 caracteres</span>
            </div>

            <div class="form-group">
                <label for="exampleInputSenha2">Confirme sua Senha</label>
                <input type="password" class="inputs required" id="exampleInputSenha2" placeholder="Repita sua senha" name="senha2" oninput="comparePassword()">
                <span class="span-required">As senhas devem ser iguais</span>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button><br>
        </form>
        <a href="login.php" class="ca">Já tem uma conta?</a>
    </div>
    <br>

</body>

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
        width: 30%;
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
        padding: 8px 5px;
        outline: none;
        border-radius: 5px;
        background-color: var(--color-dark1);
        border: 2px solid var(--color-dark1);
        color: var(--color-white);
        width: 100%;
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

    .warning {
        color: var(--color-red);
    }

    @media screen and (max-width: 576px) {
        .box-select {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<!--Validando o form em javascript-->
<script>
    //reúne todos os elementos pela classe
    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required')
    //verifica se é um email válido 
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    //adiciona borda vermelha de erro
    function setError(index) {
        campos[index].style.border = '2px solid #e63636';
        spans[index].style.display = 'block';
    }

    function removeError(index) {
        campos[index].style.border = '';
        spans[index].style.display = 'none';
    }

    //valida o nome
    function nameValidate() {
        if (campos[0].value.length < 3) {
            setError(0);
        } else {
            removeError(0);
        }
    }

    //função para validar email
    function validateEmail() {
        if (!emailRegex.test(campos[1].value)) {
            setError(1);
        } else {
            removeError(1);
        }
    }

    //função para validar a senha
    function passwordValidate() {
        if (campos[2].value.length < 8) {
            setError(2);
        } else {
            removeError(2);
            comparePassword();
        }
    }

    //função para comparar se as senhas são iguais
    function comparePassword() {
        if (campos[2].value == campos[3].value && campos[3].value.length >= 8) {
            removeError(3);
        } else {
            setError(3);
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