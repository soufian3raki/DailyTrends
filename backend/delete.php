<!DOCTYPE html>
<html>

<head>

    <title>DailyTrends</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <?php
        include('functions.php');
        $id = null;
        if ( !empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }

        if ( null==$id ) {
            header("Location: ../index.php");
        } else {
            $pdo = Database::connect();

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM noticias where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $row = $q->fetch(PDO::FETCH_ASSOC);

            Database::disconnect();
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