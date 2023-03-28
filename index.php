<!DOCTYPE html>
<html>
    <head>

        <title>Daily Trends</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <?php 
            error_reporting(0);
            include("backend/functions.php");
            include("backend/simple_html_dom.php");
        ?>
    </head>

    <body>
        <main class="container p-5 my-5 border">
            <?php include("backend/header.php");?>
            <?php include("backend/menu.php");?>
            <!--  ╔════════════════════════════════════════════════════════════════════════════════════════╗-->
            <!--  ║ /// .                               EL MUNDO                                 . ///     ║ -->
            <!--  ╚════════════════════════════════════════════════════════════════════════════════════════╝ -->
            <div  id="elmundo">
                <div class="sectionTitle row pt-4">
                    <div class="col-12">
                        <h2 class="newspaperTitle">El Mundo</h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                <?php
                    $html = file_get_html('https://www.elmundo.es'); // Obtiene el contenido HTML de la página principal
                    $news_content = $html->find('div[class=ue-c-cover-content__body]'); // Encuentra todos los elementos div que tienen la clase "ue-c-cover-content__body"
                    $articles_output = ''; // Inicializa la variable $articles_output, que contendrá la salida final de los artículos
                    
                    foreach($news_content as $index => $news_res) { // Itera a través de cada elemento encontrado en el paso anterior
                        if ($index >= 6) { break; } // Sale del bucle después del sexto elemento
                        
                        $article_title = $news_res->find("a[class=ue-c-cover-content__link]",0); // Encuentra el primer enlace con la clase "ue-c-cover-content__link" dentro del elemento actual
                        $article_publisher = $news_res->find(".ue-c-cover-content__byline-name", 0); // Encuentra el primer elemento con la clase "ue-c-cover-content__byline-name" dentro del elemento actual
                        $article_source = $news_res->find(".ue-c-cover-content__byline-location", 0); // Encuentra el primer elemento con la clase "ue-c-cover-content__byline-location" dentro del elemento actual
                            
                        $html_img = file_get_html($article_title->href); // Obtiene el contenido HTML desde la URL del artículo actual
                        $article_image = $news_res->find("div.ue-c-cover-content__media figure picture img",0); // Encuentra la primera imagen dentro del elemento actual
                        
                        $article_output = '<div class="card" style="width: 18rem;">
                                                <img src="img/elmundo_logo.jpg" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title">'.$article_title.'</h5>
                                                    <p class="card-text">'.$article_publisher->outertext.'</p>
                                                    <a href="'.$article_title->href.'" class="btn btn-primary">Ver noticia</a>
                                                </div>
                                            </div>'; // Crea la variable $article_output que contiene la salida HTML de cada artículo
                        
                        if($index == 3) { // Agrega un cierre y abrir de div después del cuarto artículo
                            $articles_output .= '</div><div class="d-flex justify-content-between">';
                        }
                        $articles_output .= $article_output; // Agrega la salida de cada artículo a la variable $articles_output
                    }
                    echo $articles_output; // Imprime la salida final de todos los artículos
                    $html->clear(); // Limpia el objeto DOM para liberar memoria
                    unset($html); // Elimina la referencia al objeto DOM
                    $html_img->clear(); // Limpia el objeto DOM que contiene las imágenes
                    unset($html_img); // Elimina la referencia al objeto DOM que contiene las imágenes
                ?>
                </div>
            </div>
            <!--  ╔════════════════════════════════════════════════════════════════════════════════════════╗-->
            <!--  ║ /// .                                EL PAIS                                 . ///     ║ -->
            <!--  ╚════════════════════════════════════════════════════════════════════════════════════════╝ -->
            <div id="elpais">
                <div class="sectionTitle row pt-4">
                    <div class="col-12">
                        <h2 class="newspaperTitle">El País</h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                <?php
                    // Se obtiene el contenido HTML de la página "elpais.com" y se guarda en la variable "$html2".
                    $html2 = file_get_html('https://elpais.com/');
                    
                    // Se seleccionan los elementos del HTML que tengan la clase ".c-d" y se guardan en la variable "$news_content2".
                    $news_content2 = $html2->find('.c-d');
                    
                    // Se inicializa un contador a 1.
                    $j = 1;
                    
                    // Se itera sobre cada uno de los elementos encontrados anteriormente.
                    foreach($news_content2 as $news_res2) {
                        
                        // Seleccionamos el título del artículo, su enlace, el autor y el cuerpo del texto.
                        $article_title_elpais = $news_res2->find("h2[class=c_t]",0);
                        $article_link_elpais = $news_res2->find("h2[class=c_t] a",0);
                        $article_publisher_elpais = $news_res2->find(".c_a_a",0);
                        $article_src = $news_res2->find("p[class=c_d]",0);
                        $article_image_elpais = $news_res2->find("div.b_col article figure a img",0);
                    
                        // Si el contador es igual a 4, se imprime un div de cierre y otro de apertura para separar las noticias.
                        if($j == 4){
                            echo '</div><div class="d-flex justify-content-between">';
                        }
                    
                        // Si el contador es menor o igual a 6, se imprime una noticia.
                        if($j<=6){
                    
                            // Si no se encuentra el enlace del artículo, se resta 1 al contador para saltarse esta noticia.
                            if(($article_link_elpais)==null)
                            {
                                $j--;
                            } 
                            // Si no se encuentra la imagen del artículo, se imprime la noticia sin la imagen.
                            else if($article_image_elpais==null) {
                    
                                echo <<<HTML
                                    <div class="card" style="width: 18rem;">
                                        <img src="img/elpais_logo.png" class="card-img-top" alt="" style="width: 200px;margin: 43px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{$article_title_elpais}</h5>
                                            <p class="card-text">{$article_publisher_elpais->outertext}</p>
                                            <a href="{$article_link_elpais->href}" class="btn btn-primary">Ver noticia</a>
                                        </div>
                                    </div>
                                HTML;
                            }
                            // En cualquier otro caso, se imprime la noticia con la imagen.
                            else {
                                echo <<<HTML
                                    <div class="card" style="width: 18rem;">
                                        <img src="{$article_image_elpais->src}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{$article_title_elpais}</h5>
                                            <p class="card-text">{$article_publisher_elpais->outertext}</p>
                                            <a href="{$article_link_elpais->href}" class="btn btn-primary">Ver noticia</a>
                                        </div>
                                    </div>
                                HTML;
                            }
                    
                            // Se incrementa el contador en 1 para pasar a la siguiente noticia.
                            $j++;
                        } 
                        // Si el contador ya superó las 6 noticias, se sale del ciclo.
                        else {
                            break;
                        }
                    }
                ?>
                </div>
            </div>
            <!--  ╔════════════════════════════════════════════════════════════════════════════════════════╗-->
            <!--  ║ /// .                           NOTICIAS CUSTOM                              . ///     ║ -->
            <!--  ╚════════════════════════════════════════════════════════════════════════════════════════╝ -->
            <div id="masnoticias">
                <div class="sectionTitle row pt-4">
                    <div class="col-12">
                        <h2 class="newspaperTitle">Más Noticias</h2>
                        <a href="backend/create.php" class="btn btnCrear">Nueva Noticia</a>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                <?php
                    // Declaramos las variables
                    $pdo = Database::connect(); // Conexión a la base de datos
                    $sql = 'SELECT * FROM noticias ORDER BY id DESC'; // Consulta SQL para seleccionar todas las noticias ordenadas por ID en orden descendente 
                    $k = 0;
                    $card_start = '
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"> %s </h5>
                                <p class="card-text"> %s </p>
                                <a href="backend/read.php?id=%s" class="btn btn-primary"> %s </a>
                            </div>';
                    
                    // Preparamos y ejecutamos la consulta SQL
                    $stmt = $pdo->prepare($sql); // Se prepara la consulta SQL
                    $stmt->execute(); // Ejecuta la consulta SQL
                    
                    // Recorremos las filas devueltas y mostramos las noticias
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // se recorren las filas obtenidas a través de la consulta SQL con un bucle while
                        $text = strlen($row['text']) > 250 ? substr($row['text'],0,250)."..." : $row['text']; // Si la longitud del texto es mayor que 250 caracteres, se acorta.
                        $k++;
                        if ($k == 4) { // Si ya se muestran 4 tarjetas, se cierra el div y se inicia otro div
                            echo '</div><div class="d-flex justify-content-between">';
                            $k = 0;
                        }
                        $card_image = $row['image'] ?? 'img/no_imagen.jpg'; // Se obtiene la imagen de la noticia, si no hay ninguna imagen, se usa 'img/elpais_logo.png' como imagen
                        printf($card_start, $row['source'], $row['publisher'], $row['id'], $row['title']); // Imprime los detalles de la noticia en una tarjeta
                        echo '<img src="' . $card_image . '" class="card-img-top" style="padding: 20px;">
                        </div>'; // Muestra la imagen de la noticia en la tarjeta
                    }
                    
                    Database::disconnect(); // Cierra la conexión a la base de datos
                    
                ?>
                </div>
            </div>
        </main>

        <?php include("backend/footer.php");?>
        <script>
    // Obtener los botones y los divs correspondientes
    var btnElMundo = document.querySelector('#el-mundo');
    var divElMundo = document.querySelector('#elmundo');
    var btnElPais = document.querySelector('#el-pais');
    var divElPais = document.querySelector('#elpais');
    var btnMasNoticias = document.querySelector('#mas-noticias');
    var divMasNoticias = document.querySelector('#masnoticias');
    
    // Función para ocultar todos los divs
    function ocultarDivs() {
        divElMundo.style.display = 'none';
        divElPais.style.display = 'none';
        divMasNoticias.style.display = 'none';
    }
    
    // Funciones para mostrar los divs correspondientes y ocultar los demás
    function mostrarElMundo() {
        ocultarDivs();
        divElMundo.style.display = 'block';
    }
    
    function mostrarElPais() {
        ocultarDivs();
        divElPais.style.display = 'block';
    }
    
    function mostrarMasNoticias() {
        ocultarDivs();
        divMasNoticias.style.display = 'block';
    }
    
    // Asignar los eventos de clic a los botones correspondientes
    btnElMundo.addEventListener('click', mostrarElMundo);
    btnElPais.addEventListener('click', mostrarElPais);
    btnMasNoticias.addEventListener('click', mostrarMasNoticias);
    
    // Ocultar todos los divs al cargar la página
    ocultarDivs();
</script>

    </body>
    

</html>