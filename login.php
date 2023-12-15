<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>

    <div class="content">
        <form action="" method="POST">
            <h1>Login</h1>
            <div class="form-group">
                <label for="exampleInputEmail1">Endereço de E-mail</label>
                <input type="email" class="inputs required" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" name="email" oninput="validateEmail()">
                <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                <span class="span-required">Digite um email válido</span>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="inputs required" id="exampleInputPassword1" placeholder="Senha" name="senha" oninput="passwordValidate()">
                <span class="span-required">Deve ter no mínimo 8 caracteres</span>
            </div>
            <?php
            include('conexao.php');

            if (isset($_POST['email']) || isset($_POST['senha'])) {

                if (strlen($_POST['email']) == 0) {
                    echo '<div class="warning"> Preencha seu email </div>';
                } else if (strlen($_POST['senha']) == 0) {
                    echo '<div class="warning"> Preencha sua senha </div>';
                } else {
                    $email = $mysqli->real_escape_string($_POST['email']);
                    $senha = $mysqli->real_escape_string($_POST['senha']);

                    $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL " . $mysqli->error);

                    $quantidade = $sql_query->num_rows;

                    if ($quantidade == 1) {

                        $usuario = $sql_query->fetch_assoc();

                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['nome'] = $usuario['nome'];

                        header("Location: menu.php");
                    } else {
                        echo "<div class='warning'> Falha ao logar, e-mail ou senha incorretos</div>";
                    }
                }
            }
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button><br>

        </form>
        <a href="cadastro.php">Ainda não é cadastrado?</a>
    </div>

    <br>

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
            gap: 1rem;
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
            padding: 5px;
            margin: 0px;
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

</body>

<script>
    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required')
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        validateEmail();
        passwordValidate();
    });

    //adiciona borda vermelha de erro
    function setError(index) {
        campos[index].style.border = '2px solid #e63636';
        spans[index].style.display = 'block';
    }

    function removeError(index) {
        campos[index].style.border = '';
        spans[index].style.display = 'none';
    }

    function validateEmail() {
        if (!emailRegex.test(campos[0].value)) {
            setError(0);
        } else {
            removeError(0);
        }
    }

    function passwordValidate() {
        if (campos[1].value.length < 8) {
            setError(1);
        } else {
            removeError(1);
        }
    }
</script>

</html>