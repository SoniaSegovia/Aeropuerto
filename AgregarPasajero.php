<?php
include('Config.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: Index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "Menu.php" ?>
    <title>Pasajeros</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <h3>Nuevo Pasajero</h3>
                <hr>
                <?php
                    if (isset($_POST['agregar'])) 
                    {
                        $nombres = $_POST['nombre'];
                        $apellidos = $_POST['apellido'];
                        $telefono = $_POST['telefono'];
                        $dui = $_POST['dui'];
                        $destino = $_POST['destino'];
                        $fecha = $_POST['fecha'];
                        $hora = $_POST['hora'];

                        $query = $conn->prepare("INSERT INTO pasajeros (nombres, apellidos, telefono, dui, destino, fecha, hora) 
                        VALUES (:nombres, :apellidos, :telefono, :dui, :destino, :fecha, :hora)");
                        $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
                        $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                        $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
                        $query->bindParam("dui", $dui, PDO::PARAM_STR);
                        $query->bindParam("destino", $destino, PDO::PARAM_STR);
                        $query->bindParam("fecha", $fecha, PDO::PARAM_STR);
                        $query->bindParam("hora", $hora, PDO::PARAM_STR);
                        $result = $query->execute();

                        if ($result) 
                        {
                            echo '<div class="alert alert-success" role="alert">Tu registro fue exitoso!</div>';
                        } 
                        else 
                        {
                            echo '<div class="alert alert-danger" role="alert">¡Algo salió mal!</div>';
                        }
                    }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombres:</label>
                        <input id="nombre" class="form-control" type="text" name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos:</label>
                        <input id="apellido" class="form-control" type="text" name="apellido">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <input id="telefono" class="form-control" type="text" name="telefono">
                    </div>

                    <div class="form-group">
                        <label for="dui">DUI:</label>
                        <input id="dui" class="form-control" type="text" name="dui">
                    </div>
                    
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <input id="destino" class="form-control" type="text" name="destino">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input id="fecha" class="form-control" type="text" name="fecha">
                    </div>

                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input id="hora" class="form-control" type="text" name="hora">
                    </div>

                    <br>

                    <div class="d-grid gap-1 col-6 mx-auto">
                        <button class="btn btn-primary" name="agregar" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>