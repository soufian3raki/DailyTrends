<!DOCTYPE html>
<html>

    <head>
        <title>Editar noticia</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <?php
            include('functions.php');
        
            // Si existe un valor para $_GET['id'], lo asignamos a $id
            $id = !empty($_GET['id']) ? $_GET['id'] : null;
        
            if ($id) {  // Si $id no es nulo, procesamos la consulta SQL
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                // Corregimos el error de sintaxis en la consulta SQL y añadimos límites máximos para proteger contra inyecciones SQL
                $sql = "SELECT * FROM noticias WHERE id = ? LIMIT 1";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $row = $q->fetch(PDO::FETCH_ASSOC);
        
                Database::disconnect();
        
                // Si no se encontraron resultados para el ID, redirigimos al usuario
                if (!$row) {
                    header("Location: ../index.php");
                    exit;  // Terminamos el script aquí para evitar cualquier procesamiento adicional
                }
            } else {  // Si $id es nulo, redirigimos al usuario
                header("Location: ../index.php");
                exit;
            }
        ?>
    </head>

    <body id="update">
        <main class="container pb-4">
            <?php include("header.php");?>

            <div class="">
                <h1 class="display-5">Editar noticia</h1>
                <p class="lead">Para terminar de editar la noticia, por favor haga click en el botón "Guardar".</p>
                <hr class="my-2">
                <form action="functions.php" method="post" id="form-update" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="news-title-input" class="col-sm-2 col-form-label">Título</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="news-title-input" name="title-update" value="<?php echo $row['title']?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="news-image-input" class="col-sm-2 col-form-label">Imagen</label>
                        <div class="col-sm-10">
                            <input type="file" id="news-image-input" name="image-update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="news-publisher-input" class="col-sm-2 col-form-label">Fuente</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="news-publisher-input" name="publisher-update" value="<?php echo $row['publisher']?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="news-source-input" class="col-sm-2 col-form-label">Periódico</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="news-source-input" name="source-update" value="<?php echo $row['source']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="news-text-input" class="col-sm-2 col-form-label">Texto</label>
                        <div class="col-sm-10">
                            <textarea rows="10" class="form-control" id="news-text-input" name="text-update" placeholder="Contenido de la noticia" required><?php echo $row['text']?></textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="reset" class="btn btnCrear btn-lg" onclick="history.back()">Cancelar</button>
                        <button type="submit" name="button-update" class="btn btnGreenCrear btn-lg">Guardar</button>
                    </div>
                    <input type="hidden" value="<?php echo $row['id']?>" name="id-update">
                </form>
            </div>
        </main>

        <?php include("footer.php");?>

    </body>

</html>