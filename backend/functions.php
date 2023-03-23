<?php

// Conexión con la DB
class Database {
    private static $dbName = 'dailytrends' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if ( null == self::$cont ) {     
            try {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
            } catch(PDOException $e) {
                die($e->getMessage()); 
            }
        }
        return self::$cont;
    }
    public static function disconnect() {
        self::$cont = null;
    }
}

// Create
function createNews() {
    //Se conecta con la DB
    $pdo = Database::connect();
    //Se obtienen los datos del formulario
    $title = $_POST['title-create'];
    $publisher = $_POST['publisher-create'];
    $source = $_POST['source-create'];
    $text = $_POST['text-create'];
    //Se le da formato y extensión predeterminados a las imagenes subidas
    $q = $pdo->prepare('SELECT MAX(id) AS max_id FROM noticias');
    $q->execute();
    $invNum = $q -> fetch(PDO::FETCH_ASSOC);
    $id = $invNum['max_id'] + 1;
    
    $nameIMG = $_FILES['image-create']['name'];
    $route = $_FILES['image-create']['tmp_name'];
    $name = 'custom-'.$id.'.png';
	
	move_uploaded_file($route, 'img/'.$nameIMG);
    
    if(is_uploaded_file($route)){
        $image = "img/".$name;
        copy($route,$image);
    }
    //Query de creación
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO noticias(image,title,publisher,source,text) values ('".$image."','".$title."','".$publisher."','".$source."','".$text."')";
    
    $pdo->exec($sql);
    
    Database::disconnect();
    header("Location: ../index.php");
}

if(isset($_POST['button-create'])){
    createNews();
}

// Update
function updateNews() {
    //Se conecta con la DB
    $pdo = Database::connect();
    
    $id = $_POST['id-update'];
    $title = $_POST['title-update'];
    $publisher = $_POST['publisher-update'];
    $source = $_POST['source-update'];
    $text = $_POST['text-update'];
    
    //Se cambia la ruta a la imagen subida
    $nameIMG = $_FILES['image-update']['name'];
    $route = $_FILES['image-update']['tmp_name'];
    $name = 'custom-'.$id.'.png';
    
    if(is_uploaded_file($route)){
        $image = "img/".$name;
        copy($route,$image);
    }
    
    //Query update
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE noticias SET image = '".$image."',title = '".$title."',publisher = '".$publisher."',source = '".$source."',text = '".$text."' WHERE id = ".$id."";
    
    $pdo->exec($sql);
    
    Database::disconnect();
    header("Location: ../index.php");
}

if(isset($_POST['button-update'])){
    updateNews();
}

// Delete
function deleteNews() {
    //Se conecta con la DB
    $pdo = Database::connect();
    
    $id = $_POST['id-delete'];
    
    //query delete
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM noticias WHERE id = ".$id;
    
    $pdo->exec($sql);
    
    Database::disconnect();
    header("Location: ../index.php");
}

if(isset($_POST['button-delete'])){
    deleteNews();
}