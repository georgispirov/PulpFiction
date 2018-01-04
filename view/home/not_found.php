<?php
    use PulpFiction\core\PulpFiction;
?>

<head>
    <link rel="stylesheet" href="/web/css/style.css">
</head>
<body>
    <?php

    $imageNotFound = PulpFiction::$app->callAction('image',
                                                           'getImage',
                                                                 ['imageFile' => 'pulp_fiction_not_found']);

        echo '<img src="data:image/jpg;base64,'. $imageNotFound . '" width="300" 
                                                                     height="200" 
                                                                     class="img-responsive not-found-image">'
    ?>
</body>