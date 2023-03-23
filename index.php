<!DOCTYPE html>
<html>
    <head>

        <title>Daily Trends</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <?php 
            include("backend/functions.php");
            include("backend/simple_html_dom.php");
        ?>
    </head>

    <body>
        <main class="container p-5 my-5 border">
            <?php include("backend/header.php");?>
            <?php include("backend/menu.php");?>

            <!-- EL MUNDO -->
            <div id="elmundo" class="sectionTitle row pt-4">
                <div class="col-12">
                    <h2 class="newspaperTitle">El Mundo</h2>
                </div>
            </div>
            <div class="d-flex justify-content-between">
            <?php
                $html = file_get_html('https://www.elmundo.es');
                $news_content = $html->find('div[class=ue-c-cover-content__body]');
                $i = 1;

                foreach(array_slice($news_content,0) as $news_res) {
                    $article_title = $news_res->find("a[class=ue-c-cover-content__link]",0);
                    $article_publisher = $news_res->find(".ue-c-cover-content__byline-name", 0);
                    $article_source = $news_res->find(".ue-c-cover-content__byline-location", 0);
                        
                    $html_img = file_get_html($article_title->href);
                    $article_image = $news_res->find("div.ue-c-cover-content__media figure picture img",0);

                    if($i == 4){
                        echo '</div><div class="d-flex justify-content-between">';
                    }
                    if($i>0 && $i<=6) {
                        if($article_image==null){
                            echo '
                                <div class="card" style="width: 18rem;">
                                    <img src="img/elmundo_logo.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$article_title.'</h5>
                                        <p class="card-text">'.$article_publisher->outertext.'</p>
                                        <a href="'.$article_title->href.'" class="btn btn-primary">Ver noticia</a>
                                    </div>
                                </div>
                                '
                            ;
                        } else {
                            echo '
                                <div class="card" style="width: 18rem;">
                                    <img src="'.$article_image->src.'" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$article_title.'</h5>
                                        <p class="card-text">'.$article_publisher->outertext.'</p>
                                        <a href="'.$article_title->href.'" class="btn btn-primary">Ver noticia</a>
                                    </div>
                                </div>
                                '
                            ;
                        }
                        $i++;
                        
                    } else {
                        break;
                    }
                }
                
                echo '';
                $html->clear();
                unset($html);
                $html_img->clear();
                unset($html_img);
            ?>
            </div>

            <!-- EL PAIS -->
            <div id="elpais" class="sectionTitle row pt-4">
                <div class="col-12">
                    <h2 class="newspaperTitle">El País</h2>
                </div>
            </div>
            <div class="d-flex justify-content-between">
            <?php
                $html2 = file_get_html('https://elpais.com/');
                $news_content2 = $html2->find('.c-d');
                $j = 1;

                foreach($news_content2 as $news_res2) {
                
                    $article_title_elpais = $news_res2->find("h2[class=c_t]",0);
                    $article_link_elpais = $news_res2->find("h2[class=c_t] a",0);
                    $article_publisher_elpais = $news_res2->find(".c_a_a",0);
                    $article_src = $news_res2->find("p[class=c_d]",0);
                    $article_image_elpais = $news_res2->find("div.b_col article figure a img",0);
                        

                    if($j == 4){
                        echo '</div><div class="d-flex justify-content-between">';
                    }

                    if($j<=6){
                        
                        if(($article_link_elpais)==null)
                        {
                            
                            $j--;
                            
                        } else if($article_image_elpais==null) {
                            
                            echo  '
                                <div class="card" style="width: 18rem;">
                                    <img src="img/elpais_logo.png" class="card-img-top" style="padding: 20px;">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$article_title_elpais.'</h5>
                                        <p class="card-text">'.$article_publisher_elpais->outertext.'</p>
                                        <a href="'.$article_link_elpais->href.'" class="btn btn-primary">Ver noticia</a>
                                    </div>
                                </div>
                                '
                            ;
                        }
                        else {
                            echo '
                                <div class="card" style="width: 18rem;">
                                    <img src="'.$article_image_elpais->src.'" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$article_title_elpais.'</h5>
                                        <p class="card-text">'.$article_publisher_elpais->outertext.'</p>
                                        <a href="'.$article_link_elpais->href.'" class="btn btn-primary">Ver noticia</a>
                                    </div>
                                </div>
                                '
                            ;
                        }
                        $j++;
                    } else {
                        break;
                    }
                    
                }
            ?>
            </div>

            <!-- NOTICIAS CUSTOM -->
            <div id="masnoticias" class="sectionTitle row pt-4">
                <div class="col-12">
                    <h2 class="newspaperTitle">Más Noticias</h2>
                    <a href="backend/create.php" class="btn btnCrear">Nueva Noticia</a>
                </div>
            </div>
            <div class="d-flex justify-content-between">
            <?php
                $pdo = Database::connect();
                $sql = 'SELECT * FROM noticias ORDER BY id DESC';
                
                $k = 0;
                
                foreach ($pdo->query($sql) as $row) {
                    $text = strlen($row['text']) > 250 ? substr($row['text'],0,250)."..." : $row['text'];
                    
                    $k++;

                    if($k == 4){
                        echo '</div><div class="d-flex justify-content-between">';
                        $k = 0;
                    }
                    if($row['image']==null){
                        echo  '
                        <div class="card" style="width: 18rem;">
                            <img src="img/elpais_logo.png" class="card-img-top" style="padding: 20px;">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['source'].'</h5>
                                <p class="card-text">'.$row['publisher'].'</p>
                                <a href="backend/read.php?id='.$row['id'].'" class="btn btn-primary">'.$row['title'].'</a>
                            </div>
                        </div>';
                    } else {
                        echo  '
                        <div class="card" style="width: 18rem;">
                            <img src="'.$row['image'].'" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['source'].'</h5>
                                <p class="card-text">'.$row['publisher'].'</p>
                                <a href="backend/read.php?id='.$row['id'].'" class="btn btn-primary">'.$row['title'].'</a>
                            </div>
                        </div>';
                    }
                }

                Database::disconnect();
            ?>
            </div>

        </main>

        <?php include("backend/footer.php");?>

    </body>

</html>