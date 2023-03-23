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

<body id="read">
    <main class="container pb-4">
        <?php include("header.php");?>
        <div class="row pt-4">
            <div class="col-12 pb-2"><?php echo "<h1>".$row['title']."</h1>"; ?></div>
        </div>
        
        <div class="row align-items-center ">
            <div class="d-grid">
                <span class="articleDetails  btn-block"><?php echo "<small>".$row['source']." | ".$row['publisher']."</small>"; ?></span>
            </div>
            <div class="btn-group">
                <a href="delete.php?id=<?php echo $row['id']?>" class="btn btnBorrar btn-lg">Eliminar</a>
                <a href="update.php?id=<?php echo $row['id']?>" class="btn btnEditar btn-lg">Editar</a>
            </div>
        </div>
        
        <hr>

        <div class="row pt-4">
            <div class="col-md-12 col-lg-12">
                <div class="col-12 pb-4"><?php echo "<img src='../".$row['image']."' style='width:100%;'>"; ?></div>
                <div class="col-12"><?php echo "<p>".$row['text']."</p>"; ?></div>
            </div>
        </div>
    </main>

    <?php include("footer.php");?>

</body>

</html>