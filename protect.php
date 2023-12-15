<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Faça Login</title>
</head>

<body>
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

        body {
            background-color: var(--color-dark1);
            color: var(--color-white);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        a {
            padding: 10px;
            margin: 0rem;
            outline: none;
            border: none;
            color: var(--color-purple1);
            text-decoration: none;
        }

        a:hover {
            color: var(--color-purple2);
        }

        a:active {
            color: var(--color-purple2);
        }
    </style>
</body>

</html>


<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("<p>Você deve estar logado para continuar,<a href=\"login.php\">Entrar</a></p>");
}

?>