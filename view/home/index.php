<?php
    use PulpFiction\core\PulpFiction;
?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="main-header">
            <h1>Welcome!</h1>
            <?php
                $imageFile = PulpFiction::$app->callAction('image', 'imageFile', ['imageFile' => 'main-image']);

                echo '<img src="data:image/jpg;base64,'. $imageNotFound . '" width="300" 
                                                                             height="200" 
                                                                             class="img-responsive not-found-image">'
            ?>
        </div>
    </body>
</html>