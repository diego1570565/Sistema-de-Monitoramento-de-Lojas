<html>

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="icon" type="image/x-icon" href="img/ville_lg.png">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <style>

    .card-login {
        padding: 30px 0 0 0;
        width: 700px;
        margin: auto;
        margin-top: 50px;
    }

    body {
        background: lightgrey;
    }

    .form-container {
        background-color: #f7f7f7;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px #d9d9d9;
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h2 {
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
        border-radius: 0;
        border: none;
        border-bottom: 2px solid #ddd;
        padding: 15px;
        font-size: 13px;
        width: 100%;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="password"]:focus {
        border-bottom: 2px solid #4CAF50;
    }

    .form-group label {
        font-size: 14px;
        color: #333;
        margin-bottom: 10px;
    }

    .form-group button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 20px;
    }

    .form-group button:hover {
        background-color: #3e8e41;
    }

    .form-footer {
        text-align: center;
        margin-top: 30px;
    }

    .form-footer a {
        color: #333;
        text-decoration: none;
    }
    a{
        color:#fff;
        text-decoration:none;
    }
    a:hover{
        color:#fff;
        text-decoration:none;
    }

    </style>
    <body>
        <div class="bg-success">
            <div style="text-transform: uppercase; letter-spacing: .2rem; font-size: 15px;"
                class="py-3 pt-4 mb-4 bg-success text-light container text-center">
                <h3>
                    <a href="https://www.villefort.com.br/" target="_blank">
                        <img src="img/ville_lg.png" style="width:50px" alt="">
                        Login Monitoramento
                    </a>

                </h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5 mx-auto">
                    <div style="border:10px ;border-top-style:groove;border-left-style:ridge ;border-right-style:groove; border-bottom-style:ridge; background-color:#fff "  class="form-container">
                        <form action="Controller/valida_login.php" method="post">
                            <div class="form-group">
                                <label for="username">Login AD: </label>
                                <input autocomplete="off" type="text" id="username" name="user_login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password: </label>
                                <input autocomplete="off" type="password" name="pass_login" id="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-danger btn-lg">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="fixed-bottom py-2 bg-success text-light d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <span class='text-left col-6'>Copyright &copy; 2023  - Monitoramento Villefort</span>
                    <div  class="col-6 text-center sticky-bottom rounded bg-success text-light w-25"></div>
          
                </div>
            </div>
        </footer>
    </body>
</html>

<?php

if (!empty($_GET['msg']) && $_GET['msg'] != '') {
    $_SESSION['gerente'] = false;
    if ($_GET['msg'] == 'Nao_autenticado') {
        echo "<script>    Swal.fire({
        icon: 'error',
        title: 'ERRO',
        text: 'Usuario Sem autenticação!',
    })</script>";

    } else {

        echo "<script>    Swal.fire({
        icon: 'error',
        title: 'ERRO',
        text: 'Usuario ou senha Inválidos!',
    })</script>";

    }
}
?>