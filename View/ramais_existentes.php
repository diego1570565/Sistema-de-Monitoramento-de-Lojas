<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento - Ramais Existentes</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-dark">

<div class="container-fluid  table table-dark text-light  p-3">
       <h1 class="ml-5 text-center" style="font-weight: lighter;">Ramais Existentes</h1>
</div>


<div class="container">
  <form method="post">

    <input type="text"  style="width: 1000px ;" class="form-control m-3" placeholder="Digite o Ramal" name="ramais" id="ramais">
    <input type="submit" style="width: 300px ;" class="btn m-3 btn-success" value="Buscar">

  </form>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col text-center">Lista de Ramais</th>
    </tr>
  </thead>
  <tbody>


<?php

require '../Controller/conexao.php';

$a = true;
$trouxe = false;

if (!empty($_POST['ramais'])) {
    $query = "select number from ramais_sip where number = " . $_POST['ramais'] . " ORDER BY number";
    $trouxe = true;
} else {
    $query = "select number from ramais_sip ORDER BY number";
    $a = false;
}

if ($result = $conn_asterisk->query($query)) {

    while ($row = $result->fetch_assoc()) {

        if ($a == true) {



            if ($trouxe == false) {
                echo '<tr><td> ' . $row['number'] . '</td></tr>';
            } 
            
            else {


                echo '<tr><td class="bg-success"> ' . $row['number'] . '</td></tr>';
                

            }


        }
             
      $a = true;
    }

    
}

?>

</tbody>
</table>
</div>
</body>