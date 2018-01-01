<html>
    <body>
        <?php
            $imageNotFound = \PulpFiction\core\PulpFiction::$app->callAction('image',
                                                               'getNotFoundImage',
                                                                     ['imageFile' => 'pulp_fiction_not_found']);

            echo '<img src="data:image/jpg;base64,'. $imageNotFound . '" width="300" height="200">'
        ?>
    </body>
</html>