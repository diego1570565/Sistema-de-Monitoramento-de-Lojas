<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></>
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
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    </style>
</head>

<body>
    </nav>
    <body>
        <div class="bg-dark">
            <div style="text-transform: uppercase; letter-spacing: .2rem; font-size: 30px;" class="py-4 mb-4 bg-dark text-light container text-center">
                <h3>Login Monitoramento</h3>
            </div>
        </div>
        <div class="mt-5 container-fluid">
            <div class="row justify-content-center ">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="container">
                            <div class="row justify-content-center">
                                <form style="width:600px" action="PHP/valida_login.php" method="POST">
                                    <div class="form-group">
                                        <input name="user_login" type="text" class="mb-5 p-3 form-control"
                                            placeholder="Login">
                                    </div>
                                    <div class="form-group input-group mb-4">
                                        <input name="pass_login" type="password" id="senha" class="p-3 form-control"
                                            placeholder="Senha">
                                        <span onclick='ver()' class="input-group-text" id="basic-addon2">
                                            <img id="img-olho" src="img/pngwing.com (1).png" width="32px" alt="">
                                        </span>
                                    </div>
                                    <button class="btn btn-lg p-3 btn-info btn-block" type="submit">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function ver() {
            if ($('#img-olho').attr('src') == ('img/pngwing.com.png')) {
                $('#img-olho').attr('src', 'img/pngwing.com (1).png')
            } else {
                $('#img-olho').attr('src', 'img/pngwing.com.png')
            }
            if ($('#senha').attr('type') == ('password')) {
                $('#senha').attr('type', 'text')
            } else {
                $('#senha').attr('type', 'password')
            }
        }
    </script>
</html>
<?php
if (!empty($_GET['msg']) && $_GET['msg'] != '') {
    if ($_GET['msg'] == 'Nao_autenticado') {
        $_GET['msg'] = 'Usuario não autenticado, Favor fazer login';
    }
    if ($_GET['msg'] == 'Usuario_ou_Senha_Incorretos') {
        $_GET['msg'] = 'Usuario ou senha Inválidos';
    }
    if ($_GET['msg'] == 'Senha_vazia') {
        $_GET['msg'] = 'Usuario ou senha Inválidos';
    }
    echo '<script> alert("' . $_GET['msg'] . '") </script>';
}

?>