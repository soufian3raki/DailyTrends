<!DOCTYPE html>
<html>
    <head>
        <title>Nueva noticia</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body id="create">
        <main class="container pb-4">
            <?php include("header.php");?>
            
            <form action="functions.php" method="POST" id="form-create" enctype="multipart/form-data">
                <h1 class="display-5">Nueva noticia</h1>
                <p class="lead">Rellene la información deseada para publicar una nueva noticia.</p>
                <hr class="my-2">
        
                <div class="createForm">
                    <div class="form-group row">
                        <label for="new-title-input" class="col-sm-2 col-form-label">Título</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="new-title-input" name="title" placeholder="Título de la noticia" required>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="new-image-input" class="col-sm-2 col-form-label">Imagen</label>
                        <div class="col-sm-10">
                            <input type="file" id="new-image-input" name="imagen" accept="image/*" style="margin-top: 10px;">
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="new-publisher-input" class="col-sm-2 col-form-label">Autor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="new-publisher-input" name="publisher" placeholder="Redactor del artículo" required>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="new-source-input" class="col-sm-2 col-form-label">Periódico</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="new-source-input" name="source" placeholder="Periódico de la noticia">
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="new-text-input" class="col-sm-2 col-form-label">Texto</label>
                        <div class="col-sm-10">
                            <textarea rows="10" class="form-control" id="new-text-input" name="text" placeholder="Contenido de la noticia" required></textarea>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="reset" class="btn btnCrear float-right" onclick="history.back()">Cancelar</button>
                            <button type="submit" name="button" class="btn btnGreenCrear float-right mr-3">Publicar</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <?php include("footer.php");?>

    </body>

</html>
