<!DOCTYPE html>
<html>

<head>

    <title>DailyTrends</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <?php
        include('functions.php'); // incluye archivo functions.php que contiene la conexión a la base de datos
        
        $id = null; // inicializa variable $id en nulo
        
        if (!empty($_GET['id'])) { // si existe una variable id en la URL
            $id = $_REQUEST['id']; // asignar valor de id a la variable $id
        }
        
        if (!is_numeric($id) || $id <= 0) { // si $id está vacío, redireccionar al usuario a la página principal
            header("Location: ../index.php");
        } else { // si $id no está vacío
            $pdo = Database::connect(); // conectarse a la base de datos utilizando la clase Database
        
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // establece el modo de error de captura de excepción
            $sql = "SELECT * FROM noticias where id = ?"; // SQL query para seleccionar todas las columnas de la tabla noticias donde el id coincida con la variable $id
            $q = $pdo->prepare($sql); // prepara la consulta
            $q->execute(array($id)); // ejecuta la consulta con el valor de la variable $id
            $row = $q->fetch(PDO::FETCH_ASSOC); // obtiene la fila como un array asociativo
        
            Database::disconnect(); // desconectarse de la base de datos
        }
    ?>

</head>

<body id="delete">

    <main class="container pb-4">
        <?php include("header.php");?>

        <div class=" py-4 mt-5">
            <h1 class="display-5">Eliminar noticia</h1>
            <p class="lead">Está a punto de eliminar la noticia: <b><?php echo $row['title']; ?></b>. <br>
                Esta acción no se puede deshacer. ¿Continuar?</p>
            <hr class="my-2">

            <form class="pt-4" action="functions.php" method="post" id="form-update" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="btn-group">
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btnBorrar btn-lg">Eliminar</button>
                        <button type="reset" class="btn btnCrear btn-lg" onclick="history.back()">Cancelar</button>
                    </div>
                </div>

                <!-- Modal Borrar Noticia -->
                <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-modal">¡Úlitmo aviso!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Una vez eliminado no se podrán recuperar los datos. ¿Desea continuar?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btnCrear" data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="button-delete" class="btn btnBorrar">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $row['id']?>" name="id-delete">
            </form>
        </div>
    </main>

	<?php include("footer.php");?>

</body>

</html>