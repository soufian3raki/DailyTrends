<?php

// Clase para la conexión con la base de datos
class Database {

    // Variables privadas con las credenciales de la base de datos
    private static $dbName = 'dailytrends';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    
    // Única instancia de la clase (singleton)
    private static $cont = null;

    // Constructor privado para evitar instancias
    public function __construct() {
        die('Esta clase no se puede instanciar.');
    }

    // Conectarse a la base de datos (singleton)
    public static function connect() {
        if (null == self::$cont) {     
            try {
                // Crear una nueva instancia de PDO si aún no ha sido creada
                self::$cont = new PDO(
                    "mysql:host=" . self::$dbHost . ";" .
                    "dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbUserPassword
                );
            } catch(PDOException $e) {
                // En caso de un error, mostrar el mensaje de error y detener la ejecución del script
                die($e->getMessage()); 
            }
        }
        // Devolver la única instancia de la clase, ya sea recién creada o existente
        return self::$cont;
    }

    // Desconectar de la base de datos
    public static function disconnect() {
        // Establecer la única instancia de la clase como nula para desconectar de la base de datos
        self::$cont = null;
    }
}

// Función para crear una noticia
function crearNoticia() {
    $pdo = Database::connect(); // Conexión a la base de datos
    $title = $_POST['title']; // Título de la noticia enviado por el formulario
    $publisher = $_POST['publisher']; // Editor de la noticia enviado por el formulario
    $source = $_POST['source']; // Fuente de la noticia enviada por el formulario
    $text = $_POST['text']; // Texto de la noticia enviado por el formulario
    
    try {
        $pdo->beginTransaction(); // Iniciar transacción para ejecutar múltiples consultas SQL en una sola operación

        // Obtener el ID máximo de las noticias existentes en la tabla
        $stmt = $pdo->prepare('SELECT MAX(id) AS max_id FROM noticias');
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row['max_id'] + 1;

        $name = $_FILES['imagen']['name']; // Nombre del archivo de imagen enviado por el formulario
        $route = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo de imagen cargado
        // Se establece el nombre personalizado de la imagen y su ruta final
        $name = 'imagen-'.$id.'.png'; // Nombre único para la imagen personalizada basado en el ID de la noticia
        $image = "img/" . $name;

        // Si la ruta es un archivo válido, mover la imagen cargada a la carpeta "img" del servidor y actualizar la ubicación de la imagen
        if(is_uploaded_file($route)){
            move_uploaded_file($route, $image);
            $image_adg = 'backend/'.$image;
            //copy($route,$image);
        }

        // Insertar una nueva fila en la tabla "noticias" con los valores proporcionados y la ubicación de la imagen actualizada
        /*$stmt = $pdo->prepare('INSERT INTO noticias(image, title, publisher, source, text) VALUES (:image, :title, :publisher, :source, :text)');
        $stmt->bindParam(':image', $imagePath);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':publisher', $publisher);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':text', $text);
        $stmt->execute();*/
        
        $stmt = $pdo->prepare('INSERT INTO noticias(image, title, publisher, source, text) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$image_adg, $title, $publisher, $source, $text]);

        $pdo->commit(); // Confirmar la transacción

        header("Location: ../index.php"); // Redirigir al usuario a la página principal después de crear la noticia
    } catch (Exception $e) {
        $pdo->rollBack(); // Deshacer cualquier cambio en la base de datos si se produce una excepción durante la transacción
        throw $e; // Lanzar la excepción para que sea manejada por el controlador
    } finally {
        Database::disconnect(); // Cerrar la conexión a la base de datos
    }
}

if(isset($_POST['button'])){
    crearNoticia();
}

// UpdateNews
function updateNews() {
    
    // Se establece la conexión con la base de datos
    $pdo = Database::connect();
    
    // Se obtienen los datos para la actualización de la noticia desde el formulario HTML
    $id = $_POST['id-update'];
    $title = $_POST['title-update'];
    $publisher = $_POST['publisher-update'];
    $source = $_POST['source-update'];
    $text = $_POST['text-update'];
    
    // Se obtiene el nombre y la ruta temporal de la imagen a subir
    $nameIMG = $_FILES['image-update']['name'];
    $route = $_FILES['image-update']['tmp_name'];

    // Se establece el nombre personalizado de la imagen y su ruta final
    $name = 'imagen-' . $id . '.png';
    $image = "img/" . $name;
    $image_adg = 'backend/'.$image;
    
    // Se comprueba que la imagen no sea vacía para evitar errores
    if (empty($nameIMG) || empty($route)) {
        //throw new Exception("Error: imagen no adjunta.");
        $image_adg = null;
    }
    
    // Se mueve la imagen temporal a su ruta final
    /*if (!move_uploaded_file($route, $image)) {
        throw new Exception("Error: no se pudo cargar la imagen.");
    }*/
    
    // Se prepara la consulta SQL para actualizar la noticia según su ID
    $stmt = $pdo->prepare("UPDATE noticias SET image = ?, title = ?, publisher = ?, source = ?, text = ? WHERE id = ?");
    $stmt->execute([$image_adg, $title, $publisher, $source, $text, $id]);
    
    // Se redirige al usuario a la página principal
    header("Location: ../index.php");
}

if(isset($_POST['button-update'])){
    updateNews();
}

// Delete
function deleteNews() {
    // Se establece la conexión con la base de datos
    $pdo = Database::connect();
    
    // Se obtiene el ID de la noticia a eliminar desde el formulario HTML enviado por POST
    $id = $_POST['id-delete'];
    
    // Se prepara y ejecuta la consulta SQL para eliminar la noticia según su ID
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    
    // Se cierra la conexión con la base de datos
    Database::disconnect();
    
    // Se redirige al usuario a la página principal
    header("Location: ../index.php");
}

// Se verifica si el botón de eliminación ha sido presionado
if(isset($_POST['button-delete'])){
    deleteNews();
}
